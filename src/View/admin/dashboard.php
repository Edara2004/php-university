<?php
// Verificar si la sesión ya está iniciada antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir el sistema de rutas
require_once(dirname(dirname(dirname(__DIR__))) . '/config/paths.php');

// Incluir archivos necesarios
requireConfig();
requireController('AdminController.php');

// Crear instancia del controlador de administración
$admin = new AdminController();

// Verificar si el usuario está logueado y es administrador
if (!$admin->isAdmin()) {
    header('Location: ../login/login.php');
    exit();
}

// Obtener datos para el dashboard
$stats = $admin->getDashboardStats();
$users = $admin->getAllUsers();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Loopkin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin-styles.css">
    <!-- Estilos personalizados -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }
        
        /* Clases para modo claro */
        .light-mode {
            background-color: #f8fafc !important;
        }
        
        .light-mode .header-light {
            background-color: #ffffff !important;
            border-bottom-color: #e2e8f0 !important;
        }
        
        .light-mode .card-light {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
        }
        
        .light-mode .text-dark {
            color: #1f2937 !important;
        }
        
        .light-mode .text-gray-dark {
            color: #374151 !important;
        }
        
        .light-mode .text-gray-medium {
            color: #6b7280 !important;
        }
        
        .light-mode .bg-light {
            background-color: #f9fafb !important;
        }
        
        .light-mode .border-light {
            border-color: #e5e7eb !important;
        }
        
        .light-mode .hover-light:hover {
            background-color: #f3f4f6 !important;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen" id="mainBody">
    <!-- Header con efecto glass -->
    <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-50 header-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cog text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white text-dark">Panel de Administración</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 text-white">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span class="font-medium text-dark"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                    <button onclick="toggleTheme()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 mr-2" id="themeToggle">
                        <i class="fas fa-moon mr-2" id="themeIcon"></i><span id="themeText">Modo Oscuro</span>
                    </button>
                    <a href="change-my-password.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 mr-2">
                        <i class="fas fa-key mr-2"></i>Mi Contraseña
                    </a>
                    <a href="../../Controllers/logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Tarjetas de estadísticas con animaciones -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total de usuarios -->
            <div class="card-hover bg-gray-800 border border-gray-700 rounded-xl p-6 text-white shadow-lg card-light">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium text-gray-medium">Total de Usuarios</p>
                        <p class="text-3xl font-bold text-dark"><?php echo $stats['total_users'] ?? 0; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Usuarios activos -->
            <div class="card-hover bg-gray-800 border border-gray-700 rounded-xl p-6 text-white shadow-lg card-light">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium text-gray-medium">Usuarios Activos</p>
                        <p class="text-3xl font-bold text-dark"><?php echo $stats['active_users'] ?? 0; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-check text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Usuarios inactivos -->
            <div class="card-hover bg-gray-800 border border-gray-700 rounded-xl p-6 text-white shadow-lg card-light">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium text-gray-medium">Usuarios Inactivos</p>
                        <p class="text-3xl font-bold text-dark"><?php echo $stats['inactive_users'] ?? 0; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-times text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Administradores -->
            <div class="card-hover bg-gray-800 border border-gray-700 rounded-xl p-6 text-white shadow-lg card-light">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium text-gray-medium">Administradores</p>
                        <p class="text-3xl font-bold text-dark"><?php echo $stats['admin_users'] ?? 0; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-shield text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de gestión de usuarios -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl overflow-hidden card-light">
            <div class="px-6 py-4 border-b border-gray-700 border-light">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white text-dark">Gestión de Usuarios</h2>
                    <button onclick="openCreateUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Nuevo Usuario
                    </button>
                </div>
            </div>

            <!-- Tabla de usuarios con diseño mejorado -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700 divide-light">
                    <thead class="bg-gray-700 bg-light">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Usuario</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Rol</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Fecha</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider text-gray-dark">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700 divide-light bg-light" id="usersTableBody">
                        <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-700 transition-colors duration-200 hover-light">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-medium"><?php echo strtoupper(substr($user['Users'], 0, 1)); ?></span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white text-dark"><?php echo htmlspecialchars($user['Users']); ?></div>
                                        <div class="text-xs text-gray-400 text-gray-medium">ID: <?php echo $user['id']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-200 font-medium text-gray-dark"><?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                    <?php echo $user['role'] === 'admin' ? 'bg-purple-600 text-white' : 'bg-gray-600 text-white'; ?>">
                                    <i class="fas <?php echo $user['role'] === 'admin' ? 'fa-user-shield' : 'fa-user'; ?> mr-1"></i>
                                    <?php echo ucfirst($user['role'] ?? 'user'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                    <?php echo $user['status'] === 'active' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'; ?>">
                                    <i class="fas <?php echo $user['status'] === 'active' ? 'fa-check-circle' : 'fa-times-circle'; ?> mr-1"></i>
                                    <?php echo ucfirst($user['status'] ?? 'active'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 text-gray-medium">
                                <?php echo $user['created_at'] ? date('d/m/Y H:i', strtotime($user['created_at'])) : 'N/A'; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="editUser(<?php echo $user['id']; ?>)" class="text-blue-400 hover:text-blue-300 transition-colors duration-200" title="Editar usuario">
                                        <i class="fas fa-edit text-lg"></i>
                                    </button>
                                    <button onclick="changePassword(<?php echo $user['id']; ?>)" class="text-green-400 hover:text-green-300 transition-colors duration-200" title="Cambiar contraseña">
                                        <i class="fas fa-key text-lg"></i>
                                    </button>
                                    <button onclick="toggleUserStatus(<?php echo $user['id']; ?>)" class="text-yellow-400 hover:text-yellow-300 transition-colors duration-200" title="Cambiar estado">
                                        <i class="fas fa-toggle-on text-lg"></i>
                                    </button>
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                    <button onclick="deleteUser(<?php echo $user['id']; ?>)" class="text-red-400 hover:text-red-300 transition-colors duration-200" title="Eliminar usuario">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal para crear usuario con diseño mejorado -->
    <div id="createUserModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-700 w-96 shadow-2xl rounded-xl bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Crear Nuevo Usuario</h3>
                    <button onclick="closeCreateUserModal()" class="text-gray-400 hover:text-gray-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="createUserForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Usuario</label>
                        <input type="text" name="username" required class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                        <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Rol</label>
                        <select name="role" class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                            <option value="user">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeCreateUserModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-300">
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-700 w-96 shadow-2xl rounded-xl bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Editar Usuario</h3>
                    <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="editUserForm" class="space-y-4">
                    <input type="hidden" name="id" id="editUserId">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Usuario</label>
                        <input type="text" name="username" id="editUsername" required class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="editEmail" required class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Rol</label>
                        <select name="role" id="editRole" class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                            <option value="user">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Estado</label>
                        <select name="status" id="editStatus" class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-700 text-white">
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditUserModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-300">
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-700 w-96 shadow-2xl rounded-xl bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Cambiar Contraseña</h3>
                    <button onclick="closeChangePasswordModal()" class="text-gray-400 hover:text-gray-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="changePasswordForm" class="space-y-4">
                    <input type="hidden" name="id" id="changePasswordUserId">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nueva Contraseña</label>
                        <div class="relative">
                            <input type="password" name="new_password" id="newPassword" required minlength="6" 
                                   class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10 bg-gray-700 text-white">
                            <button type="button" onclick="togglePasswordVisibility('newPassword')" 
                                    class="absolute right-3 top-2 text-gray-400 hover:text-gray-300">
                                <i class="fas fa-eye" id="newPasswordIcon"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Mínimo 6 caracteres</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Confirmar Contraseña</label>
                        <div class="relative">
                            <input type="password" name="confirm_password" id="confirmPassword" required minlength="6" 
                                   class="w-full px-3 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10 bg-gray-700 text-white">
                            <button type="button" onclick="togglePasswordVisibility('confirmPassword')" 
                                    class="absolute right-3 top-2 text-gray-400 hover:text-gray-300">
                                <i class="fas fa-eye" id="confirmPasswordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeChangePasswordModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all duration-300">
                            Cambiar Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenedor de mensajes con diseño mejorado -->
    <div id="messageContainer" class="fixed top-4 right-4 z-50 hidden">
        <div id="messageContent" class="p-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <i id="messageIcon" class="mr-3 text-xl"></i>
                <span id="messageText" class="font-medium"></span>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
    <script>
        // Función para alternar entre modo oscuro y claro
        function toggleTheme() {
            const body = document.getElementById('mainBody');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            const themeToggle = document.getElementById('themeToggle');
            
            if (body.classList.contains('light-mode')) {
                // Cambiar a modo oscuro
                body.classList.remove('light-mode');
                themeIcon.className = 'fas fa-moon mr-2';
                themeText.textContent = 'Modo Oscuro';
                themeToggle.className = 'bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 mr-2';
                localStorage.setItem('theme', 'dark');
            } else {
                // Cambiar a modo claro
                body.classList.add('light-mode');
                themeIcon.className = 'fas fa-sun mr-2';
                themeText.textContent = 'Modo Claro';
                themeToggle.className = 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 mr-2';
                localStorage.setItem('theme', 'light');
            }
        }
        
        // Cargar tema guardado al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const body = document.getElementById('mainBody');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            const themeToggle = document.getElementById('themeToggle');
            
            if (savedTheme === 'light') {
                body.classList.add('light-mode');
                themeIcon.className = 'fas fa-sun mr-2';
                themeText.textContent = 'Modo Claro';
                themeToggle.className = 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 mr-2';
            }
        });
    </script>
</body>
</html> 