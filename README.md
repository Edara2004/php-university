# 🎬 LOOPKIN - Plataforma de Streaming Universitaria

## 📖 **DESCRIPCIÓN**

**Loopkin** es una plataforma de streaming moderna desarrollada como proyecto universitario, diseñada para ofrecer una experiencia cinematográfica completa con funcionalidades avanzadas de gestión de usuarios y contenido multimedia.

## ✨ **CARACTERÍSTICAS PRINCIPALES**

### 🎯 **Sistema de Autenticación**
- ✅ **Registro de usuarios** con validación completa
- ✅ **Login seguro** con hash de contraseñas
- ✅ **Sesiones persistentes** y control de acceso
- ✅ **Gestión de roles** (Usuario/Administrador)
- ✅ **Recuperación de contraseñas** con sistema de tokens

### 🎬 **Gestión de Películas**
- ✅ **Integración con API de TMDb** para datos dinámicos
- ✅ **Información completa** de películas (sinopsis, elenco, directores)
- ✅ **Sistema de puntuaciones** y reseñas de usuarios
- ✅ **Trailers integrados** con modal interactivo
- ✅ **Películas similares** y recomendaciones
- ✅ **Búsqueda y filtros** avanzados

### 🎨 **Interfaz de Usuario**
- ✅ **Diseño responsive** con Tailwind CSS
- ✅ **Tema oscuro moderno** con efectos visuales
- ✅ **Animaciones suaves** y transiciones elegantes
- ✅ **Iconos Font Awesome** para mejor UX
- ✅ **Navegación intuitiva** y accesible

### ⚙️ **Panel de Administración**
- ✅ **Dashboard completo** con estadísticas
- ✅ **Gestión de usuarios** (crear, editar, eliminar)
- ✅ **Modo claro/oscuro** con persistencia
- ✅ **Sistema de notificaciones** en tiempo real
- ✅ **Funcionalidades avanzadas** de administración

## 🛠️ **TECNOLOGÍAS UTILIZADAS**

### **Backend**
- **PHP 8.0+** - Lenguaje principal del servidor
- **MySQL** - Base de datos relacional
- **PDO** - Acceso seguro a base de datos
- **Sessions** - Gestión de sesiones de usuario

### **Frontend**
- **HTML5** - Estructura semántica
- **CSS3** - Estilos y animaciones
- **JavaScript** - Interactividad del cliente
- **Tailwind CSS** - Framework de utilidades CSS

### **APIs y Servicios**
- **The Movie Database (TMDb)** - API de información de películas
- **Font Awesome** - Iconografía
- **Google Fonts** - Tipografías web

### **Herramientas de Desarrollo**
- **XAMPP** - Servidor local de desarrollo
- **Git** - Control de versiones
- **VS Code** - Editor de código

## 📁 **ESTRUCTURA DEL PROYECTO**

```
proyecto-universidad-tailwind/
├── 📁 config/
│   └── 📄 config.php                 # Configuración de la aplicación
├── 📁 public/
│   └── 📁 assets/
│       ├── 📁 css/                   # Estilos CSS
│       ├── 📁 img/                   # Imágenes y posters
│       ├── 📁 js/                    # Scripts JavaScript
│       └── 📄 index.php              # Página principal
├── 📁 src/
│   ├── 📁 Controllers/               # Controladores de la aplicación
│   │   ├── 📄 Registration.php       # Controlador de registro
│   │   ├── 📄 user.php               # Controlador de usuarios
│   │   └── 📄 logout.php             # Controlador de logout
│   ├── 📁 Services/                  # Servicios y APIs
│   │   ├── 📄 api-tmdb.php           # API de TMDb
│   │   └── 📄 api-tmdb-credits.php   # API de créditos
│   └── 📁 View/                      # Vistas de la aplicación
│       ├── 📁 layouts/               # Layouts reutilizables
│       │   ├── 📄 header.php         # Header principal
│       │   ├── 📄 header-user.php    # Header de usuario
│       │   └── 📄 footer.php         # Footer
│       ├── 📁 login/                 # Páginas de autenticación
│       │   ├── 📄 login.php          # Página de login
│       │   ├── 📄 registration.php   # Página de registro
│       │   └── 📄 *.css              # Estilos de autenticación
│       ├── 📁 pages/                 # Páginas principales
│       │   ├── 📄 home.php           # Página de inicio
│       │   └── 📁 movies/            # Páginas de películas
│       ├── 📁 admin/                 # Panel de administración
│       │   ├── 📄 dashboard.php      # Dashboard principal
│       │   ├── 📄 admin-config.php   # Configuración admin
│       │   └── 📄 *.css              # Estilos del admin
│       └── 📁 share/                 # Páginas compartidas
│           ├── 📄 licenses.php       # Licencias
│           ├── 📄 terms-and-conditions.php # Términos
│           └── 📄 politics-and-privacity.php # Privacidad
├── 📄 tokens.php                     # Tokens de API
├── 📄 tailwind.config.js             # Configuración de Tailwind
└── 📄 README.md                      # Documentación
```

## 🚀 **INSTALACIÓN Y CONFIGURACIÓN**

### **Requisitos Previos**
- PHP 8.0 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Extensión cURL habilitada
- Extensión PDO habilitada

