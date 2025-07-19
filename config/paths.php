<?php
/**
 * Configuración centralizada de rutas del proyecto
 */

// Definir la ruta raíz del proyecto
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__));
}

// Rutas de directorios principales
define('CONFIG_DIR', PROJECT_ROOT . '/config');
define('SRC_DIR', PROJECT_ROOT . '/src');
define('CONTROLLERS_DIR', SRC_DIR . '/Controllers');
define('VIEW_DIR', SRC_DIR . '/View');
define('ADMIN_DIR', VIEW_DIR . '/admin');
define('PUBLIC_DIR', PROJECT_ROOT . '/public');

// Rutas de archivos importantes
define('CONFIG_FILE', CONFIG_DIR . '/config.php');
define('ADMIN_CONTROLLER', CONTROLLERS_DIR . '/AdminController.php');
define('ADMIN_DASHBOARD', ADMIN_DIR . '/dashboard.php');
define('ADMIN_CONFIG', ADMIN_DIR . '/admin-config.php');

/**
 * Función para incluir archivos de configuración
 */
function requireConfig($file = 'config.php') {
    $filePath = CONFIG_DIR . '/' . $file;
    if (file_exists($filePath)) {
        require_once($filePath);
    } else {
        throw new Exception("Archivo de configuración no encontrado: $filePath");
    }
}

/**
 * Función para incluir controladores
 */
function requireController($controller) {
    $filePath = CONTROLLERS_DIR . '/' . $controller;
    if (file_exists($filePath)) {
        require_once($filePath);
    } else {
        throw new Exception("Controlador no encontrado: $filePath");
    }
}

/**
 * Función para incluir vistas
 */
function requireView($view) {
    $filePath = VIEW_DIR . '/' . $view;
    if (file_exists($filePath)) {
        require_once($filePath);
    } else {
        throw new Exception("Vista no encontrada: $filePath");
    }
}

/**
 * Función para obtener URL relativa
 */
function getRelativeUrl($path) {
    $basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', PROJECT_ROOT);
    return $basePath . '/' . ltrim($path, '/');
}

/**
 * Función para obtener URL absoluta
 */
function getAbsoluteUrl($path) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', PROJECT_ROOT);
    return $protocol . '://' . $host . $basePath . '/' . ltrim($path, '/');
}
?> 