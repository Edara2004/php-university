<?php

/* __DIR__ permite hacer el llamado unico de un archivo, en este caso la API */
require_once __DIR__ . '/../../tokens.php';

/* Obtener el API TOKEN */
$API_TOKEN = $API_TOKEN_MOVIE;

// Asegúrate de que el 'id' de la película se obtiene por GET.
// Este es el ID de la película en TMDb, no el IMDb ID.
$movie_id = $_GET['imdb_id'] ?? null;

// Inicializamos la variable $actors como un array vacío.
// Esto garantiza que siempre exista, incluso si la API falla o no hay actores.
$actors = [];

// Solo intentamos obtener los actores si tenemos un ID de película válido.
if (!empty($movie_id)) {
    $curl = curl_init();

    // Configuración para la llamada al endpoint de créditos
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/{$movie_id}/credits?language=es", // Idioma español
        CURLOPT_RETURNTRANSFER => true, // Retorna la respuesta como string
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30, // Tiempo máximo para la ejecución
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$API_TOKEN}", // Token de autorización
            "accept: application/json" // Solicita respuesta en JSON
        ],
    ]);

    $response_credits = curl_exec($curl);
    $err_credits = curl_error($curl); // Captura errores de cURL

    curl_close($curl);

    if ($err_credits) {
        // En un entorno de producción, podrías registrar este error en un log
        // En desarrollo, podrías imprimirlo para depuración:
        // echo "Error cURL al obtener los créditos de la película: " . $err_credits;
        // La variable $actors ya está vacía, lo cual es el comportamiento deseado en caso de error.
    } else {
        // Decodificamos la respuesta JSON como un array asociativo
        $credits_data = json_decode($response_credits, true);

        // Verificamos que el array 'cast' exista y no esté vacío
        if (isset($credits_data['cast']) && is_array($credits_data['cast']) && !empty($credits_data['cast'])) {
            // Limitamos el número de actores a mostrar para el carrusel.
            // Esto evita que la página sea demasiado larga si hay muchos créditos.
            $actors_to_display = array_slice($credits_data['cast'], 0, 20); // Muestra los primeros 20 actores

            // Iteramos sobre cada actor para extraer la información necesaria
            foreach ($actors_to_display as $actor_data) {
                // Obtenemos la ruta relativa de la imagen de perfil
                $profile_path = $actor_data['profile_path'] ?? null;

                // Construimos la URL completa de la imagen.
                // Usamos 'w185' como tamaño estándar para perfiles pequeños en carruseles.
                // Incluimos un placeholder si no hay imagen de perfil disponible.
                $actor_image_url = $profile_path ? "https://image.tmdb.org/t/p/w185{$profile_path}" : 'https://via.placeholder.com/185x278?text=No+Image';

                // Añadimos los datos del actor a nuestro array $actors
                $actors[] = [
                    'name' => $actor_data['name'] ?? 'Actor Desconocido',
                    'character' => $actor_data['character'] ?? 'Personaje Desconocido',
                    'profile_path' => $actor_image_url
                ];
            }
        }
        // Si 'cast' no existe, no es un array o está vacío, $actors permanecerá como array vacío/
    }
}


?>