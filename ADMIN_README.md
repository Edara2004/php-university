# Sistema de Administración - Loopkin

## Descripción
Sistema CRUD completo para la gestión de usuarios en la plataforma Loopkin. Permite a los administradores crear, leer, actualizar y eliminar usuarios del sistema.

## Características

### 🎯 Funcionalidades Principales
- **Dashboard con estadísticas** en tiempo real
- **Gestión completa de usuarios** (CRUD)
- **Sistema de roles** (Usuario/Administrador)
- **Control de estados** (Activo/Inactivo)
- **Interfaz moderna** con Tailwind CSS
- **Operaciones AJAX** para mejor experiencia de usuario
- **Validaciones de seguridad** y permisos

### 📊 Dashboard
- Total de usuarios registrados
- Usuarios activos e inactivos
- Número de administradores
- Estadísticas actualizadas en tiempo real

### 👥 Gestión de Usuarios
- **Crear usuarios** con roles específicos
- **Editar información** de usuarios existentes
- **Activar/Desactivar** cuentas de usuario
- **Eliminar usuarios** (con confirmación)
- **Cambiar roles** entre usuario y administrador

## Instalación

### 1. Actualizar la Base de Datos
Ejecuta el script SQL para agregar los campos necesarios:

```sql
-- Ejecutar el archivo database_update.sql en tu base de datos MySQL
mysql -u root -p useraccounts < database_update.sql
```

### 2. Verificar la Estructura de Archivos
Asegúrate de que los siguientes archivos estén en su lugar:

```
src/
├── Controllers/
│   └── AdminController.php
├── View/
│   └── admin/
│       ├── dashboard.php
│       ├── admin.js
│       └── admin-config.php
└── database_update.sql
```

### 3. Configurar Permisos
El sistema creará automáticamente un usuario administrador:
- **Usuario:** admin
- **Contraseña:** admin123
- **Email:** admin@loopkin.com

## Uso

### Acceso al Panel de Administración
1. Inicia sesión con una cuenta de administrador
2. Navega a: `src/View/admin/dashboard.php`
3. El sistema verificará automáticamente los permisos

### Operaciones Disponibles

#### Crear Usuario
1. Haz clic en "Nuevo Usuario"
2. Completa el formulario:
   - Usuario (requerido)
   - Email (requerido)
   - Contraseña (mínimo 6 caracteres)
   - Rol (Usuario/Administrador)
3. Haz clic en "Crear Usuario"

#### Editar Usuario
1. Haz clic en el ícono de editar (✏️) junto al usuario
2. Modifica los campos necesarios
3. Haz clic en "Actualizar Usuario"

#### Cambiar Estado
1. Haz clic en el ícono de toggle (🔄) junto al usuario
2. El estado cambiará automáticamente entre activo/inactivo

#### Eliminar Usuario
1. Haz clic en el ícono de eliminar (🗑️) junto al usuario
2. Confirma la acción en el diálogo
3. El usuario será eliminado permanentemente

## Seguridad

### Validaciones Implementadas
- **Verificación de permisos** de administrador
- **Sanitización de entradas** de usuario
- **Validación de email** y contraseñas
- **Protección CSRF** (tokens de seguridad)
- **Logs de actividad** del administrador

### Medidas de Seguridad
- Los administradores no pueden eliminarse a sí mismos
- Las contraseñas se hashean con `password_hash()`
- Todas las consultas SQL usan prepared statements
- Validación de sesiones en cada operación

## Estructura de la Base de Datos

### Tabla `users` (actualizada)
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Users VARCHAR(255) NOT NULL,
    UserPasswords VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Personalización

### Modificar Roles
Para agregar nuevos roles, edita el archivo `admin-config.php`:

```php
// Agregar nuevos roles
define('USER_ROLE_MODERATOR', 'moderator');

// Actualizar la función getRoleName()
function getRoleName($role) {
    $roles = [
        'user' => 'Usuario',
        'admin' => 'Administrador',
        'moderator' => 'Moderador' // Nuevo rol
    ];
    return $roles[$role] ?? ucfirst($role);
}
```

### Cambiar Estilos
El sistema usa Tailwind CSS. Puedes personalizar los estilos modificando las clases en:
- `dashboard.php` (interfaz principal)
- `admin.js` (mensajes y modales)

### Agregar Nuevas Funcionalidades
1. Agrega métodos en `AdminController.php`
2. Crea las vistas correspondientes
3. Implementa el JavaScript necesario en `admin.js`

## Troubleshooting

### Problemas Comunes

#### Error de Conexión a la Base de Datos
- Verifica la configuración en `config/config.php`
- Asegúrate de que MySQL esté ejecutándose
- Confirma que la base de datos `useraccounts` existe

#### Error de Permisos
- Verifica que el usuario tenga rol 'admin' en la base de datos
- Confirma que la sesión esté activa
- Revisa los logs de error de PHP

#### Campos Faltantes en la Base de Datos
- Ejecuta nuevamente el script `database_update.sql`
- Verifica que todas las columnas se hayan creado correctamente

### Logs
El sistema genera logs de actividad en:
- `src/View/admin/admin-activity.log` (actividad del administrador)
- Logs de error de PHP (configuración del servidor)

## Soporte

Para reportar problemas o solicitar nuevas funcionalidades:
1. Revisa los logs de error
2. Verifica la configuración de la base de datos
3. Confirma que todos los archivos estén en su lugar

## Licencia
Este sistema de administración es parte del proyecto Loopkin y sigue las mismas licencias del proyecto principal. 