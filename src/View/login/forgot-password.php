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

$admin = new AdminController();
$message = '';
$messageType = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    
    if (!empty($username) && !empty($email)) {
        // Buscar el usuario por username y email
        $user = $admin->getUserByUsernameAndEmail($username, $email);
        
        if ($user) {
            // Generar una nueva contraseña temporal
            $tempPassword = generateTempPassword();
            $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
            
            // Actualizar la contraseña en la base de datos
            $result = $admin->updateUserPassword($user['id'], $tempPassword);
            
            if ($result) {
                $message = "Tu nueva contraseña temporal es: <strong>$tempPassword</strong><br><br>Por favor, inicia sesión y cambia tu contraseña inmediatamente.";
                $messageType = 'success';
            } else {
                $message = "Error al actualizar la contraseña. Por favor, contacta al administrador.";
                $messageType = 'error';
            }
        } else {
            $message = "No se encontró un usuario con ese nombre de usuario y email.";
            $messageType = 'error';
        }
    } else {
        $message = "Por favor, completa todos los campos.";
        $messageType = 'error';
    }
}

// Función para generar contraseña temporal
function generateTempPassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Loopkin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="forgot-password.css">
</head>

<body class="bg-gray-800">
    <main class="h-full">
        <div class="fondo" style="background-image: url('../../../public/assets/img/background-image.avif'); background-repeat:no-repeat; background-size:cover ;background-position: center;">
            <div class="h-screen">
                <!-- Formulario de recuperación de contraseña -->
                <div class="flex justify-center place-items-center p-2 pr-4 pt-10 mb-70">
                    <div class="border bg-white/75 shadow-xl/90 rounded-md w-auto h-auto max-w-md">
                        
                        <!-- Header con botón de regreso -->
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h1 class="text-xl font-bold text-gray-700">Recuperar Contraseña</h1>
                            <a href="login.php" class="text-blue-600 hover:underline dark:text-blue-500">
                                <i class="fas fa-arrow-left text-lg"></i>
                            </a>
                        </div>

                        <!-- Formulario -->
                        <form action="" method="post" class="p-4">
                            <?php if (!empty($message)): ?>
                                <div class="mb-4 p-3 rounded-lg message-animation <?php echo $messageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700 success-glow' : 'bg-red-100 border border-red-400 text-red-700 error-shake'; ?>">
                                    <div class="flex items-center">
                                        <i class="fas <?php echo $messageType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                                        <span><?php echo $message; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mb-4">
                                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">
                                    <i class="fas fa-user mr-2"></i>Nombre de Usuario
                                </label>
                                <input type="text" 
                                       name="username" 
                                       id="username"
                                       class="border border-gray-800 rounded-md ps-3 py-1.5 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Ingresa tu nombre de usuario" 
                                       required>
                            </div>

                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                    <i class="fas fa-envelope mr-2"></i>Email
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       class="border border-gray-800 rounded-md ps-3 py-1.5 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Ingresa tu email" 
                                       required>
                            </div>

                            <div class="mb-4">
                                <button type="submit" 
                                        class="bg-gray-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md w-full cursor-pointer focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-key mr-2"></i>Recuperar Contraseña
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="login.php" class="text-blue-600 hover:underline dark:text-blue-500">
                                    <i class="fas fa-arrow-left mr-1"></i>Volver al Login
                                </a>
                            </div>
                        </form>

                        <!-- Información adicional -->
                        <div class="p-4 bg-gray-50 rounded-b-md">
                            <div class="text-sm text-gray-600">
                                <h3 class="font-semibold mb-2">¿Cómo funciona?</h3>
                                <ul class="space-y-1 text-xs">
                                    <li><i class="fas fa-info-circle mr-1"></i>Ingresa tu nombre de usuario y email</li>
                                    <li><i class="fas fa-info-circle mr-1"></i>Recibirás una contraseña temporal</li>
                                    <li><i class="fas fa-info-circle mr-1"></i>Inicia sesión y cambia tu contraseña</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Función para mostrar mensajes con animación
        function showMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-4 p-3 rounded-lg message-animation ${type === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'}`;
            messageDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            const form = document.querySelector('form');
            form.insertBefore(messageDiv, form.firstChild);
            
            // Auto-remover después de 5 segundos
            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }

        // Validación del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            
            if (!username || !email) {
                e.preventDefault();
                showMessage('Por favor, completa todos los campos.', 'error');
                return;
            }
            
            // Validación básica de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                showMessage('Por favor, ingresa un email válido.', 'error');
                return;
            }
        });

        // Efecto de focus en los campos
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500');
            });
        });
    </script>
</body>
</html> 