### **Pasos de Instalación**

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/proyecto-universidad-tailwind.git
   cd proyecto-universidad-tailwind
   ```

2. **Configurar la base de datos**
   - Crear una base de datos MySQL llamada `loopkin_db`
   - Importar el archivo `setup_database.php` o ejecutar los scripts SQL

3. **Configurar las credenciales**
   - Editar `config/config.php` con tus credenciales de base de datos
   - Configurar el token de API de TMDb en `tokens.php`

4. **Configurar el servidor web**
   - Apuntar el DocumentRoot a la carpeta `public/`
   - Configurar las reglas de rewrite si es necesario

5. **Instalar dependencias**
   - Las dependencias están incluidas via CDN
   - No se requiere npm o composer

### **Configuración de la API**

Para obtener el token de TMDb:
1. Registrarse en [The Movie Database](https://www.themoviedb.org/)
2. Ir a Configuración > API
3. Solicitar una API key
4. Copiar el token a `tokens.php`

## 🎮 **FUNCIONALIDADES DETALLADAS**

### **🔐 Sistema de Autenticación**

#### **Registro de Usuarios**
- Validación de campos en tiempo real
- Verificación de email único
- Hash seguro de contraseñas
- Mensajes de error personalizados

#### **Inicio de Sesión**
- Autenticación segura
- Persistencia de sesiones
- Redirección automática según rol
- Protección contra ataques

#### **Gestión de Sesiones**
- Control de acceso por páginas
- Timeout automático de sesiones
- Logout seguro
- Limpieza de datos sensibles

### **🎬 Gestión de Películas**

#### **Integración con TMDb**
- Información completa de películas
- Posters y backdrops de alta calidad
- Elenco y equipo de producción
- Trailers oficiales de YouTube

#### **Funcionalidades Avanzadas**
- Sistema de puntuaciones
- Reseñas de usuarios
- Películas similares
- Búsqueda y filtros

### **⚙️ Panel de Administración**

#### **Dashboard Principal**
- Estadísticas de usuarios
- Gráficos interactivos
- Modo claro/oscuro
- Notificaciones en tiempo real

#### **Gestión de Usuarios**
- Lista de usuarios registrados
- Edición de perfiles
- Cambio de roles
- Eliminación segura

## 🎨 **DISEÑO Y UX**

### **Principios de Diseño**
- **Simplicidad**: Interfaz limpia y fácil de usar
- **Consistencia**: Patrones de diseño uniformes
- **Accesibilidad**: Navegación intuitiva
- **Responsividad**: Adaptable a todos los dispositivos

### **Paleta de Colores**
- **Primario**: Azul (#3B82F6)
- **Secundario**: Púrpura (#8B5CF6)
- **Fondo**: Gris oscuro (#1F2937)
- **Texto**: Blanco (#FFFFFF)

### **Tipografía**
- **Principal**: Inter (Google Fonts)
- **Monospace**: Para elementos especiales
- **Tamaños**: Escalable y responsive

## 🔒 **SEGURIDAD**

### **Medidas Implementadas**
- ✅ Hash seguro de contraseñas (password_hash)
- ✅ Protección contra SQL Injection (PDO)
- ✅ Validación de entrada de datos
- ✅ Control de sesiones seguro
- ✅ Escape de datos de salida
- ✅ Headers de seguridad

### **Buenas Prácticas**
- Validación tanto en cliente como servidor
- Sanitización de datos de entrada
- Logs de seguridad
- Timeout de sesiones
- Protección CSRF

## 📊 **BASE DE DATOS**

### **Estructura Principal**

#### **Tabla: users**
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### **Tabla: password_resets**
```sql
CREATE TABLE password_resets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🚀 **DESPLIEGUE**

### **Entorno de Desarrollo**
- XAMPP para desarrollo local
- Configuración de hosts virtuales
- Debugging habilitado

### **Entorno de Producción**
- Servidor web con SSL
- Base de datos optimizada
- Caché habilitado
- Logs de error configurados

## 🤝 **CONTRIBUCIÓN**

### **Cómo Contribuir**
1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

### **Estándares de Código**
- PSR-12 para PHP
- ESLint para JavaScript
- Comentarios descriptivos
- Nombres de variables claros

## 📝 **CHANGELOG**

### **Versión 1.0.0** (2024-01-XX)
- ✅ Sistema de autenticación completo
- ✅ Integración con API de TMDb
- ✅ Panel de administración
- ✅ Diseño responsive
- ✅ Sistema de recuperación de contraseñas
- ✅ Modo claro/oscuro
- ✅ Gestión de usuarios avanzada

## 📄 **LICENCIA**

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👥 **AUTORES**

- **Desarrollador Principal**: [Tu Nombre]
- **Universidad**: [Nombre de la Universidad]
- **Curso**: [Nombre del Curso]
- **Año**: 2024

## 🙏 **AGRADECIMIENTOS**

- **The Movie Database (TMDb)** por proporcionar la API gratuita
- **Tailwind CSS** por el framework de utilidades
- **Font Awesome** por los iconos
- **Google Fonts** por las tipografías

## 📞 **CONTACTO**

- **Email**: tu-email@ejemplo.com
- **GitHub**: [@tu-usuario](https://github.com/tu-usuario)
- **LinkedIn**: [Tu Perfil](https://linkedin.com/in/tu-perfil)

---

## 🎉 **CONCLUSIÓN**

**Loopkin** representa una plataforma de streaming moderna y completa, desarrollada con las mejores prácticas de programación web. El proyecto demuestra competencias avanzadas en desarrollo full-stack, integración de APIs, diseño de interfaces y gestión de bases de datos.

### **Logros Destacados**
- ✅ **Arquitectura escalable** y mantenible
- ✅ **Experiencia de usuario** excepcional
- ✅ **Seguridad robusta** implementada
- ✅ **Integración de APIs** externas
- ✅ **Diseño responsive** y moderno
- ✅ **Funcionalidades avanzadas** de administración

**¡Gracias por explorar Loopkin! 🎬✨**
