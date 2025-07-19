<?php
session_start();
require '../../../Services/api-tmdb.php';
require '../../../Services/api-tmdb-credits.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Loopkin</title>
    <!-- Tailwind CSS CDN (versión estándar) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome para los iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c; /* Fondo oscuro */
            color: #e2e8f0; /* Texto claro */
        }
        /* Custom Scrollbar para Carrusel de Actores */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #2d3748; /* gray-800 */
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #4a5568; /* gray-700 */
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #6b7280; /* gray-600 */
        }
        /* Estilo para el video de fondo en la sección de héroe (si se usa) */
        .hero-background-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }
        /* Gradiente sutil para el fondo de las secciones */
        .section-gradient-bg {
            background: linear-gradient(to bottom, #1a202c, #2d3748);
        }
    </style>
</head>

<body class="bg-gray-900 text-white font-sans antialiased">

    <main class="min-h-screen px-4 py-8 md:px-8 md:py-12 flex flex-col items-center justify-center">
        <div class="max-w-6xl w-full mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-[1.005] border border-gray-700">
            <div class="relative">
                <!-- Título superpuesto al video -->
                <h1 class="absolute inset-x-0 top-0 text-center text-5xl md:text-6xl font-extrabold text-white z-10 py-6 px-4 bg-gradient-to-b from-gray-900/80 to-transparent">
                    <?php echo htmlspecialchars($title); ?>
                </h1>

                <!-- Contenedor del video principal -->
                <div class="aspect-video w-full">
                    <video controls class="w-full h-full object-cover bg-black rounded-t-xl" poster="<?php echo htmlspecialchars($get_image); ?>">
                        <source src="../../../../public/assets/movies/Captain-america-Civil-War-ESP.mp4" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Columna izquierda: Poster y Puntuación -->
                <div class="md:col-span-1 flex flex-col items-center">
                    <div class="rounded-lg overflow-hidden shadow-xl border border-gray-700 w-full max-w-xs md:max-w-none transform transition-transform duration-300 hover:scale-105">
                        <?php echo $get_image;  ?>
                    </div>
                    <div class="mt-6 text-center w-full bg-gray-700 p-4 rounded-lg shadow-inner border border-gray-600">
                        <h2 class="text-2xl font-bold mb-2 flex items-center justify-center text-white">
                            <i class="fas fa-star text-yellow-500 mr-2"></i> Puntuación
                        </h2>
                        <p class="text-3xl font-extrabold text-yellow-400">
                            <?php echo htmlspecialchars(number_format($vote_average, 1)); ?> <span class="text-xl text-gray-300">/ 10</span>
                        </p>
                        <p class="text-lg text-gray-400 mt-2">(Basado en <?php echo htmlspecialchars(number_format($vote_count)); ?> votos)</p>
                    </div>

                    <!-- Botón "Salir al menú principal" -->
                    <div class="mt-8 w-full">
                        <a href="../home.php" class="inline-flex items-center justify-center w-full bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-full
                                       transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                            <i class="fas fa-arrow-left mr-2"></i> Salir al menú principal
                        </a>
                    </div>
                </div>

                <!-- Columna derecha: Sinopsis, Datos Adicionales, Elenco y Reseñas -->
                <div class="md:col-span-2">
                    <!-- Sinopsis -->
                    <div class="bg-gray-700 p-6 rounded-lg shadow-lg mb-8 border border-gray-600">
                        <h2 class="text-3xl font-bold text-white mb-4 border-b border-gray-600 pb-2">Sinopsis</h2>
                        <p class="text-lg text-gray-300 leading-relaxed">
                            <?php echo htmlspecialchars($overview); ?>
                        </p>
                    </div>

                    <!-- Fecha de Lanzamiento e Idioma Original -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-600">
                            <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-green-400"></i> Fecha de Lanzamiento
                            </h2>
                            <p class="text-lg text-gray-300"><?php echo htmlspecialchars($release_date); ?></p>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-600">
                            <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-2">
                                <i class="fas fa-language text-purple-400"></i> Idioma Original
                            </h2>
                            <p class="text-lg text-gray-300 uppercase"><?php echo htmlspecialchars($original_language); ?></p>
                        </div>
                    </div>

                    <!-- Elenco Principal (Actores) -->
                    <div class="bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-600">
                        <h2 class="text-3xl font-bold text-white mb-6 border-b border-gray-600 pb-2">Elenco Principal</h2>
                        <div class="overflow-x-auto custom-scrollbar pb-4">
                            <div class="flex space-x-6">
                                <?php if (!empty($actors)) : ?>
                                    <?php foreach ($actors as $actor) : ?>
                                        <div class="flex-none w-40 text-center">
                                            <img src="<?php echo htmlspecialchars($actor['profile_path'] ?? 'https://placehold.co/185x278/2d3748/cbd5e0?text=No+Image'); ?>"
                                                 alt="<?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>"
                                                 class="w-32 h-32 object-cover rounded-full mx-auto mb-2 border-2 border-gray-600 shadow-md transform transition-transform duration-300 hover:scale-105">
                                            <p class="text-lg font-semibold text-white truncate" title="<?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>">
                                                <?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>
                                            </p>
                                            <p class="text-sm text-gray-400 truncate" title="<?php echo htmlspecialchars($actor['character'] ?? 'Personaje Desconocido'); ?>">
                                                como <?php echo htmlspecialchars($actor['character'] ?? 'Personaje'); ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p class="text-gray-400">No se encontró información del elenco para esta película.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción (Reproducir Película y Ver Tráiler) -->
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 mt-8">
                    
                        <!-- Botón para ver el tráiler (modal) -->
                        <?php if (!empty($movie_trailers)): ?>
                            <button id="playTrailerButton" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-full
                                           transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                                <i class="fas fa-film mr-2"></i> Ver Tráiler
                            </button>
                        <?php else: ?>
                            <button class="bg-gray-600 text-gray-400 font-bold py-3 px-8 rounded-full cursor-not-allowed" disabled>
                                <i class="fas fa-video-slash mr-2"></i> Tráiler no disponible
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
