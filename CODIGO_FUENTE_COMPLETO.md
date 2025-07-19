# 📚 CÓDIGO FUENTE COMPLETO - PROYECTO LOOPKIN

## 🎬 **PLATAFORMA DE STREAMING UNIVERSITARIA**

---

## 📁 **ESTRUCTURA DEL PROYECTO**

```
proyecto-universidad-tailwind/
├── config/
│   └── config.php
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── img/
│   │   ├── js/
│   │   └── index.php
│   └── movies/
├── src/
│   ├── Controllers/
│   ├── Helpers/
│   ├── Services/
│   └── View/
│       ├── layouts/
│       ├── login/
│       ├── pages/
│       ├── admin/
│       └── share/
└── tokens.php
```

---

## 🎯 **ARCHIVOS PRINCIPALES**

### **🔧 CONFIGURACIÓN**

#### **📄 tokens.php**
```php
<?php
/* The movie Database TOKEN */
$API_TOKEN_MOVIE = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhY2EzZDYxNTk1YTE4NGIxNjllNzY0ZGJmYWVhZmRiYSIsIm5iZiI6MTc1MTg0NDcxMy4wODQsInN1YiI6IjY4NmIwNzY5NDMyYjhlNzI5OTEwMzc3OSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.n5pkcESSO6OW0R2Ps1CnWmM33lHnRnIEQ-d913_q7po';
?>
```

#### **📄 config/config.php**
```php
<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'loopkin_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de la aplicación
define('APP_NAME', 'Loopkin');
define('APP_VERSION', '1.0.0');
?>
```

---

### **🎨 INTERFAZ DE USUARIO**

#### **📄 public/assets/index.php**
```php
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loopkin - Tu Plataforma de Streaming</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-gray-900 text-white">
    <div class="h-screen relative flex items-center justify-center p-4"
         style="background-image: url('../assets/img/background-index.jpg'); background-size: cover; background-position: center;">
        <div class="w-full max-w-4xl text-center z-10">
            <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-mono font-semibold mb-8 md:mb-12 leading-tight">
                ¡Bienvenidos a su plataforma de streaming favorita!
            </h1>
            <div class="flex justify-center">
                <form action="../../src/View/login/registration.php" class="items-center">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md w-full sm:w-auto cursor-pointer focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                        ¡Vamos!
                    </button>
                </form>
            </div>
        </div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-80 text-white p-4 text-center z-20">
            <p class="text-xs sm:text-sm">
                Recuerda leer los términos y condiciones, nuestra app no tiene la intención de violentar los derechos de autor, mucho menos será usada con fines de lucro.
            </p>
        </div>
    </div>
</body>
</html>
```

#### **📄 public/assets/css/index.css**
```css
/* Animación de escritura */
@keyframes typing {
    from { width: 0; }
    to { width: 100%; }
}

.typing-animation {
    overflow: hidden;
    border-right: 2px solid #3b82f6;
    white-space: nowrap;
    animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
}

@keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: #3b82f6; }
}
```

---

### **🔐 SISTEMA DE AUTENTICACIÓN**

#### **📄 src/View/login/login.php**
```php
<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../../pages/home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Loopkin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>

<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center p-4"
         style="background-image: url('../../../public/assets/img/background-image.avif'); background-size: cover; background-position: center;">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 rounded-lg shadow-2xl p-8 border border-gray-700">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Iniciar Sesión</h1>
                    <p class="text-gray-400">Accede a tu cuenta de Loopkin</p>
                </div>
                
                <form action="../../Controllers/user.php" method="post" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2"></i>Contraseña
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                            <button type="button" onclick="togglePassword()" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-400">
                        ¿No tienes cuenta? 
                        <a href="registration.php" class="text-blue-400 hover:text-blue-300 transition-colors">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../../../public/assets/js/toggle-password-login.js"></script>
</body>
</html>
```

