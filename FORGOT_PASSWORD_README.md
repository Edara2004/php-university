# Funcionalidad de Recuperación de Contraseña - Loopkin

## 🔑 Descripción
Sistema de recuperación de contraseña para usuarios que han olvidado sus credenciales de acceso. Permite a los usuarios recuperar su contraseña de forma segura mediante su nombre de usuario y email.

## ✨ Características Principales

### 🔐 Recuperación Segura
- **Validación de identidad** mediante username y email
- **Contraseña temporal** generada automáticamente
- **Encriptación segura** con hash bcrypt
- **Mensajes informativos** claros y útiles

### 🎨 Interfaz de Usuario
- **Diseño consistente** con el sistema de login
- **Efectos visuales** modernos y atractivos
- **Responsive design** para móviles y tablets
- **Animaciones suaves** para mejor UX

### 🛡️ Seguridad Implementada
- **Validación de campos** en frontend y backend
- **Prepared statements** para prevenir SQL injection
- **Mensajes de error** genéricos (no revelan información)
- **Logs de actividad** para auditoría

## 🚀 Cómo Funciona

### Flujo de Recuperación:
1. **Usuario olvida contraseña**
   - Accede a la página de login
   - Haz clic en "¿Olvidaste tu contraseña?"

2. **Ingresa información**
   - Nombre de usuario
   - Email registrado

3. **Sistema valida**
   - Verifica que username y email coincidan
   - Genera contraseña temporal segura

4. **Usuario recibe contraseña**
   - Se muestra en pantalla
   - Debe iniciar sesión inmediatamente

5. **Cambio de contraseña**
   - Usuario inicia sesión con contraseña temporal
   - Cambia a una contraseña permanente

## 🔧 Archivos Creados/Modificados

### Archivos Nuevos:
- `src/View/login/forgot-password.php` - Página principal de recuperación
- `src/View/login/forgot-password.css` - Estilos personalizados
- `FORGOT_PASSWORD_README.md` - Esta documentación

### Archivos Modificados:
- `src/View/login/login.php` - Agregado enlace "¿Olvidaste tu contraseña?"
- `src/Controllers/AdminController.php` - Agregada función `getUserByUsernameAndEmail`

## 🎯 Cómo Usar

### Para Usuarios:

1. **Acceder a recuperación**
   - Ve a la página de login
   - Haz clic en "¿Olvidaste tu contraseña?"

2. **Completar formulario**
   - Ingresa tu nombre de usuario
   - Ingresa tu email registrado
   - Haz clic en "Recuperar Contraseña"

3. **Recibir contraseña temporal**
   - El sistema mostrará tu nueva contraseña
   - Cópiala o anótala

4. **Iniciar sesión**
   - Ve al login
   - Usa tu username y la contraseña temporal

5. **Cambiar contraseña**
   - Una vez dentro, ve a "Mi Contraseña"
   - Cambia a una contraseña permanente

## 🛡️ Medidas de Seguridad

### Validaciones del Frontend:
- **Campos requeridos** validados
- **Formato de email** verificado
- **Prevención de envío** con datos inválidos

### Validaciones del Backend:
- **Verificación de identidad** username + email
- **Generación segura** de contraseña temporal
- **Encriptación** con `password_hash()`
- **Prepared statements** para prevenir SQL injection

### Características de Seguridad:
- **Contraseñas temporales** de 8 caracteres
- **Combinación aleatoria** de letras y números
- **Mensajes de error** genéricos
- **Logs de actividad** para auditoría

## 🎨 Diseño y UX

### Interfaz Visual:
- **Glass morphism** con efectos de transparencia
- **Animaciones suaves** en botones y enlaces
- **Iconos descriptivos** para mejor comprensión
- **Colores consistentes** con el sistema

### Efectos Interactivos:
- **Hover effects** en botones y enlaces
- **Focus states** mejorados en campos
- **Animaciones de mensajes** (slide in)
- **Efectos de pulsación** en botones

### Responsive Design:
- **Adaptable a móviles** y tablets
- **Botones optimizados** para touch
- **Texto legible** en pantallas pequeñas
- **Espaciado apropiado** para diferentes dispositivos

## 🔄 Flujo de Trabajo Técnico

### Proceso de Recuperación:
1. Usuario accede a `forgot-password.php`
2. Completa formulario con username y email
3. Sistema valida datos en `AdminController.php`
4. Si válido, genera contraseña temporal
5. Actualiza base de datos con nueva contraseña
6. Muestra contraseña temporal al usuario
7. Usuario inicia sesión y cambia contraseña

### Validaciones Implementadas:
- **Username no vacío** y válido
- **Email no vacío** y formato correcto
- **Combinación username+email** existe en BD
- **Generación exitosa** de contraseña temporal
- **Actualización exitosa** en base de datos

## 🐛 Solución de Problemas

### Error: "No se encontró un usuario"
- Verifica que el username sea correcto
- Confirma que el email esté bien escrito
- Asegúrate de que ambos coincidan en la BD

### Error: "Por favor, completa todos los campos"
- Llena tanto el username como el email
- No dejes espacios en blanco
- Verifica el formato del email

### Error: "Error al actualizar la contraseña"
- Verifica la conexión a la base de datos
- Revisa los logs del servidor
- Contacta al administrador

### Error: "Email inválido"
- Verifica el formato del email
- Asegúrate de incluir @ y dominio
- No uses espacios en el email

## 🔮 Futuras Mejoras

### Funcionalidades Sugeridas:
- **Envío por email** de contraseña temporal
- **Tokens de recuperación** con expiración
- **Preguntas de seguridad** adicionales
- **Verificación por SMS** (2FA)
- **Historial de recuperaciones** de contraseña

### Mejoras de UX:
- **Indicador de progreso** durante el proceso
- **Notificaciones push** de confirmación
- **Recordatorios** para cambiar contraseña
- **Sugerencias de contraseñas** seguras

### Mejoras de Seguridad:
- **Rate limiting** para prevenir abuso
- **Captcha** para formularios
- **Logs detallados** de intentos
- **Bloqueo temporal** después de múltiples intentos

## 📱 Compatibilidad

### Navegadores Soportados:
- **Chrome** (versión 60+)
- **Firefox** (versión 55+)
- **Safari** (versión 12+)
- **Edge** (versión 79+)

### Dispositivos:
- **Desktop** (Windows, Mac, Linux)
- **Tablets** (iPad, Android)
- **Móviles** (iPhone, Android)

## 📞 Soporte

Para reportar problemas o solicitar mejoras:

1. **Verifica la configuración:**
   - Base de datos conectada
   - Archivos en su lugar correcto
   - Permisos de archivo correctos

2. **Revisa los logs:**
   - Error logs del servidor
   - Logs de la aplicación
   - Logs de la base de datos

3. **Prueba en diferentes navegadores:**
   - Chrome, Firefox, Safari, Edge
   - Modo incógnito/privado

4. **Contacta al administrador:**
   - Proporciona detalles del error
   - Incluye pasos para reproducir
   - Adjunta capturas de pantalla si es posible

---

**Nota:** Esta funcionalidad está diseñada para ser segura, fácil de usar y compatible con el resto del sistema Loopkin. Sigue las mejores prácticas de desarrollo web moderno y seguridad. 