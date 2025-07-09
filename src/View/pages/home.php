<?php
session_start();

// Conectar con la base de datos
require_once '../../../config/config.php';
$connection = new ConnectionsDatabase();
$pdo = $connection -> connect();

// Obtener lista de usuarios

$sql = "SELECT Users FROM users";
$stmt = $pdo -> query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-800">

<!-- Header -->
<header></header>

<!-- Main -->
<main>

    <h1 class="text-white text-4xl p-4">Peliculas</h1>
    <div>
        
    </div>

</main>
<!-- Footer -->
<footer></footer>


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>