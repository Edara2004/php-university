<?php

// Verificar si la sesión ya está iniciada antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir el sistema de rutas
require_once(dirname(dirname(__DIR__)) . '/config/paths.php');

// Incluir el archivo de configuración
requireConfig();

// Clase principal para manejar las operaciones del administrador
class AdminController {
    private $pdo;

    // Constructor - conecta a la base de datos
    public function __construct() {
        $connection = new ConnectionsDatabase();
        $this->pdo = $connection->connect();
    }

    // Verificar si el usuario actual es administrador
    public function isAdmin() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            return false;
        }
        
        // Buscar el rol del usuario en la base de datos
        $sql = "SELECT role FROM users WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        return $user && $user['role'] === 'admin';
    }

    // Obtener todos los usuarios del sistema
    public function getAllUsers() {
        try {
            $sql = "SELECT id, Users, email, role, created_at, status FROM users ORDER BY created_at DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return [];
        }
    }

    // Obtener un usuario específico por su ID
    public function getUserById($id) {
        try {
            $sql = "SELECT id, Users, email, role, created_at, status FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return null;
        }
    }

    // Crear un nuevo usuario en el sistema
    public function createUser($username, $email, $password, $role = 'user') {
        try {
            // Encriptar la contraseña para seguridad
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (Users, email, UserPasswords, role, created_at, status) 
                    VALUES (:username, :email, :password, :role, NOW(), 'active')";
            $stmt = $this->pdo->prepare($sql);
            
            $result = $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);
            
            return $result ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Error al crear usuario: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar información de un usuario existente
    public function updateUser($id, $username, $email, $role, $status) {
        try {
            $sql = "UPDATE users SET Users = :username, email = :email, role = :role, status = :status 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([
                ':id' => $id,
                ':username' => $username,
                ':email' => $email,
                ':role' => $role,
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Cambiar la contraseña de un usuario
    public function updateUserPassword($id, $newPassword) {
        try {
            // Encriptar la nueva contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $sql = "UPDATE users SET UserPasswords = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([
                ':id' => $id,
                ':password' => $hashedPassword
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar contraseña: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar un usuario del sistema
    public function deleteUser($id) {
        try {
            // No permitir que un administrador se elimine a sí mismo
            if ($id == $_SESSION['user_id']) {
                return false;
            }
            
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Cambiar el estado de un usuario (activo/inactivo)
    public function toggleUserStatus($id) {
        try {
            $sql = "UPDATE users SET status = CASE WHEN status = 'active' THEN 'inactive' ELSE 'active' END 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al cambiar estado del usuario: " . $e->getMessage());
            return false;
        }
    }

    // Obtener estadísticas para el dashboard
    public function getDashboardStats() {
        try {
            $stats = [];
            
            // Contar total de usuarios
            $sql = "SELECT COUNT(*) as total FROM users";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stats['total_users'] = $stmt->fetch()['total'];
            
            // Contar usuarios activos
            $sql = "SELECT COUNT(*) as active FROM users WHERE status = 'active'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stats['active_users'] = $stmt->fetch()['active'];
            
            // Contar usuarios inactivos
            $sql = "SELECT COUNT(*) as inactive FROM users WHERE status = 'inactive'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stats['inactive_users'] = $stmt->fetch()['inactive'];
            
            // Contar administradores
            $sql = "SELECT COUNT(*) as admins FROM users WHERE role = 'admin'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stats['admin_users'] = $stmt->fetch()['admins'];
            
            return $stats;
        } catch (PDOException $e) {
            error_log("Error al obtener estadísticas: " . $e->getMessage());
            return [];
        }
    }

    // Función para buscar usuario por username y email
    public function getUserByUsernameAndEmail($username, $email) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE Users = ? AND email = ?");
            $stmt->execute([$username, $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting user by username and email: " . $e->getMessage());
            return false;
        }
    }
}

// Manejo de las peticiones AJAX desde el frontend
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $admin = new AdminController();
    
    // Verificar que el usuario sea administrador
    if (!$admin->isAdmin()) {
        http_response_code(403);
        echo json_encode(['error' => 'Acceso denegado']);
        exit();
    }
    
    $action = $_POST['action'];
    
    // Procesar diferentes acciones según lo que pida el frontend
    switch ($action) {
        case 'get_users':
            $users = $admin->getAllUsers();
            echo json_encode(['success' => true, 'data' => $users]);
            break;
            
        case 'get_user':
            $id = $_POST['id'] ?? 0;
            $user = $admin->getUserById($id);
            echo json_encode(['success' => true, 'data' => $user]);
            break;
            
        case 'create_user':
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';
            
            // Validar que todos los campos estén llenos
            if (empty($username) || empty($email) || empty($password)) {
                echo json_encode(['success' => false, 'error' => 'Todos los campos son requeridos']);
                break;
            }
            
            $result = $admin->createUser($username, $email, $password, $role);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Usuario creado exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al crear usuario']);
            }
            break;
            
        case 'update_user':
            $id = $_POST['id'] ?? 0;
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $status = $_POST['status'] ?? 'active';
            
            // Validar campos requeridos
            if (empty($id) || empty($username) || empty($email)) {
                echo json_encode(['success' => false, 'error' => 'Campos requeridos faltantes']);
                break;
            }
            
            $result = $admin->updateUser($id, $username, $email, $role, $status);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Usuario actualizado exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al actualizar usuario']);
            }
            break;
            
        case 'delete_user':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id)) {
                echo json_encode(['success' => false, 'error' => 'ID de usuario requerido']);
                break;
            }
            
            $result = $admin->deleteUser($id);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Usuario eliminado exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al eliminar usuario']);
            }
            break;
            
        case 'toggle_status':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id)) {
                echo json_encode(['success' => false, 'error' => 'ID de usuario requerido']);
                break;
            }
            
            $result = $admin->toggleUserStatus($id);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Estado cambiado exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al cambiar estado']);
            }
            break;
            
        case 'change_password':
            $id = $_POST['id'] ?? 0;
            $newPassword = $_POST['new_password'] ?? '';
            
            // Validar que la contraseña tenga al menos 6 caracteres
            if (empty($id) || empty($newPassword) || strlen($newPassword) < 6) {
                echo json_encode(['success' => false, 'error' => 'ID de usuario requerido y contraseña debe tener al menos 6 caracteres']);
                break;
            }
            
            $result = $admin->updateUserPassword($id, $newPassword);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Contraseña actualizada exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al actualizar contraseña']);
            }
            break;
            
        case 'get_stats':
            $stats = $admin->getDashboardStats();
            echo json_encode(['success' => true, 'data' => $stats]);
            break;
            
        default:
            echo json_encode(['success' => false, 'error' => 'Acción no válida']);
            break;
    }
    exit();
}
?> 