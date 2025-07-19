<header class="bg-gray-800 shadow-md sticky top-0 z-50">
    <nav class="bg-gray-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../../index.php" class="text-2xl font-bold">Loopkin</a> 
            <div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <span class="mr-4">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    
                    
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