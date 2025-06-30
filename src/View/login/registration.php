<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="registration.css">
</head>
<body class="bg-gray-800">

<!-- Header -->

<?php require '../layouts/header.php'; ?>

<!-- Main -->
<main class="mb-20">

    <img src="../../../public/assets/img/background-image.avif" class="absolute inset-0 mt-10 w-full h-full object-cover brightness-30 z-[-1]">


    <div class="flex flex-col md:flex-row items-center justify-center gap-8 px-4 md:px-8 lg:px-16">
        <div class="w-full md:w-1/2 mt-8 md:mt-2 md:ml-2">

            <!-- Carrusel de imagenes -->

            <div id="default-carousel" class="relative w-full h-full mx-auto" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="mx-auto relative h-180 w-114 overflow-hidden ">
                    <!-- Foto 1 -->
                    <div class="hidden duration-700 ease-in-out rounded-xl" data-carousel-item>
                        <img src="../../../public/assets/img/the-avengers.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/avengers-age-of-ultron.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/avengers-end-game.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/avengers-infinity-war.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/captain-america-the-first-avenger.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 6 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/captain-america-the-winter-soldier.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 7 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/Guardian-of-galaxy.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 8 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/Guardian-of-galaxy-2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Foto 9 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../public/assets/img/Guardian-of-galaxy-3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <!-- Indicadores de Slider -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="5"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="6"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="7"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="8"></button>
                </div>
                <!-- Control de sliders-->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-0 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 shadow">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-0 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
        
        <!-- Login Form -->
        <div class="w-full md:w-1/2 mt-8 md:mt-0">
            <div class="flex justify-center md:justify-start w-full"> <div class="w-full max-w-lg p-6 shadow-lg bg-white/80 rounded-md shadow-xl/30">
                    <form action="../../Controllers/Registration.php" method="post">
                        <div class="columns-1">
                            <div>
                                <div class="bg-gray">
                                    <h1 class="font-mono text-center mb-2 text-4xl font-extrabold text-gray-800">Registro</h1>
                                    <hr class="mb-3">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                        <div>
                                            <label for="nombre"><b>Nombre</b></label>
                                            <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="text" name="nombre" placeholder="Nombre" required>
                                        </div>
                                        <div>
                                            <label for="apellido"><b>Apellido</b></label>
                                            <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="text" name="apellido" placeholder="Apellido" required>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <label for="cumpleanos"><b>Fecha de nacimiento</b></label>
                                            <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="date" name="cumpleanos" required>
                                        </div>
                                        <div>
                                            <label for="numero-de-telefono"><b>Telefono</b></label>
                                            <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="text" name="numero-de-telefono" placeholder="(+) 123-4567">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email-user"><b>Email</b></label>
                                        <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="email" name="email-user" placeholder="ejemplo@gmail.com" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="user"><b>Usuario</b></label>
                                        <input class="bg-gray-50 border border-gray-500 w-full rounded-md ps-2 h-9" type="text" name="user" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="UserPassword"><b>Contraseña</b></label>
                                        <div class="flex">
                                            <input class="bg-gray-50 border border-gray-500 rounded-l-md w-full ps-2 h-9" type="password" name="password" id="userPassword" required>
                                            <button class="bg-gray-50 border border-gray-500 border-l-0 rounded-r-md h-9 px-4 hover:bg-gray-500 dark:hover:text-white" type="button" id="button-addon2" onclick="togglePassword()">Mostrar</button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="UserPasswordR"><b>Repite la contraseña</b></label>
                                        <div class="flex">
                                            <input class="bg-gray-50 border border-gray-500 rounded-l-md w-full ps-2 h-9" type="password" name="UserPassword" id="userPasswordR" required>
                                            <button class="bg-gray-50 border border-gray-500 border-l-0 rounded-r-md h-9 px-4 hover:bg-gray-500 dark:hover:text-white" type="button" id="button-addon2" onclick="togglePassword2()">Mostrar</button>
                                        </div>
                                    </div>

                                    <div class="flex items-center mb-5">
                                        <div class="flex items-center h-5">
                                            <input id="terms" type="checkbox" value="" class="w-4 h-4">
                                            <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-500">Acepta <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terminos y condiciones</a></label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input class="bg-gray-600 text-white w-full rounded-md h-10 hover:bg-gray-700 cursor-pointer" type="submit" name="SingUp" value="Registrate">
                                    </div>
                                    
                                    <div>
                                        <div class="text-center">
                                            <label>¿Ya tienes </label><a href="login.php" class="text-blue-600 hover:underline dark:text-blue-500">cuenta </a><label>?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->

<?php require '../layouts/footer.php'; ?>

<script src="../../../public/assets/js/toggle-password.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>