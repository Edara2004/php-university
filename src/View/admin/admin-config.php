<?php
/**
 * Configuración y funciones de utilidad para el panel de administración
 */

// Configuración del panel de administración
define('ADMIN_PAGE_TITLE', 'Panel de Administración - Loopkin');
define('ADMIN_ITEMS_PER_PAGE', 10);
define('ADMIN_SESSION_TIMEOUT', 3600); // 1 hora

// Roles de usuario
define('USER_ROLE_USER', 'user');
define('USER_ROLE_ADMIN', 'admin');

// Estados de usuario
define('USER_STATUS_ACTIVE', 'active');
define('USER_STATUS_INACTIVE', 'inactive');

/**
 * Verificar si el usuario tiene permisos de administrador
 */
function checkAdminPermissions() {
    // Verificar si la sesión ya está iniciada antes de iniciarla
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        return false;
    }
    
    // Incluir el sistema de rutas
    if (!defined('PROJECT_ROOT')) {
        require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config/paths.php');
    }
    
    requireConfig();
    $connection = new ConnectionsDatabase();
    $pdo = $connection->connect();
    
    $sql = "SELECT role FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    return $user && $user['role'] === USER_ROLE_ADMIN;
}

/**
 * Redirigir si no tiene permisos de administrador
 */
function redirectIfNotAdmin() {
    if (!checkAdminPermissions()) {
        header('Location: ../login/login.php');
        exit();
    }
}

/**
 * Obtener información del usuario actual
 */
function getCurrentUserInfo() {
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    
    // Incluir el sistema de rutas
    if (!defined('PROJECT_ROOT')) {
        require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config/paths.php');
    }
    
    requireConfig();
    $connection = new ConnectionsDatabase();
    $pdo = $connection->connect();
    
    $sql = "SELECT id, Users, email, role, status FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    
    return $stmt->fetch();
}

/**
 * Formatear fecha para mostrar en la interfaz
 */
function formatDate($date) {
    if (!$date) return 'N/A';
    return date('d/m/Y H:i', strtotime($date));
}

/**
 * Obtener el nombre del rol en español
 */
function getRoleName($role) {
    $roles = [
        'user' => 'Usuario',
        'admin' => 'Administrador'
    ];
    
    return $roles[$role] ?? ucfirst($role);
}

/**
 * Obtener el nombre del estado en español
 */
function getStatusName($status) {
    $statuses = [
        'active' => 'Activo',
        'inactive' => 'Inactivo'
    ];
    
    return $statuses[$status] ?? ucfirst($status);
}

/**
 * Obtener las clases CSS para el rol
 */
function getRoleClasses($role) {
    return $role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800';
}

/**
 * Obtener las clases CSS para el estado
 */
function getStatusClasses($status) {
    return $status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
}

/**
 * Validar email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Validar contraseña (mínimo 6 caracteres)
 */
function validatePassword($password) {
    return strlen($password) >= 6;
}

/**
 * Sanitizar entrada de usuario
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Generar token CSRF
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verificar token CSRF
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Registrar actividad del administrador
 */
function logAdminActivity($action, $details = '') {
    $logFile = __DIR__ . '/admin-activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $user = $_SESSION['username'] ?? 'Unknown';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    
    $logEntry = "[$timestamp] User: $user, IP: $ip, Action: $action, Details: $details\n";
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

/**
 * Obtener estadísticas básicas del sistema
 */
function getSystemStats() {
    // Incluir el sistema de rutas
    if (!defined('PROJECT_ROOT')) {
        require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config/paths.php');
    }
    
    requireConfig();
    $connection = new ConnectionsDatabase();
    $pdo = $connection->connect();
    
    $stats = [];
    
    try {
        // Total de usuarios
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $stats['total_users'] = $stmt->fetch()['total'];
        
        // Usuarios activos
        $stmt = $pdo->query("SELECT COUNT(*) as active FROM users WHERE status = 'active'");
        $stats['active_users'] = $stmt->fetch()['active'];
        
        // Usuarios inactivos
        $stmt = $pdo->query("SELECT COUNT(*) as inactive FROM users WHERE status = 'inactive'");
        $stats['inactive_users'] = $stmt->fetch()['inactive'];
        
        // Administradores
        $stmt = $pdo->query("SELECT COUNT(*) as admins FROM users WHERE role = 'admin'");
        $stats['admin_users'] = $stmt->fetch()['admins'];
        
        // Usuarios registrados hoy
        $stmt = $pdo->query("SELECT COUNT(*) as today FROM users WHERE DATE(created_at) = CURDATE()");
        $stats['users_today'] = $stmt->fetch()['today'];
        
    } catch (PDOException $e) {
        error_log("Error al obtener estadísticas: " . $e->getMessage());
    }
    
    return $stats;
}

/**
 * Crear paginación
 */
function createPagination($totalItems, $itemsPerPage, $currentPage, $baseUrl) {
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    if ($totalPages <= 1) {
        return '';
    }
    
    $pagination = '<nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">';
    $pagination .= '<div class="flex flex-1 justify-between sm:hidden">';
    
    // Botón anterior
    if ($currentPage > 1) {
        $pagination .= '<a href="' . $baseUrl . '?page=' . ($currentPage - 1) . '" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Anterior</a>';
    } else {
        $pagination .= '<span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-300 cursor-not-allowed">Anterior</span>';
    }
    
    // Botón siguiente
    if ($currentPage < $totalPages) {
        $pagination .= '<a href="' . $baseUrl . '?page=' . ($currentPage + 1) . '" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Siguiente</a>';
    } else {
        $pagination .= '<span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-300 cursor-not-allowed">Siguiente</span>';
    }
    
    $pagination .= '</div>';
    $pagination .= '</nav>';
    
    return $pagination;
}
?> 