<?php

require '../../tokens.php';

/* Obtener el API TOKEN */

$API_TOKEN = $API_TOKEN_MOVIE;

$imdb_id = "tt0848228"; /* Esto es para cuando el login esté listo... */

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
        echo $data->title;
        echo "<br>" .  $data->overview;
        echo "<br>" . $data->vote_average;
        echo "<br>" . $data->vote_count;
        echo "<br>" . $data->genre_ids[0];

        /* Imagen de la pelicula */
        $images = $data->poster_path;
        $get_image = "<img src='https://image.tmdb.org/t/p/w500{$images}'>";
        echo "<br>" . $images;
        echo $get_image;
    } else {
        echo "No se encontró información de la película con el ID de IMDb: " . $imdb_id;
    }
}
