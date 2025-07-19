# Funcionalidad de Cambio de Contraseña - Loopkin

## 🗝️ Descripción
Sistema completo para cambiar contraseñas de usuarios en el panel de administración de Loopkin. Permite tanto a administradores cambiar contraseñas de otros usuarios como a usuarios cambiar su propia contraseña.

## ✨ Características

### 🔐 Cambio de Contraseña por Administradores
- **Botón de cambio** en la tabla de usuarios (ícono de llave verde)
- **Modal elegante** con validaciones
- **Confirmación de contraseña** para evitar errores
- **Mostrar/ocultar contraseña** con botón de ojo
- **Validación de longitud mínima** (6 caracteres)

### 👤 Cambio de Contraseña Personal
- **Página dedicada** para usuarios cambiar su propia contraseña
- **Información del usuario** mostrada en la página
- **Validaciones completas** de seguridad
- **Diseño consistente** con el resto del sistema

## 🚀 Cómo Usar

### Para Administradores:

1. **Acceder al panel de administración**
   - Inicia sesión como administrador
   - Ve a `src/View/admin/dashboard.php`

2. **Cambiar contraseña de un usuario**
   - En la tabla de usuarios, busca el usuario
   - Haz clic en el ícono de llave verde (🔑)
   - Completa el formulario:
     - Nueva contraseña (mínimo 6 caracteres)
     - Confirmar contraseña
   - Haz clic en "Cambiar Contraseña"

### Para Usuarios:

1. **Acceder a cambiar mi contraseña**
   - Inicia sesión en el sistema
   - Ve a `src/View/admin/change-my-password.php`
   - O haz clic en "Mi Contraseña" en el header del dashboard

2. **Completar el formulario**
   - Contraseña actual (para verificación)
   - Nueva contraseña (mínimo 6 caracteres)
   - Confirmar nueva contraseña
   - Haz clic en "Cambiar Contraseña"

## 🔧 Archivos Creados/Modificados

### Archivos Nuevos:
- `src/View/admin/change-my-password.php` - Página para cambiar contraseña personal

### Archivos Modificados:
- `src/Controllers/AdminController.php` - Agregada función `change_password`
- `src/View/admin/dashboard.php` - Agregado botón y modal de cambio de contraseña
- `src/View/admin/admin.js` - Agregadas funciones JavaScript

## 🛡️ Seguridad Implementada

### Validaciones del Frontend:
- **Longitud mínima** de 6 caracteres
- **Confirmación de contraseña** debe coincidir
- **Campos requeridos** validados
- **Prevención de envío** con datos inválidos

### Validaciones del Backend:
- **Verificación de permisos** de administrador
- **Validación de longitud** de contraseña
- **Encriptación segura** con `password_hash()`
- **Prepared statements** para prevenir SQL injection

### Características de Seguridad:
- **Contraseñas encriptadas** con hash bcrypt
- **Validación de sesión** en cada operación
- **Mensajes de error** genéricos (no revelan información)
- **Logs de actividad** para auditoría

## 🎨 Interfaz de Usuario

### Modal de Administrador:
- **Diseño moderno** con efectos glass morphism
- **Botones de mostrar/ocultar** contraseña
- **Validación en tiempo real** de campos
- **Mensajes de feedback** claros

### Página Personal:
- **Información del usuario** mostrada
- **Formulario intuitivo** con validaciones
- **Navegación fácil** de regreso al dashboard
- **Diseño responsive** para móviles

## 📱 Responsive Design

- **Funciona en móviles** y tablets
- **Botones adaptativos** según el tamaño de pantalla
- **Modales centrados** en cualquier dispositivo
- **Texto legible** en pantallas pequeñas

## 🔄 Flujo de Trabajo

### Cambio por Administrador:
1. Administrador selecciona usuario
2. Abre modal de cambio de contraseña
3. Ingresa nueva contraseña y confirmación
4. Sistema valida y actualiza
5. Mensaje de éxito/error mostrado

### Cambio Personal:
1. Usuario accede a la página
2. Ve su información personal
3. Completa formulario con contraseña actual
4. Sistema valida y actualiza
5. Mensaje de confirmación mostrado

## 🐛 Solución de Problemas

### Error: "Las contraseñas no coinciden"
- Verifica que ambos campos de contraseña sean idénticos
- Asegúrate de no tener espacios extra

### Error: "Contraseña muy corta"
- La contraseña debe tener al menos 6 caracteres
- Usa una combinación de letras, números y símbolos

### Error: "Acceso denegado"
- Verifica que tengas permisos de administrador
- Asegúrate de estar logueado correctamente

### Error: "Error de conexión"
- Verifica la conexión a la base de datos
- Revisa los logs del servidor

## 🔮 Futuras Mejoras

### Funcionalidades Sugeridas:
- **Historial de cambios** de contraseña
- **Política de contraseñas** más estricta
- **Notificación por email** al cambiar contraseña
- **Autenticación de dos factores** (2FA)
- **Expiración automática** de contraseñas

### Mejoras de UX:
- **Indicador de fortaleza** de contraseña
- **Sugerencias de contraseñas** seguras
- **Recuperación de contraseña** por email
- **Preguntas de seguridad** adicionales

## 📞 Soporte

Para reportar problemas o solicitar nuevas funcionalidades:
1. Verifica que todos los archivos estén en su lugar
2. Revisa los logs de error del servidor
3. Confirma que la base de datos esté actualizada
4. Prueba con diferentes navegadores

---

**Nota:** Esta funcionalidad está diseñada para ser segura y fácil de usar, siguiendo las mejores prácticas de desarrollo web moderno. 