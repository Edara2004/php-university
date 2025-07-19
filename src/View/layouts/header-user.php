<header class="bg-gray-800 shadow-md sticky top-0 z-50">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <nav class="bg-gray-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../../index.php" class="text-2xl font-bold">Loopkin</a> 
            <div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <span class="mr-4">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    
                    <?php
                    // Verificar si el usuario es administrador
                    // Incluir el sistema de rutas
                    if (!defined('PROJECT_ROOT')) {
                        require_once(dirname(dirname(dirname(__DIR__))) . '/config/paths.php');
                    }
                    
                    requireConfig();
                    $connection = new ConnectionsDatabase();
                    $pdo = $connection->connect();
                    $sql = "SELECT role FROM users WHERE id = :user_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':user_id' => $_SESSION['user_id']]);
                    $user = $stmt->fetch();
                    ?>
                    
                    <?php if ($user && $user['role'] === 'admin'): ?>
                        <a href="../admin/dashboard.php" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded mr-2">
                            <i class="fas fa-cog mr-1"></i>Administración
                        </a>
                    <?php endif; ?>
                    
                    <a href="../../Controllers/logout.php" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                        Cerrar Sesión
                    </a>
                <?php else: ?>
                    <a href="../login/login.php" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded mr-2">Iniciar Sesión</a>
                    <a href="../login/registration.php" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>