<?php
session_start();

/* Verificar si esta registrado el usuario */
if (!isset($_SESSION['username'])) {
    header("Location: ../../src/View/login/login.php");
    exit();
}

// Conectar con la base de datos
require_once '../../config/config.php';
$connection = new ConnectionsDatabase();
$pdo = $connection -> connect();

// Obtener lista de usuarios

$sql = "SELECT Users FROM usersaccounts";
$stmt = $pdo -> query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<!-- Header -->
<header>

</header>

<!-- Main -->
<main>
    <div>
        <div>
            
        </div>
    </div>
</main>

<!-- Footer -->
<footer>

</footer>
</body>
</html>