<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="login.css">
</head>

<body class="bg-gray-800">


    <main class="h-full">
        <div class="fondo" style="background-image: url('../../../public/assets/img/background-image.avif'); background-repeat:no-repeat; background-size:cover ;background-position: center;">
            <div class="h-screen">

                <!-- Login form with all components -->
                <div class="flex justify-center place-items-center p-2 pr-4 pt-10 mb-70">
                    <div class="border bg-white/75 shadow-xl/90 rounded-md w-auto h-auto">

                        <!-- Login Form -->
                        <form action="../../Controllers/user.php" method="post">
                            <h1 class="text-center font-sans font-extrabold text-3xl md:text-4xl py-5 text-gray-700">Iniciar sesion</h1>

                            <div class="px-4 sm:px-6">
                                <div class="mb-4">
                                    <label for="userLogin" class=" block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                                    <input type="text" autocomplete="off" name="username" id="userLogin"
                                        class="border border-gray-800 rounded-md ps-3 py-1.5 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Tu nombre de usuario" required>
                                </div>

                                <div class="mb-6"> 
                                    <label for="password" class=" block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                                    <div class="flex items-center"> 
                                        <input class="border border-gray-800 focus:ring-2 focus:ring-blue-500 rounded-l-md ps-3 py-1.5 w-full"
                                            type="password" name="password" id="userPasswordId" placeholder="Tu contraseña" required>
                                        <button class="bg-white/80 border transition duration-350 border-gray-500 px-3 py-2 rounded-r-md hover:bg-gray-800 dark:hover:text-white/80 text-sm flex-shrink-0"
                                            type="button" id="button-addon2" onclick="togglePasswordLogin()">Mostrar</button>
                                    </div>
                                </div>

                                <!-- Redirecionar al registro de usuario -->
                                <div>
                                    <div class="text-center mb-3 ">
                                        <label>¿No tienes cuenta</label><a href="registration.php" class="text-blue-600 hover:underline dark:text-blue-500"> registrate </a><label>?</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3 text-center">
                                    <input class="bg-gray-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md w-full sm:w-auto cursor-pointer focus:outline-none focus:shadow-outline"
                                        type="submit" value="Ingresar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="../../../public/assets/js/toggle-password-login.js"></script>

</body>

</html>