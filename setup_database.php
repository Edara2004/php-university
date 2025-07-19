<?php
/**
 * Script para configurar la base de datos del sistema de administración
 * Ejecutar este archivo una sola vez para configurar la base de datos
 */

// Configuración de la base de datos
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'useraccounts';

echo "<h1>Configuración de la Base de Datos - Sistema de Administración</h1>";

try {
    // Conectar a MySQL sin especificar base de datos
    $pdo = new PDO("mysql:host=$db_host", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p>✅ Conexión a MySQL exitosa</p>";
    
    // Verificar si la base de datos existe
    $stmt = $pdo->query("SHOW DATABASES LIKE '$db_name'");
    if ($stmt->rowCount() == 0) {
        // Crear la base de datos si no existe
        $pdo->exec("CREATE DATABASE `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "<p>✅ Base de datos '$db_name' creada</p>";
    } else {
        echo "<p>✅ Base de datos '$db_name' ya existe</p>";
    }
    
    // Conectar a la base de datos específica
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar si la tabla users existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        // Crear la tabla users si no existe
        $sql = "CREATE TABLE `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `Users` VARCHAR(255) NOT NULL,
            `UserPasswords` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NULL,
            `role` ENUM('user', 'admin') DEFAULT 'user',
            `status` ENUM('active', 'inactive') DEFAULT 'active',
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $pdo->exec($sql);
        echo "<p>✅ Tabla 'users' creada</p>";
    } else {
        echo "<p>✅ Tabla 'users' ya existe</p>";
        
        // Verificar y agregar columnas faltantes
        $columns = $pdo->query("DESCRIBE users")->fetchAll(PDO::FETCH_COLUMN);
        
        // Agregar columna email si no existe
        if (!in_array('email', $columns)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN email VARCHAR(255) NULL");
            echo "<p>✅ Columna 'email' agregada</p>";
        }
        
        // Agregar columna role si no existe
        if (!in_array('role', $columns)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user'");
            echo "<p>✅ Columna 'role' agregada</p>";
        }
        
        // Agregar columna status si no existe
        if (!in_array('status', $columns)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN status ENUM('active', 'inactive') DEFAULT 'active'");
            echo "<p>✅ Columna 'status' agregada</p>";
        }
        
        // Agregar columna created_at si no existe
        if (!in_array('created_at', $columns)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
            echo "<p>✅ Columna 'created_at' agregada</p>";
        }
        
        // Agregar columna updated_at si no existe
        if (!in_array('updated_at', $columns)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
            echo "<p>✅ Columna 'updated_at' agregada</p>";
        }
    }
    
    // Crear índices para mejorar el rendimiento
    $indexes = [
        'idx_users_role' => 'role',
        'idx_users_status' => 'status',
        'idx_users_created_at' => 'created_at'
    ];
    
    foreach ($indexes as $index_name => $column) {
        try {
            $pdo->exec("CREATE INDEX $index_name ON users($column)");
            echo "<p>✅ Índice '$index_name' creado</p>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
                echo "<p>ℹ️ Índice '$index_name' ya existe</p>";
            } else {
                echo "<p>⚠️ Error al crear índice '$index_name': " . $e->getMessage() . "</p>";
            }
        }
    }
    
    // Crear usuario administrador por defecto
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE Users = 'admin'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (Users, UserPasswords, email, role, status, created_at) 
                VALUES ('admin', :password, 'admin@loopkin.com', 'admin', 'active', NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':password' => $hashedPassword]);
        echo "<p>✅ Usuario administrador creado</p>";
        echo "<p><strong>Usuario:</strong> admin</p>";
        echo "<p><strong>Contraseña:</strong> admin123</p>";
    } else {
        echo "<p>✅ Usuario administrador ya existe</p>";
    }
    
    // Mostrar la estructura final de la tabla
    echo "<h2>Estructura final de la tabla 'users':</h2>";
    $columns = $pdo->query("DESCRIBE users")->fetchAll(PDO::FETCH_ASSOC);
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Llave</th><th>Por defecto</th></tr>";
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>{$column['Field']}</td>";
        echo "<td>{$column['Type']}</td>";
        echo "<td>{$column['Null']}</td>";
        echo "<td>{$column['Key']}</td>";
        echo "<td>{$column['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Mostrar usuarios existentes
    echo "<h2>Usuarios en el sistema:</h2>";
    $users = $pdo->query("SELECT id, Users, email, role, status, created_at FROM users")->fetchAll(PDO::FETCH_ASSOC);
    if (count($users) > 0) {
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
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
    
    echo "<h2>✅ Configuración completada exitosamente</h2>";
    echo "<p><strong>El sistema de administración está listo para usar.</strong></p>";
    echo "<p><a href='src/View/admin/dashboard.php' style='background: #3b82f6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ir al Panel de Administración</a></p>";
    
} catch (PDOException $e) {
    echo "<h2>❌ Error en la configuración:</h2>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
    echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    
    echo "<h3>Posibles soluciones:</h3>";
    echo "<ol>";
    echo "<li>Verifica que MySQL esté ejecutándose</li>";
    echo "<li>Verifica las credenciales de la base de datos</li>";
    echo "<li>Asegúrate de que el usuario tenga permisos para crear bases de datos</li>";
    echo "<li>Verifica que no haya conflictos con tablas existentes</li>";
    echo "</ol>";
}
?> 