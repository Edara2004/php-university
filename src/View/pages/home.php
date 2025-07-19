<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Si no hay sesión activa o la bandera no está establecida, redirige al login
    header('Location: ../login/login.php');
    exit(); // Detiene la ejecución del script
}

// Cargar datos del usuario si lo necesitas en esta página
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Lógica para obtener datos del usuario 
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Flowbite tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font aweso para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c;
            /* Un fondo oscuro*/
        }
    </style>
</head>

<body class="bg-gray-800">

    <!-- Header -->
    <header><?php require '../layouts/header-user.php' ?></header>

    <!-- Main -->
    <main class="container mx-auto px-4 py-8">

        <!-- Título de la sección de películas -->
        <h1 class="text-white text-4xl font-bold mb-8 md:mb-10 text-center md:text-left">Películas disponibles</h1>

        <!-- Contenedor de la cuadrícula de películas basado en el grid-->
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

        <!-- imdb_id='xxxxxxx' es la variable para llamar la API -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6 lg:gap-8">

            <a href="movies/the-avengers.php?imdb_id=tt0848228" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                     transform hover:scale-105 transition duration-300 ease-in-out
                                                     focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/the-avengers.jpg" alt="The Avengers Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <!-- Overlay con el título de la película y el icono de Play, visible solo al pasar el ratón -->
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">The Avengers</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/avenger-age-of-ultron.php?imdb_id=tt2395427" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                               transform hover:scale-105 transition duration-300 ease-in-out
                                                               focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/avengers-age-of-ultron.jpg" alt="Avengers: Age of Ultron Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Avengers: Age of Ultron</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/avenger-end-game.php?imdb_id=tt4154796" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                         focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/avengers-end-game.jpg" alt="Avengers: Endgame Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Avengers: Endgame</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/captain-america-civil-war.php?imdb_id=tt3498820" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                                  transform hover:scale-105 transition duration-300 ease-in-out
                                                                  focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/captain-america-civil-war.jpg" alt="Captain America: Civil War Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Captain America: Civil War</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/captain-america-the-first-avenger.php?imdb_id=tt0458339" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                                         focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/captain-america-the-first-avenger.jpg" alt="Captain America: The First Avenger Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Captain America: The First Avenger</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/captain-america-the-winter-soldier.php?imdb_id=tt1843866" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                                         transform hover:scale-105 transition duration-300 ease-in-out
                                                                         focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/captain-america-the-winter-soldier.jpg" alt="Captain America: The Winter Soldier Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Captain America: The Winter Soldier</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/guardians-of-galaxy-1.php?imdb_id=tt2015381" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/Guardian-of-galaxy.jpg" alt="Guardians of the Galaxy Vol. 1 Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Guardians of the Galaxy Vol. 1</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/guardians-of-galaxy-2.php?imdb_id=tt3896198" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/Guardian-of-galaxy-2.jpg" alt="Guardians of the Galaxy Vol. 2 Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Guardians of the Galaxy Vol. 2</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

            <a href="movies/guardians-of-galaxy-3.php?imdb_id=tt6791350" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl
                                                          transform hover:scale-105 transition duration-300 ease-in-out
                                                          focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/Guardian-of-galaxy-3.jpg" alt="Guardians of the Galaxy Vol. 3 Poster"
                    class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">Guardians of the Galaxy Vol. 3</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>

        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>