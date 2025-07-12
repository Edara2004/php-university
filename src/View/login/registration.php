<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="registration.css">
</head>

<body class="bg-gray-800">

    <!-- Header -->

    <?php require '../layouts/header.php'; ?>

    <!-- Main -->
    <main>

        <div style="background-image: url('../../../public/assets/img/background-image.avif'); background-repeat:no-repeat; background-size:cover ;background-position: center;">
            <div class="flex flex-col md:flex-row items-center justify-center gap-8 px-4 md:px-8 lg:px-16 p-5">
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
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-0 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Formulario Login -->
                <div class="w-full md:w-1/2 mt-8 md:mt-0">
                    <div class="flex justify-center md:justify-start w-full">
                        <div class="w-full max-w-lg p-8 bg-gray-800 rounded-lg shadow-2xl relative z-10 text-white">
                            <form action="../../Controllers/Registration.php" method="post">
                                <div class="columns-1">
                                    <div>
                                        <!-- Registro -->
                                        <h1 class="font-sans text-center mb-6 text-4xl font-extrabold text-white">Registro</h1>
                                        <hr class="mb-6 border-gray-600">

                                        <!-- Campo Nombre y Apellido -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                            <div>
                                                <label for="nombre" class="block text-gray-300 text-sm font-bold mb-2">Nombre</label>
                                                <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="text" name="nombre" placeholder="Tu Nombre" required>
                                            </div>
                                            <div>
                                                <label for="apellido" class="block text-gray-300 text-sm font-bold mb-2">Apellido</label>
                                                <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="text" name="apellido" placeholder="Tu Apellido" required>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                            <!-- Fecha de nacimiento -->
                                            <div>
                                                <label for="cumpleanos" class="block text-gray-300 text-sm font-bold mb-2">Fecha de nacimiento</label>
                                                <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="date" name="cumpleanos" required>
                                            </div>

                                            <!-- Telefono -->
                                            <div>
                                                <label for="numero-de-telefono" class="block text-gray-300 text-sm font-bold mb-2">Teléfono</label>
                                                <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="text" name="numero-de-telefono" placeholder="(+) 123-4567">
                                            </div>
                                        </div>

                                        <!-- Genero en Combo-box-->
                                        <div class="mb-6">
                                            <label for="genero" class="block text-gray-300 text-sm font-bold mb-2">Género</label>
                                            <select id="genero" name="genero" required
                                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="" disabled selected>Selecciona tu género</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-6">
                                            <label for="email-user" class="block text-gray-300 text-sm font-bold mb-2">Email</label>
                                            <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                type="email" name="email-user" placeholder="ejemplo@gmail.com" required>
                                        </div>

                                        <!-- Usuario  -->
                                        <div class="mb-6">
                                            <label for="user" class="block text-gray-300 text-sm font-bold mb-2">Usuario</label>
                                            <input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                type="text" name="user" required>
                                        </div>

                                        <!-- Contraseña -->
                                        <div class="mb-6">
                                            <label for="UserPassword" class="block text-gray-300 text-sm font-bold mb-2">Contraseña</label>
                                            <div class="flex">
                                                <input class="bg-gray-700 border border-gray-600 rounded-l-md w-full px-3 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="password" name="password" id="userPassword" required>
                                                <button class="bg-gray-600 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-r-md border border-gray-600 border-l-0 transition duration-300 ease-in-out"
                                                    type="button" id="button-addon1" onclick="togglePassword('userPassword', 'button-addon1')">Mostrar</button>
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <label for="UserPasswordR" class="block text-gray-300 text-sm font-bold mb-2">Repite la contraseña</label>
                                            <div class="flex">
                                                <input class="bg-gray-700 border border-gray-600 rounded-l-md w-full px-3 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    type="password" name="UserPasswordR" id="userPasswordR" required>
                                                <button class="bg-gray-600 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-r-md border border-gray-600 border-l-0 transition duration-300 ease-in-out"
                                                    type="button" id="button-addon2" onclick="togglePassword2('userPasswordR', 'button-addon2')">Mostrar</button>
                                            </div>
                                        </div>

                                        <div class="flex items-center mb-6">
                                            <input id="terms" type="checkbox" value="" required
                                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-offset-gray-800 focus:ring-2">
                                            <label for="terms" class="ms-2 text-sm font-medium text-gray-300">Acepta <a href="#" class="text-blue-500 hover:underline">términos y condiciones</a></label>
                                        </div>

                                        <div class="mb-4">
                                            <input class="bg-blue-600 text-white w-full rounded-md h-10 hover:bg-blue-700 cursor-pointer font-bold py-2 px-4 transition duration-300 ease-in-out"
                                                type="submit" name="SingUp" value="Regístrate">
                                        </div>

                                        <div>
                                            <div class="text-center text-gray-400 text-sm">
                                                <label>¿Ya tienes </label><a href="login.php" class="text-blue-500 hover:underline">cuenta</a><label>?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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