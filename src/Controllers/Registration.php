<?php

require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* Variables */
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cumpleanos = $_POST['cumpleanos'];
    $email = $_POST['email-user'];
    $numeroTelefono = $_POST['numero-de-telefono'];
    $user = $_POST['user'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $nombreCompleto = $nombre . " " . $apellido;

    try {
        $connection = new ConnectionsDatabase();
        $pdo = $connection->connect();
   
        $sql = "INSERT INTO users (Users, UserPasswords, fullname, email, phone_number, birthday) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtinsert = $pdo-> prepare($sql);
        $stmtinsert->execute([
                $user,
                $password,
                $nombreCompleto,
                $email,
                $numeroTelefono,
                $cumpleanos
        ]);
        echo "<script>
        alert(El usuario fue registrado exitosamente.); 
        </script>";
        header('Location: ../View/login/login.php');
        exit();
    } catch (\Throwable $th) {
        echo "<script>
        alert('Error al registrar el usuario: " . addslashes($th->getMessage()) . "');
        </script>";
        header('Location: ../View/login/login.php');
        exit();
    }
}

?>