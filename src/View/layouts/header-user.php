<header class="bg-gray-800 shadow-md sticky top-0 z-50">
    <nav class="max-w-screen-xl mx-auto p-4 flex flex-wrap items-center justify-between">
        <!-- Logo -->
        <a href="/proyecto-universidad-tailwind/src/View/pages/home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="text-type-writer font-bold text-2xl text-white whitespace-nowrap hover:text-blue-400 transition duration-300">Loopkin</span>
        </a>

        <!-- Botón de menú para móviles (se ocualta en pantallas grandes) -->
        <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
            <span class="sr-only">Abrir menú principal</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Contenedor de la navegación -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto" id="navbar-search">
            <!-- Navegación principal -->
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-700 rounded-lg bg-gray-800 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-800">
                <li>
                    <a href="../pages/home.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-400 md:p-0 hover:text-blue-300" aria-current="page">Inicio</a>
                </li>

                <li>
                    <a href="#" class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-blue-400 md:p-0">Perfil</a>
                </li>
            </ul>
        </div>
    </nav>
</header>