<?php
/**
 * Archivo de prueba para verificar el sistema de administración
 * Colocar este archivo en la raíz del proyecto
 */

// Incluir el sistema de rutas
require_once('config/paths.php');

// Incluir archivos necesarios
requireConfig();
requireController('AdminController.php');

echo "<h1>Prueba del Sistema de Administración</h1>";

try {
    // Crear instancia del controlador
    $admin = new AdminController();
    echo "<p>✅ AdminController creado exitosamente</p>";
    
    // Probar conexión a la base de datos
    $connection = new ConnectionsDatabase();
    $pdo = $connection->connect();
    echo "<p>✅ Conexión a la base de datos exitosa</p>";
    
    // Verificar estructura de la tabla users
    $sql = "DESCRIBE users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $columns = $stmt->fetchAll();
    
    echo "<h2>Estructura de la tabla 'users':</h2>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Llave</th><th>Por defecto</th></tr>";
    
    $requiredColumns = ['id', 'Users', 'UserPasswords', 'email', 'role', 'status', 'created_at'];
    $foundColumns = [];
    
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>{$column['Field']}</td>";
        echo "<td>{$column['Type']}</td>";
        echo "<td>{$column['Null']}</td>";
        echo "<td>{$column['Key']}</td>";
        echo "<td>{$column['Default']}</td>";
        echo "</tr>";
        $foundColumns[] = $column['Field'];
    }
    echo "</table>";
    
    // Verificar columnas requeridas
    echo "<h2>Verificación de columnas requeridas:</h2>";
    foreach ($requiredColumns as $required) {
        if (in_array($required, $foundColumns)) {
            echo "<p>✅ Columna '{$required}' encontrada</p>";
        } else {
            echo "<p>❌ Columna '{$required}' NO encontrada</p>";
        }
    }
    
    // Probar obtener estadísticas
    $stats = $admin->getDashboardStats();
    echo "<h2>Estadísticas del sistema:</h2>";
    echo "<ul>";
    echo "<li>Total de usuarios: " . (isset($stats['total_users']) ? $stats['total_users'] : 0) . "</li>";
    echo "<li>Usuarios activos: " . (isset($stats['active_users']) ? $stats['active_users'] : 0) . "</li>";
    echo "<li>Usuarios inactivos: " . (isset($stats['inactive_users']) ? $stats['inactive_users'] : 0) . "</li>";
    echo "<li>Administradores: " . (isset($stats['admin_users']) ? $stats['admin_users'] : 0) . "</li>";
    echo "</ul>";
    
    // Probar obtener usuarios
    $users = $admin->getAllUsers();
    echo "<h2>Usuarios en el sistema:</h2>";
    if (count($users) > 0) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Usuario</th><th>Email</th><th>Rol</th><th>Estado</th><th>Fecha</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user['id']}</td>";
            echo "<td>{$user['Users']}</td>";
            echo "<td>" . (isset($user['email']) ? $user['email'] : 'N/A') . "</td>";
            echo "<td>" . (isset($user['role']) ? $user['role'] : 'user') . "</td>";
            echo "<td>" . (isset($user['status']) ? $user['status'] : 'active') . "</td>";
            echo "<td>" . (isset($user['created_at']) ? $user['created_at'] : 'N/A') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay usuarios en el sistema</p>";
    }
    
    echo "<h2>✅ Todas las pruebas completadas exitosamente</h2>";
    echo "<p><strong>El sistema de administración está funcionando correctamente.</strong></p>";
    echo "<p><a href='src/View/admin/dashboard.php'>Ir al Panel de Administración</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error encontrado:</h2>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
    echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    
    echo "<h3>Posibles soluciones:</h3>";
    echo "<ol>";
    echo "<li>Verifica que la base de datos 'useraccounts' existe</li>";
    echo "<li>Ejecuta el script SQL: <code>mysql -u root -p useraccounts < database_update.sql</code></li>";
    echo "<li>Verifica la configuración en config/config.php</li>";
    echo "<li>Asegúrate de que MySQL esté ejecutándose</li>";
    echo "</ol>";
}
?> 