#### **📄 src/View/login/registration.php**
```php
<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../../pages/home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Loopkin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="registration.css">
</head>

<body class="bg-gray-900 text-white">
    <div style="background-image: url('../../../public/assets/img/background-image.avif'); background-repeat:no-repeat; background-size:cover ;background-position: center;">
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 px-4 md:px-8 lg:px-16 p-5">
            <div class="w-full md:w-1/2 mt-8 md:mt-2 md:ml-2">
                <!-- Carousel -->
                <div id="default-carousel" class="relative w-full h-full mx-auto" data-carousel="slide">
                    <div class="mx-auto relative h-180 w-114 overflow-hidden ">
                        <img src="../../../public/assets/img/the-avengers.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    </div>
                    <button type="button" class="absolute top-1/2 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-1/2 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-8 md:mt-0">
                <div class="flex justify-center md:justify-start w-full">
                    <div class="w-full max-w-lg p-8 bg-gray-800 rounded-lg shadow-2xl relative z-10 text-white">
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h1>
                            <p class="text-gray-400">Únete a Loopkin y disfruta del mejor contenido</p>
                        </div>
                        
                        <form action="../../Controllers/Registration.php" method="post" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-user mr-2"></i>Nombre
                                    </label>
                                    <input type="text" id="first_name" name="first_name" required
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-user mr-2"></i>Apellido
                                    </label>
                                    <input type="text" id="last_name" name="last_name" required
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                                </label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                            </div>
                            
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-at mr-2"></i>Nombre de Usuario
                                </label>
                                <input type="text" id="username" name="username" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-lock mr-2"></i>Contraseña
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 text-white placeholder-gray-400 transition-colors">
                                    <button type="button" onclick="togglePassword()" 
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 transform hover:scale-105">
                                <i class="fas fa-user-plus mr-2"></i>Crear Cuenta
                            </button>
                        </form>
                        
                        <div class="mt-6 text-center">
                            <p class="text-gray-400">
                                ¿Ya tienes cuenta? 
                                <a href="login.php" class="text-blue-400 hover:text-blue-300 transition-colors">
                                    Inicia sesión aquí
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../../../public/assets/js/toggle-password.js"></script>
    <script src="../../../public/assets/js/register-alerts.js"></script>
</body>
</html>
```

---

### **🎬 PÁGINAS DE PELÍCULAS**

#### **📄 src/View/pages/home.php**
```php
<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login/login.php');
    exit();
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a202c;
        }
    </style>
</head>

<body class="bg-gray-800">
    <header><?php require '../layouts/header-user.php' ?></header>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-white text-4xl font-bold mb-8 md:mb-10 text-center md:text-left">Películas disponibles</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6 lg:gap-8">
            <a href="movies/the-avengers.php?imdb_id=tt0848228" class="block relative rounded-lg overflow-hidden border border-gray-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 group">
                <img src="../../../public/assets/img/the-avengers.jpg" alt="The Avengers Poster" class="w-full h-auto object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center p-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-semibold text-lg leading-tight mb-2">The Avengers</p>
                    <i class="fas fa-play-circle text-blue-500 text-5xl group-hover:text-blue-400 transition-colors duration-300"></i>
                </div>
            </a>
            <!-- Más películas aquí... -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
```

---

### **🎮 CONTROLADORES**

