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
    <title>Detalles de la Película</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-900 text-white font-sans antialiased">

    <header><?php require '../../layouts/header-user.php' ?></header>

    <main class="min-h-screen p-8 flex flex-col items-center justify-center">
        <div class="max-w-6xl w-full mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-[1.005]">
            <div class="relative">
                <h1 class="absolute inset-x-0 top-0 text-center text-5xl md:text-6xl font-extrabold text-white z-10 py-6 px-4 bg-gradient-to-b from-gray-900/80 to-transparent">
                    <?php echo htmlspecialchars($title ?? 'Título Desconocido'); ?>
                </h1>

                <div class="aspect-video w-full">
                    <video controls class="w-full h-full object-cover bg-black rounded-t-xl" poster="<?php echo htmlspecialchars($get_image ?? ''); ?>">
                        <source src="../../../../public/assets/movies/Captain-america-Civil-War-ESP.mp4" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <div class="md:col-span-1 flex flex-col items-center">
                    <div class="rounded-lg overflow-hidden shadow-xl border border-gray-700 w-full max-w-xs md:max-w-none transform transition-transform duration-300 hover:scale-105">
                        <?php echo $get_image ?? '<img src="https://via.placeholder.com/500x750?text=No+Poster" alt="Poster no disponible" class="w-full h-full object-cover">'; ?>
                    </div>
                    <div class="mt-6 text-center w-full bg-gray-700 p-4 rounded-lg shadow-inner">
                        <h2 class="text-2xl font-bold mb-2 flex items-center justify-center">
                            <i class="fas fa-star text-yellow-500 mr-2"></i> Puntuación
                        </h2>
                        <p class="text-3xl font-extrabold text-yellow-400">
                            <?php echo htmlspecialchars($vote_average ?? 'N/A'); ?> <span class="text-xl text-gray-300">/ 10</span>
                        </p>
                        <p class="text-lg text-gray-400 mt-2">(Basado en <?php echo htmlspecialchars($vote_count ?? '0'); ?> votos)</p>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-gray-700 p-6 rounded-lg shadow-lg mb-8">
                        <h2 class="text-3xl font-bold text-white mb-4 border-b border-gray-600 pb-2">Sinopsis</h2>
                        <p class="text-lg text-gray-300 leading-relaxed">
                            <?php echo htmlspecialchars($overview ?? 'Sinopsis no disponible.'); ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                            <h2 class="text-2xl font-bold text-white mb-2">Fecha de Lanzamiento</h2>
                            <p class="text-lg text-gray-300"><?php echo htmlspecialchars($release_date ?? 'Fecha desconocida'); ?></p>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                            <h2 class="text-2xl font-bold text-white mb-2">Idioma Original</h2>
                            <p class="text-lg text-gray-300 uppercase"><?php echo htmlspecialchars($original_language ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                        <h2 class="text-3xl font-bold text-white mb-6 border-b border-gray-600 pb-2">Elenco Principal</h2>
                        <div class="overflow-x-auto custom-scrollbar pb-4">
                            <div class="flex space-x-6">
                                <?php
                                /* Verifica si hay actores con un array */
                                if (!empty($actors)) :
                                    foreach ($actors as $actor) :
                                ?>
                                        <div class="flex-none w-40 text-center">
                                            <img src="<?php echo htmlspecialchars($actor['profile_path'] ?? 'https://via.placeholder.com/185x278?text=No+Image'); ?>" alt="<?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>" class="w-32 h-32 object-cover rounded-full mx-auto mb-2 border-2 border-gray-600 shadow-md transform transition-transform duration-300 hover:scale-105">
                                            <p class="text-lg font-semibold text-white truncate" title="<?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>">
                                                <?php echo htmlspecialchars($actor['name'] ?? 'Actor Desconocido'); ?>
                                            </p>
                                            <p class="text-sm text-gray-400 truncate" title="<?php echo htmlspecialchars($actor['character'] ?? 'Personaje Desconocido'); ?>">
                                                como <?php echo htmlspecialchars($actor['character'] ?? 'Personaje'); ?>
                                            </p>
                                        </div>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <p class="text-gray-400">No se encontró información del elenco para esta película.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <style>
        /* Custom Scrollbar para Carrusel */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #4a5568;
            /* gray-700 */
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #6b7280;
            /* gray-500 */
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
            /* gray-400 */
        }
    </style>
</body>

</html>