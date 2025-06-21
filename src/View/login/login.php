<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-800">

<!-- Header -->

<?php
require '../../View/layouts/header.php';
?>

<main>
    <div>
        <!-- Screen size -->
        <div class="h-screen">

            <div class="text-center">
                <div class="animate-pulse">
                    <h1 class="mt-5 text-3xl font-extrabold leading-tight text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">¡Bienvenidos!</span></h1>
                </div>
            </div>

            <!-- Login form with all components -->
            <div class="flex justify-center place-items-center p-2 pr-4 pt-10 mb-70">
                <div class="border border-white bg-white/80 shadow-xl/30 rounded-md w-100 h-55">
                    
                    <!-- Login Form -->
                    <form action="../../Controllers/user.php">
                        <h1 class="text-center font-mono font-extrabold text-4xl py-5">Login</h1>

                        <!-- User -->
                        <div class="mb-3">
                            <div class="mb-3 grid grid-cols-2">
                                <div class="col-span-2">
                                    <label for="userLogin" class="p-2 ml-10 text-center">Usuario</label>
                                    <input type="text" name="username" class="border border-gray-800 rounded-md ps-3 h-7 mr-5">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-5 grid grid-cols-2">
                                <div class="col-span-2">
                                    <label for="password" class="p-2 ml-3.5">Contraseña</label>
                                    <input class="border border-gray-800 focus:ring-white focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md ps-3 h-7" type="password" name="password" id="userPasswordId">
                                    <button class="bg-white/80 border transition duration-350 border-gray-500 px-3 w-20 rounded-md h-7 hover:bg-gray-800 dark:hover:text-white/80" type="button" id="button-addon2" onclick="togglePasswordLogin()">Mostrar</button>
                                </div>
                            </div>

                            <!-- Enter button -->
                            <div class="mb-3 text-center">
                                <input class="bg-white/40 transition duration-350 border border-gray-500 w-60 rounded-md h-8 hover:bg-gray-800 dark:hover:text-white" type="submit" name="SingUp" value="Ingresar">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php require '../../View/layouts/footer.php'; ?>

<!-- Scripts -->
<script src="../../../public/assets/js/toggle-password-login.js"></script>

</body>
</html>