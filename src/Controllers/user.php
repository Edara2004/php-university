<?php
use Dba\Connection;
session_start();

require_once ("../../config/config.php");

/* Validacion del POST para el login */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* Variables */
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    /* Iniciando la conexión con la base de datos */
    try {
        $connection = new ConnectionsDatabase();
        $pdo = $connection->connect();

        /* Busqueda de usuario */
        $sql = "SELECT Users, UserPasswords FROM users WHERE Users = :user_param";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_param' => $username]);
        /* Traer el usuario */
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        /* Verificación */
        if ($user && password_verify($password, $user['UserPasswords'])) {
            $_SESSION['username'] = $user['username'];
            header('Location: ../../src/View/pages/home.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Credenciales Incorrectas";
            header('Location: ../View/login/login.php');
            exit();
        }

    } catch(\Throwable $th){
        $error_message = "Error en la conexión" . $th->getMessage();
        exit();  
    }
}

?>

