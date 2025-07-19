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

// Verificar que el usuario esté logueado
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../login/login.php');
    exit();
}

$admin = new AdminController();
$currentUser = $admin->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Mi Contraseña - Loopkin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 min-h-screen">
    <!-- Header con efecto glass -->
    <header class="glass-effect sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <a href="dashboard.php" class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-left text-white text-xl"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-white">Cambiar Mi Contraseña</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 text-white">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span class="font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                    <a href="../../Controllers/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Tarjeta de información del usuario -->
        <div class="glass-effect rounded-xl shadow-xl p-6 mb-8">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl font-bold"><?php echo strtoupper(substr($currentUser['Users'], 0, 1)); ?></span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-white"><?php echo htmlspecialchars($currentUser['Users']); ?></h2>
                    <p class="text-gray-300"><?php echo htmlspecialchars($currentUser['email'] ?? 'Sin email'); ?></p>
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                        <?php echo $currentUser['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'; ?>">
                        <i class="fas <?php echo $currentUser['role'] === 'admin' ? 'fa-user-shield' : 'fa-user'; ?> mr-1"></i>
                        <?php echo ucfirst($currentUser['role'] ?? 'user'); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulario para cambiar contraseña -->
        <div class="glass-effect rounded-xl shadow-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Cambiar Contraseña</h3>
            <form id="changeMyPasswordForm" class="space-y-6">
                <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>">
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Contraseña Actual</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="currentPassword" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10 bg-white bg-opacity-10 text-white">
                        <button type="button" onclick="togglePasswordVisibility('currentPassword')" 
                                class="absolute right-3 top-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="currentPasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nueva Contraseña</label>
                    <div class="relative">
                        <input type="password" name="new_password" id="newPassword" required minlength="6" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10 bg-white bg-opacity-10 text-white">
                        <button type="button" onclick="togglePasswordVisibility('newPassword')" 
                                class="absolute right-3 top-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="newPasswordIcon"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Mínimo 6 caracteres</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Confirmar Nueva Contraseña</label>
                    <div class="relative">
                        <input type="password" name="confirm_password" id="confirmPassword" required minlength="6" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10 bg-white bg-opacity-10 text-white">
                        <button type="button" onclick="togglePasswordVisibility('confirmPassword')" 
                                class="absolute right-3 top-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="confirmPasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="dashboard.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg hover:from-green-600 hover:to-blue-700 transition-all duration-300">
                        <i class="fas fa-key mr-2"></i>Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Contenedor de mensajes -->
    <div id="messageContainer" class="fixed top-4 right-4 z-50 hidden">
        <div id="messageContent" class="p-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <i id="messageIcon" class="mr-3 text-xl"></i>
                <span id="messageText" class="font-medium"></span>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar mensajes
        function showMessage(message, type = 'success') {
            const container = document.getElementById('messageContainer');
            const content = document.getElementById('messageContent');
            const icon = document.getElementById('messageIcon');
            const text = document.getElementById('messageText');

            if (type === 'success') {
                content.className = 'p-4 rounded-lg shadow-lg max-w-sm bg-green-100 border border-green-400 text-green-700';
                icon.className = 'fas fa-check-circle mr-3 text-xl text-green-500';
            } else {
                content.className = 'p-4 rounded-lg shadow-lg max-w-sm bg-red-100 border border-red-400 text-red-700';
                icon.className = 'fas fa-exclamation-circle mr-3 text-xl text-red-500';
            }

            text.textContent = message;
            container.classList.remove('hidden');

            setTimeout(() => {
                container.classList.add('hidden');
            }, 5000);
        }

        // Función para mostrar/ocultar contraseña
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + 'Icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        // Función para hacer peticiones al servidor
        async function makeRequest(action, data = {}) {
            try {
                const formData = new FormData();
                formData.append('action', action);
                
                for (const [key, value] of Object.entries(data)) {
                    formData.append(key, value);
                }

                const response = await fetch('../../Controllers/AdminController.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                return result;
            } catch (error) {
                console.error('Error en la petición:', error);
                return { success: false, error: 'Error de conexión' };
            }
        }

        // Manejar el formulario de cambio de contraseña
        document.getElementById('changeMyPasswordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const currentPassword = formData.get('current_password');
            const newPassword = formData.get('new_password');
            const confirmPassword = formData.get('confirm_password');
            const userId = formData.get('id');
            
            // Validaciones
            if (newPassword !== confirmPassword) {
                showMessage('Las contraseñas no coinciden', 'error');
                return;
            }
            
            if (newPassword.length < 6) {
                showMessage('La contraseña debe tener al menos 6 caracteres', 'error');
                return;
            }
            
            if (currentPassword === newPassword) {
                showMessage('La nueva contraseña debe ser diferente a la actual', 'error');
                return;
            }
            
            // Enviar petición
            const result = await makeRequest('change_password', { 
                id: userId, 
                new_password: newPassword 
            });
            
            if (result.success) {
                showMessage(result.message, 'success');
                this.reset();
            } else {
                showMessage(result.error, 'error');
            }
        });
    </script>
</body>
</html> 