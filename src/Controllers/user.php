<?php

session_start(); // Siempre al inicio

// require_once "../../config/config.php"; 
require_once '../../config/config.php';

error_log("Login script iniciado. Método: " . $_SERVER['REQUEST_METHOD']); // LOG DE DEPURACIÓN

/* Validacion del POST para el login */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* Variables */
    $username_input = $_POST['username'] ?? ''; // Usar _input para distinguir de la columna DB
    $password_input = $_POST['password'] ?? ''; // Contraseña en texto plano

    error_log("Datos recibidos: username_input='" . $username_input . "', password_input len=" . strlen($password_input)); // LOG DE DEPURACIÓN

    if (empty($username_input) || empty($password_input)) {
        $_SESSION['error_message'] = "Por favor, introduce tu usuario y contraseña.";
        error_log("Error: Campos vacíos."); // LOG DE DEPURACIÓN
        header('Location: ../../src/View/pages/home.php');
        exit();
    }

    /* Iniciando la conexión con la base de datos */
    try {
        $connection = new ConnectionsDatabase();
        $pdo = $connection->connect();
        error_log("Conexión a la DB establecida."); // LOG DE DEPURACIÓN

        /* Busqueda de usuario */
        // Asegúrate de que 'UserPasswords' sea el nombre exacto de la columna en tu DB (mayúsculas/minúsculas)
        $sql = "SELECT Users, UserPasswords FROM users WHERE Users = :user_param"; 
        $stmt = $pdo->prepare($sql);
        
        // Verifica si la preparación de la sentencia fue exitosa
        if ($stmt === false) {
            $errorInfo = $pdo->errorInfo();
            error_log("Error al preparar la sentencia SQL: " . $errorInfo[2]); // LOG DE DEPURACIÓN
            $_SESSION['error_message'] = "Error interno del servidor. Inténtalo de nuevo.";
            header('Location: ../../src/View/pages/home.php');
            exit();
        }

        error_log("Ejecutando consulta para usuario: " . $username_input); // LOG DE DEPURACIÓN
        $stmt->execute([':user_param' => $username_input]);
        
        /* Traer el usuario */
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        error_log("Resultado de la consulta: " . var_export($user, true)); // LOG DE DEPURACIÓN

        /* Verificación */
        if ($user && password_verify($password_input, $user['UserPasswords'])) {
            $_SESSION['username'] = $user['Users'];
            $_SESSION['success_message'] = "¡Bienvenido, " . $user['Users'] . "!";
            error_log("Login exitoso para el usuario: " . $username_input); // LOG DE DEPURACIÓN
            header('Location: ../../src/View/pages/home.php');
            exit();
        } else {
            // Depuración de password_verify:
            error_log("Fallo de verificación para usuario: " . $username_input); // LOG DE DEPURACIÓN
            if ($user) {
                 error_log("Hash DB: " . $user['UserPasswords']);
                 error_log("Password Input: " . $password_input); // Nunca loggear en prod! Solo para depuración.
            } else {
                 error_log("Usuario no encontrado en la DB.");
            }

            $_SESSION['error_message'] = "Credenciales incorrectas. Por favor, verifica tu usuario y contraseña.";
            header('Location: ../../src/View/pages/home.php'); // Redirige al login.php con el mensaje
            exit();
        }

    } catch(\PDOException $th){ // Usar PDOException para errores de base de datos
        $_SESSION['error_message'] = "Error en la base de datos: " . $th->getMessage();
        error_log("PDO Exception en login: " . $th->getMessage()); // Siempre loggear errores
        header('Location: ../../src/View/pages/home.php'); // Redirige al login.php con el mensaje
        exit();
    } catch(\Throwable $th){ // Para cualquier otra excepción
        $_SESSION['error_message'] = "Ocurrió un error inesperado. Por favor, inténtalo de nuevo.";
        error_log("Throwable Exception en login: " . $th->getMessage()); // Siempre loggear errores
        header('Location: ../../src/View/pages/home.php'); // Redirige al login.php con el mensaje
        exit();
    }
} else {
    // Si la solicitud no es POST, redirige al login
    header('Location: ../../src/View/pages/home.php');
    exit();
}

?>

