<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-gray-800">


    <!-- Header -->

    <header><?php require '../../src/View/layouts/header.php' ?></header>

    <!-- Main -->
    <main>
        <!-- Contenedor principal con imagen de fondo y altura completa de la pantalla -->
        <div class="h-screen relative flex items-center justify-center p-4"
            style="background-image: url('../assets/img/background-index.jpg'); background-size: cover; background-position: center;">

            <!-- Contenedor para el contenido principal (título y formulario) -->
            <div class="w-full max-w-4xl text-center z-10">
                <!-- Título principal responsivo -->
                <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-mono font-semibold mb-8 md:mb-12 leading-tight">
                    ¡Bienvenidos a su plataforma de streaming favorita!
                </h1>

                <!-- Contenedor del formulario -->
                <div class="flex justify-center">
                    <form action="../../src/View/login/registration.php" class="flex flex-col sm:flex-row items-center gap-4 w-full max-w-md">
                        <!-- Campo de entrada de correo electrónico -->
                        <input
                            class="w-full sm:w-60 h-10 px-4 rounded-md text-white bg-gray-800/80 shadow-md
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
                            type="email"
                            placeholder="Tu correo aquí"
                            required>
                        <!-- Botón de envío -->
                        <button
                            type="submit"
                            class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md
                                   w-full sm:w-auto cursor-pointer focus:outline-none focus:shadow-outline
                                   transition duration-300 ease-in-out transform hover:scale-105">
                            ¡Vamos!
                        </button>
                    </form>
                </div>
            </div>

            <!-- Capa de superposición para oscurecer la imagen de fondo y mejorar la legibilidad del texto -->
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <!-- Pie de página responsivo -->
            <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-80 text-white p-4 text-center z-20">
                <p class="text-xs sm:text-sm">
                    Recuerda leer los términos y condiciones, nuestra app no tiene la intención de violentar los derechos de autor, mucho menos será usada con fines de lucro.
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer><?php require '../../src/View/layouts/footer.php' ?></footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>