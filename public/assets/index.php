<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-gray-800">


    <!-- Header -->

    <header><?php require '../../src/View/layouts/header-login.php' ?></header>

    <!-- Main -->
    <main>
        <div class="h-screen relative" style="background-image: url('../assets/img/background-index.jpg'); background-size:cover ;background-position: center;">
            <div>
                <div class="w-full h-full">
                    <div class="">
                        <H1 class="text-white text-4xl font-mono font-semibold flex justify-center pt-50 text-type-writer mb-25">!Bienvenidos a su plataforma de streaming favorita!</H1>
                        <div class="flex justify-center">
                            <div class="gap-5">
                                <input class="w-60 h-10 ml-1 px-2 border border-black rounded-sm p-2 text-white bg-gray-800/80 shadow-md" type="text" placeholder="ejemplo@gmail.com">
                                <input class=" bg-gray-800 text-center hover:bg-blue-600 text-white font-bold py-2 px-2 rounded-md w-full sm:w-auto cursor-pointer focus:outline-none focus:shadow-outline mb-5"
                                    type="buttom" value="¡Vamos!">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full bg-gray-900 text-white p-4 text-center">
                <p class="text-sm text-type-writer">Recuerda leer los terminos y condiciones, nuestra app no tiene la intención de violentar los derechos de autor, mucho menos será usada con fines de lucro.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer><?php require '../../src/View/layouts/footer.php' ?></footer>

</body>

</html>