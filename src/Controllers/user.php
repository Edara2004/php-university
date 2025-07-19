<?php

use Dba\Connection;

session_start();

require_once("../../config/config.php");

/* Validacion del POST para el login */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Variables */
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    /* Validar que los campos no estén vacíos */
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Por favor, ingresa tu usuario y contraseña.";
        header('Location: ../View/login/login.php');
        exit();
    }

    /* Iniciando la conexión con la base de datos */
    try {
        $connection = new ConnectionsDatabase();
        $pdo = $connection->connect();

        /* Busqueda de usuario */
        $sql = "SELECT id, Users, UserPasswords FROM users WHERE Users = :user_param";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_param' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        /* Verificación */
        if ($user && password_verify($password, $user['UserPasswords'])) {

            $_SESSION['user_id'] = $user['id']; // Guarda el ID del usuario
            $_SESSION['username'] = $user['Users']; // Guarda el nombre de usuario
            $_SESSION['logged_in'] = true;

            // Redirige a la página de inicio (home.php)
            header('Location: ../../src/View/pages/home.php');
            exit();
        } else {
            // Credenciales incorrectas
            $_SESSION['error_message'] = "Credenciales Incorrectas. Inténtalo de nuevo.";
            header('Location: ../View/login/login.php');
            exit();
        }
    } catch (\PDOException $e) {
        error_log("Error de conexión o consulta PDO: " . $e->getMessage());
        $_SESSION['error_message'] = "Ocurrió un error al intentar iniciar sesión. Por favor, inténtalo más tarde.";
        header('Location: ../View/login/login.php');
        exit();
    } catch (\Throwable $th) {
        error_log("Error inesperado: " . $th->getMessage());
        $_SESSION['error_message'] = "Ocurrió un error inesperado. Por favor, inténtalo más tarde.";
        header('Location: ../View/login/login.php');
        exit();
    }
} else {
    header('Location: ../View/login/login.php');
    exit();
}

