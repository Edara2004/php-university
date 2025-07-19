<?php
// src/Controllers/Logout.php
session_start(); // ¡Importante! Debe ser lo primero

// Destruye todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la cookie de sesión, también es necesario borrarla.
// Nota: Esto destruirá la sesión, y no solo los datos de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a la página principal
header('Location: ../../public/assets/index.php'); // O a donde quieras que vaya el usuario después de cerrar sesión
exit();
?>