#### **📄 src/Controllers/Registration.php**
```php
<?php
session_start();

require_once '../../config/paths.php';
requireConfig();

class RegistrationController {
    private $connection;
    
    public function __construct() {
        $this->connection = new ConnectionsDatabase();
    }
    
    public function register($data) {
        try {
            $pdo = $this->connection->connect();
            
            // Validar datos
            $this->validateData($data);
            
            // Verificar si el usuario ya existe
            if ($this->userExists($data['email'], $data['username'])) {
                return ['success' => false, 'message' => 'El usuario ya existe'];
            }
            
            // Hash de la contraseña
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Insertar usuario
            $sql = "INSERT INTO users (first_name, last_name, email, username, password, role, created_at) 
                    VALUES (:first_name, :last_name, :email, :username, :password, 'user', NOW())";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':email' => $data['email'],
                ':username' => $data['username'],
                ':password' => $hashedPassword
            ]);
            
            return ['success' => true, 'message' => 'Usuario registrado exitosamente'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error en el registro: ' . $e->getMessage()];
        }
    }
    
    private function validateData($data) {
        if (empty($data['first_name']) || empty($data['last_name']) || 
            empty($data['email']) || empty($data['username']) || empty($data['password'])) {
            throw new Exception('Todos los campos son requeridos');
        }
        
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email inválido');
        }
        
        if (strlen($data['password']) < 6) {
            throw new Exception('La contraseña debe tener al menos 6 caracteres');
        }
    }
    
    private function userExists($email, $username) {
        $pdo = $this->connection->connect();
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email OR username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email, ':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }
}

// Procesar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new RegistrationController();
    $result = $controller->register($_POST);
    
    if ($result['success']) {
        $_SESSION['success_message'] = $result['message'];
        header('Location: ../login/login.php');
    } else {
        $_SESSION['error_message'] = $result['message'];
        header('Location: ../login/registration.php');
    }
    exit();
}
?>
```

#### **📄 src/Controllers/user.php**
```php
<?php
session_start();

require_once '../../config/paths.php';
requireConfig();

class UserController {
    private $connection;
    
    public function __construct() {
        $this->connection = new ConnectionsDatabase();
    }
    
    public function login($email, $password) {
        try {
            $pdo = $this->connection->connect();
            
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                return ['success' => true, 'message' => 'Login exitoso'];
            } else {
                return ['success' => false, 'message' => 'Credenciales inválidas'];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error en el login: ' . $e->getMessage()];
        }
    }
}

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $result = $controller->login($_POST['email'], $_POST['password']);
    
    if ($result['success']) {
        header('Location: ../../pages/home.php');
    } else {
        $_SESSION['error_message'] = $result['message'];
        header('Location: ../login/login.php');
    }
    exit();
}
?>
```

---

### **🎬 SERVICIOS DE API**

#### **📄 src/Services/api-tmdb.php**
```php
<?php
require_once __DIR__ . '/../../tokens.php';

$API_TOKEN = $API_TOKEN_MOVIE;
$imdb_id = $_GET['imdb_id'] ?? null;

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.themoviedb.org/3/find/{$imdb_id}?external_source=imdb_id&language=es",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer {$API_TOKEN}",
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $movie = json_decode($response);
    if (isset($movie->movie_results[0])) {
        $data = $movie->movie_results[0];
        
        $adult = $data->adult;
        $title = $data->title;
        $overview = $data->overview;
        $images = $data->poster_path;
        $get_image = "<img src='https://image.tmdb.org/t/p/w500{$images}'>";
        $release_date = $data->release_date;
        $vote_average = $data->vote_average;
        $vote_count = $data->vote_count;
        $original_language = $data->original_language;
    } else {
        echo "No se encontró información de la película con el ID de IMDb: " . $imdb_id;
    }
}
?>
```

#### **📄 src/Services/api-tmdb-credits.php**
```php
<?php
require_once __DIR__ . '/../../tokens.php';

$API_TOKEN = $API_TOKEN_MOVIE;
$movie_id = $_GET['imdb_id'] ?? null;
$actors = [];

if (!empty($movie_id)) {
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/{$movie_id}/credits?language=es",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$API_TOKEN}",
            "accept: application/json"
        ],
    ]);

    $response_credits = curl_exec($curl);
    $err_credits = curl_error($curl);
    curl_close($curl);

    if (!$err_credits) {
        $credits_data = json_decode($response_credits, true);
        
        if (isset($credits_data['cast']) && is_array($credits_data['cast']) && !empty($credits_data['cast'])) {
            $actors_to_display = array_slice($credits_data['cast'], 0, 20);
            
            foreach ($actors_to_display as $actor_data) {
                $profile_path = $actor_data['profile_path'] ?? null;
                $actor_image_url = $profile_path ? "https://image.tmdb.org/t/p/w185{$profile_path}" : 'https://via.placeholder.com/185x278?text=No+Image';
                
                $actors[] = [
                    'name' => $actor_data['name'] ?? 'Actor Desconocido',
                    'character' => $actor_data['character'] ?? 'Personaje Desconocido',
                    'profile_path' => $actor_image_url
                ];
            }
        }
    }
}
?>
```

