<?php

/* __DIR__ permite hacer el llamado unico de un archivo, en este caso la API */
require_once __DIR__ . '/../../tokens.php';



/* Obtener el API TOKEN */
$API_TOKEN = $API_TOKEN_MOVIE;

$imdb_id = $_GET['imdb_id'] ?? null;

$curl = curl_init();

/* Selector mediante ID, para obtener la información de la pelicula en la API */
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.themoviedb.org/3/find/{$imdb_id}?external_source=imdb_id&language=es",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer {$API_TOKEN}",
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    /* Decodificamos el Json de la API */
    $movie = json_decode($response);
    /*  Recolección de datos */
    if (isset($movie->movie_results[0])) {
        $data = $movie->movie_results[0];
        /* Variables */

        $title = $data->title;
        $overview = $data->overview;
        $vote_average = $data->vote_average;
        $vote_count = $data->vote_count;

        /* Imagen de la pelicula */
        $images = $data->poster_path;
        $get_image = "<img src='https://image.tmdb.org/t/p/w500{$images}'>";
  
    } else {
        echo "No se encontró información de la película con el ID de IMDb: " . $imdb_id;
    }
}
