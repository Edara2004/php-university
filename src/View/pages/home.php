<?php
session_start();

// Conectar con la base de datos
require_once '../../../config/config.php';
$connection = new ConnectionsDatabase();
$pdo = $connection->connect();

// Obtener lista de usuarios

$sql = "SELECT Users FROM users";
$stmt = $pdo->query($sql);
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
    <main class="container mx-auto px-4 py-8">
        <!-- Título de la sección de películas -->
        <h1 class="text-white text-4xl font-bold mb-8 md:mb-10 text-center md:text-left">Películas</h1>

        <!-- Contenedor de la cuadrícula de películas -->
        <!--
            grid: Habilita el display grid
            grid-cols-2: 2 columnas por defecto (móviles)
            sm:grid-cols-3: 3 columnas en pantallas pequeñas (sm)
            md:grid-cols-4: 4 columnas en pantallas medianas (md)
            lg:grid-cols-5: 5 columnas en pantallas grandes (lg)
            xl:grid-cols-6: 6 columnas en pantallas extra grandes (xl)
            gap-4: Espacio de 16px entre los elementos de la cuadrícula
            md:gap-6: Espacio de 24px en pantallas medianas y superiores
            lg:gap-8: Espacio de 32px en pantallas grandes y superiores
        -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6 lg:gap-8">

            <!-- Cada enlace representa una "tarjeta" de película -->
            <a href="movies/the-avengers.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                     transform hover:scale-105 transition duration-300 ease-in-out
                                                     focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/the-avengers.jpg" alt="The Avengers Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/avenger-age-of-ultron.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                               transform hover:scale-105 transition duration-300 ease-in-out
                                                               focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/avengers-age-of-ultron.jpg" alt="Avengers: Age of Ultron Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/avenger-end-game.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                         focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/avengers-end-game.jpg" alt="Avengers: Endgame Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/captain-america-civil-war.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                                  transform hover:scale-105 transition duration-300 ease-in-out
                                                                  focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/captain-america-civil-war.jpg" alt="Captain America: Civil War Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/captain-america-the-first-avenger.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                                         focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/captain-america-the-first-avenger.jpg" alt="Captain America: The First Avenger Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/captain-america-the-winter-soldier.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                                         focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/captain-america-the-winter-soldier.jpg" alt="Captain America: The Winter Soldier Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/guard-of-galaxy-1.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/Guardian-of-galaxy.jpg" alt="Guardians of the Galaxy Vol. 1 Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/guard-of-galaxy-2.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/Guardian-of-galaxy-2.jpg" alt="Guardians of the Galaxy Vol. 2 Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

            <a href="movies/guard-of-galaxy-3.php" class="block rounded-lg overflow-hidden shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="../../../public/assets/img/Guardian-of-galaxy-3.jpg" alt="Guardians of the Galaxy Vol. 3 Poster"
                     class="w-full h-auto object-cover rounded-lg">
            </a>

        </div>
    </main>
    <!-- Footer -->
    <footer></footer>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>