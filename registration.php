<?php
require_once("config.php");
require_once("utils/encrypt-registration.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-800">

<div class="flex justify-center items-center h-screen">
    <!-- Login Form -->
    <div class="w-95 p-6 shadows-lg bg-white rounded-md">
        <form action="registration.php" method="post">
            <div class="columns-1">
                <div>
                    <div class="bg-gray">
                        <h1 class="text-4xl text-center mb-2 text-4xl font-extrabold text-gray-800">Registrate</h1>
                        <hr class="mb-3">

                        <!-- Name section -->
                        <div>
                            <div class="columns-2">
                                <div class="columns-2 mb-6">
                                    <label for="name"><b>Nombre</b></label>
                                    <input class="bg-gray-50 border border-gray-500 w-40 rounded-md ps-2 h-7" type="text" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="columns-2">
                                    <label for="last-name"><b>Apellido</b></label>
                                    <input class="bg-gray-50 border border-gray-500 w-40 rounded-md ps-2 h-7" type="text" name="last-name" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>

                        <!-- Date of birth -->
                        <div class="columns-2" >
                            <label for="birthday"><b>Fecha de nacimiento</b></label>
                            <div>
                                <input class="bg-gray-50 border border-gray-500 col-span-2 mb-3 rounded-md w-40 ps-2 h-7 pt-center" type="date" name="birthday" required>
                            </div>
                        
                        <!-- Phone number -->
                            <label for="phone-number"><b>Telefono</b></label>
                            <div>
                                <input class="bg-gray-50 border border-gray-500 col-span-2 mb-3 rounded-md w-40 ps-2 h-7 pt-center" type="text" name="phone-number" placeholder="(+) 123-4567">
                            </div>
                        </div>


                        <!-- Email section-->
                        <div >
                            <label for="email-user"><b>Email</b></label>
                            <div>
                                <input class="bg-gray-50 border border-gray-500 mb-3 rounded-md w-84 ps-2 h-7" type="text" name="email-user" placeholder="ejemplo@gmail.com" required>
                            </div>    
                        </div>

                        <!-- User section -->
                        <div >
                            <label for="user"><b>Usuario</b></label>
                            <div>
                                <input class="bg-gray-50 border border-gray-500 col-span-2 mb-3 rounded-md w-84 ps-2 h-7" type="text" name="user" required>
                            </div>
                        </div>

                        <!-- Password section -->
                        <div >
                            <label for="UserPassword"><b>Contraseña</b></label>
                            <div class="mb-3">
                                <input class="bg-gray-50 border border-gray-500 rounded-md w-61 ps-2 h-7" type="password" name="UserPassword" id="userPassword" required>
                                <button class="bg-gray-50 border border-gray-500 w-20 rounded-md h-7 hover:bg-gray-500 dark:hover:text-white" type="button" id="button-addon2" onclick="togglePassword()">Mostrar</button>
                            </div>
                        </div>

                        <div >
                            <label for="UserPassword"><b>Repite la contraseña</b></label>
                            <div class="input-group mb-3">
                                <input class="bg-gray-50 border border-gray-500 rounded-md w-61 ps-2 h-7" type="password" name="UserPassword" id="userPasswordR" required>
                                <button class="bg-gray-50 border border-gray-500 w-20 rounded-md h-7 hover:bg-gray-500 dark:hover:text-white" type="button" id="button-addon2" onclick="togglePassword2()">Mostrar</button>
                            </div>
                        </div>

                        <!-- Terms and conditions -->
                        <div class="flex items-start mb-5">
                            <div class="flex items-center h-5">
                                <input id="terms" type="checkbox" value="" class="w-4 h-4">
                                <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-500">Acepta <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terminos y condiciones</a></label>
                            </div>
                        </div>

                        <!-- Register Buttom -->
                        <div class="text-start">
                            <input class="bg-gray-50 border border-gray-500 w-85 rounded-md h-10 hover:bg-gray-500 dark:hover:text-white" type="submit" name="SingUp" value="Registrate">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    
<script src="js/toggle-password.js"></script>
</body>
</html>