---

### **🎨 LAYOUTS**

#### **📄 src/View/layouts/header.php**
```php
<header>
    <nav class="bg-gray-800 border-gray-200 dark:bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../../../public/assets/index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="text-type-writer font-bold text-2xl text-white whitespace-nowrap hover:text-blue-400 transition duration-300">Loopkin</span>
            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center">
                <a href="../../../src/View/login/login.php" class="text-gray-800 transition duration-350 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-500 focus:outline-none dark:focus:ring-gray-800 hidden md:inline-block">Ingresar</a>
                <a href="/proyecto-universidad-tailwind/src/View/login/registration.php" class="text-white transition duration-350 bg-gray-700 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-gray-600 dark:hover:bg-gray-400 focus:outline-none dark:focus:ring-gray-800 ml-2 hidden md:inline-block">Registrate</a>

                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-800 dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">
                    <li>
                        <a href="/proyecto-universidad-tailwind/src/View/login/login.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Ingresar</a>
                    </li>
                    <li>
                        <a href="/proyecto-universidad-tailwind/src/View/login/registration.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Registrate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
```

#### **📄 src/View/layouts/header-user.php**
```php
<header class="bg-gray-800 shadow-md sticky top-0 z-50">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <nav class="bg-gray-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../../index.php" class="text-2xl font-bold">Loopkin</a> 
            <div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <span class="mr-4">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    
                    <?php
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
```

---

### **🎮 JAVASCRIPT**

#### **📄 public/assets/js/toggle-password.js**
```javascript
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
```

#### **📄 public/assets/js/toggle-password-login.js**
```javascript
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
```

#### **📄 public/assets/js/register-alerts.js**
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar mensajes de éxito
    const successMessage = '<?php echo isset($_SESSION["success_message"]) ? $_SESSION["success_message"] : ""; ?>';
    if (successMessage) {
        showAlert(successMessage, 'success');
        <?php unset($_SESSION["success_message"]); ?>
    }
    
    // Mostrar mensajes de error
    const errorMessage = '<?php echo isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : ""; ?>';
    if (errorMessage) {
        showAlert(errorMessage, 'error');
        <?php unset($_SESSION["error_message"]); ?>
    }
});

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    alertDiv.textContent = message;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
```

---

## 🎯 **CARACTERÍSTICAS PRINCIPALES**

### **🔐 Sistema de Autenticación**
- Registro de usuarios con validación
- Login seguro con hash de contraseñas
- Sesiones persistentes
- Control de acceso por roles

### **🎬 Gestión de Películas**
- Integración con API de TMDb
- Información dinámica de películas
- Elenco y créditos
- Puntuaciones y reseñas

### **🎨 Interfaz de Usuario**
- Diseño responsive con Tailwind CSS
- Tema oscuro moderno
- Animaciones suaves
- Iconos Font Awesome

### **⚙️ Panel de Administración**
- Gestión de usuarios
- Estadísticas del sistema
- Modo claro/oscuro
- Funcionalidades avanzadas

---

## 🚀 **TECNOLOGÍAS UTILIZADAS**

- **Backend**: PHP 8.0+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Tailwind CSS
- **Base de Datos**: MySQL
- **API Externa**: The Movie Database (TMDb)
- **Iconos**: Font Awesome
- **Validación**: JavaScript + PHP

---

## 📋 **REQUISITOS DEL SISTEMA**

- PHP 8.0 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Extensión cURL habilitada
- Extensión PDO habilitada

---

## 🎉 **CONCLUSIÓN**

Este proyecto representa una plataforma de streaming completa desarrollada con tecnologías modernas, ofreciendo una experiencia de usuario excepcional y funcionalidades avanzadas para la gestión de contenido multimedia. 