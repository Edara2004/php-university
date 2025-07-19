// Funciones para el panel de administración

// Función para mostrar mensajes de éxito o error
function showMessage(message, type = 'success') {
    const container = document.getElementById('messageContainer');
    const content = document.getElementById('messageContent');
    const icon = document.getElementById('messageIcon');
    const text = document.getElementById('messageText');

    // Configurar el estilo según el tipo de mensaje
    if (type === 'success') {
        content.className = 'p-4 rounded-lg shadow-lg max-w-sm bg-green-100 border border-green-400 text-green-700';
        icon.className = 'fas fa-check-circle mr-3 text-xl text-green-500';
    } else {
        content.className = 'p-4 rounded-lg shadow-lg max-w-sm bg-red-100 border border-red-400 text-red-700';
        icon.className = 'fas fa-exclamation-circle mr-3 text-xl text-red-500';
    }

    text.textContent = message;
    container.classList.remove('hidden');

    // Ocultar el mensaje después de 5 segundos
    setTimeout(() => {
        container.classList.add('hidden');
    }, 5000);
}

// Funciones para abrir y cerrar modales
function openCreateUserModal() {
    document.getElementById('createUserModal').classList.remove('hidden');
    // Agregar efecto de fade in
    document.getElementById('createUserModal').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('createUserModal').style.opacity = '1';
    }, 10);
}

function closeCreateUserModal() {
    const modal = document.getElementById('createUserModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('createUserForm').reset();
    }, 300);
}

function openEditUserModal() {
    document.getElementById('editUserModal').classList.remove('hidden');
    // Agregar efecto de fade in
    document.getElementById('editUserModal').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('editUserModal').style.opacity = '1';
    }, 10);
}

function closeEditUserModal() {
    const modal = document.getElementById('editUserModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('editUserForm').reset();
    }, 300);
}

// Función para hacer peticiones al servidor
async function makeRequest(action, data = {}) {
    try {
        const formData = new FormData();
        formData.append('action', action);
        
        // Agregar todos los datos al formulario
        for (const [key, value] of Object.entries(data)) {
            formData.append(key, value);
        }

        // Enviar petición al servidor
        const response = await fetch('../../Controllers/AdminController.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        return result;
    } catch (error) {
        console.error('Error en la petición:', error);
        return { success: false, error: 'Error de conexión' };
    }
}

// Función para crear un nuevo usuario
document.getElementById('createUserForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Obtener datos del formulario
    const formData = new FormData(this);
    const data = {
        username: formData.get('username'),
        email: formData.get('email'),
        password: formData.get('password'),
        role: formData.get('role')
    };

    // Enviar petición al servidor
    const result = await makeRequest('create_user', data);
    
    if (result.success) {
        showMessage(result.message, 'success');
        closeCreateUserModal();
        // Recargar la página para mostrar el nuevo usuario
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        showMessage(result.error, 'error');
    }
});

// Función para cargar datos de un usuario para editar
async function editUser(userId) {
    const result = await makeRequest('get_user', { id: userId });
    
    if (result.success && result.data) {
        const user = result.data;
        
        // Llenar el formulario con los datos del usuario
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editUsername').value = user.Users;
        document.getElementById('editEmail').value = user.email || '';
        document.getElementById('editRole').value = user.role || 'user';
        document.getElementById('editStatus').value = user.status || 'active';
        
        openEditUserModal();
    } else {
        showMessage('Error al cargar los datos del usuario', 'error');
    }
}

// Función para actualizar un usuario
document.getElementById('editUserForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Obtener datos del formulario
    const formData = new FormData(this);
    const data = {
        id: formData.get('id'),
        username: formData.get('username'),
        email: formData.get('email'),
        role: formData.get('role'),
        status: formData.get('status')
    };

    // Enviar petición al servidor
    const result = await makeRequest('update_user', data);
    
    if (result.success) {
        showMessage(result.message, 'success');
        closeEditUserModal();
        // Recargar la página para mostrar los cambios
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        showMessage(result.error, 'error');
    }
});

// Función para eliminar un usuario
async function deleteUser(userId) {
    // Pedir confirmación antes de eliminar
    if (!confirm('¿Estás seguro de que quieres eliminar este usuario? Esta acción no se puede deshacer.')) {
        return;
    }

    const result = await makeRequest('delete_user', { id: userId });
    
    if (result.success) {
        showMessage(result.message, 'success');
        // Recargar la página para mostrar los cambios
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        showMessage(result.error, 'error');
    }
}

// Función para cambiar el estado de un usuario
async function toggleUserStatus(userId) {
    const result = await makeRequest('toggle_status', { id: userId });
    
    if (result.success) {
        showMessage(result.message, 'success');
        // Recargar la página para mostrar los cambios
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        showMessage(result.error, 'error');
    }
}

// Función para abrir el modal de cambiar contraseña
function changePassword(userId) {
    document.getElementById('changePasswordUserId').value = userId;
    openChangePasswordModal();
}

// Función para abrir el modal de cambiar contraseña
function openChangePasswordModal() {
    document.getElementById('changePasswordModal').classList.remove('hidden');
    // Agregar efecto de fade in
    document.getElementById('changePasswordModal').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('changePasswordModal').style.opacity = '1';
    }, 10);
}

// Función para cerrar el modal de cambiar contraseña
function closeChangePasswordModal() {
    const modal = document.getElementById('changePasswordModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('changePasswordForm').reset();
    }, 300);
}

// Función para mostrar/ocultar contraseña
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + 'Icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Función para cambiar contraseña
document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Obtener datos del formulario
    const formData = new FormData(this);
    const newPassword = formData.get('new_password');
    const confirmPassword = formData.get('confirm_password');
    const userId = formData.get('id');
    
    // Validar que las contraseñas coincidan
    if (newPassword !== confirmPassword) {
        showMessage('Las contraseñas no coinciden', 'error');
        return;
    }
    
    // Validar longitud mínima
    if (newPassword.length < 6) {
        showMessage('La contraseña debe tener al menos 6 caracteres', 'error');
        return;
    }
    
    // Enviar petición al servidor
    const result = await makeRequest('change_password', { 
        id: userId, 
        new_password: newPassword 
    });
    
    if (result.success) {
        showMessage(result.message, 'success');
        closeChangePasswordModal();
    } else {
        showMessage(result.error, 'error');
    }
});

// Cerrar modales al hacer clic fuera de ellos
window.addEventListener('click', function(e) {
    const createModal = document.getElementById('createUserModal');
    const editModal = document.getElementById('editUserModal');
    const changePasswordModal = document.getElementById('changePasswordModal');
    
    if (e.target === createModal) {
        closeCreateUserModal();
    }
    
    if (e.target === editModal) {
        closeEditUserModal();
    }
    
    if (e.target === changePasswordModal) {
        closeChangePasswordModal();
    }
});

// Cerrar modales con la tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCreateUserModal();
        closeEditUserModal();
        closeChangePasswordModal();
    }
});

// Función para actualizar estadísticas en tiempo real
async function updateStats() {
    const result = await makeRequest('get_stats');
    
    if (result.success) {
        const stats = result.data;
        
        // Actualizar los contadores en el dashboard
        const totalUsersElement = document.querySelector('[data-stat="total_users"]');
        const activeUsersElement = document.querySelector('[data-stat="active_users"]');
        const inactiveUsersElement = document.querySelector('[data-stat="inactive_users"]');
        const adminUsersElement = document.querySelector('[data-stat="admin_users"]');
        
        if (totalUsersElement) totalUsersElement.textContent = stats.total_users || 0;
        if (activeUsersElement) activeUsersElement.textContent = stats.active_users || 0;
        if (inactiveUsersElement) inactiveUsersElement.textContent = stats.inactive_users || 0;
        if (adminUsersElement) adminUsersElement.textContent = stats.admin_users || 0;
    }
}

// Actualizar estadísticas cada 30 segundos
setInterval(updateStats, 30000);

// Función para buscar usuarios (para futuras implementaciones)
function searchUsers(query) {
    const tableBody = document.getElementById('usersTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let row of rows) {
        const username = row.cells[0].textContent.toLowerCase();
        const email = row.cells[1].textContent.toLowerCase();
        
        if (username.includes(query.toLowerCase()) || email.includes(query.toLowerCase())) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// Función para ordenar la tabla (para futuras implementaciones)
function sortTable(columnIndex) {
    const tableBody = document.getElementById('usersTableBody');
    const rows = Array.from(tableBody.getElementsByTagName('tr'));
    
    rows.sort((a, b) => {
        const aValue = a.cells[columnIndex].textContent;
        const bValue = b.cells[columnIndex].textContent;
        return aValue.localeCompare(bValue);
    });
    
    // Reinsertar las filas ordenadas
    rows.forEach(row => tableBody.appendChild(row));
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('Panel de administración cargado correctamente');
    
    // Agregar atributos data-stat a los elementos de estadísticas
    const statElements = document.querySelectorAll('.text-3xl.font-bold');
    const statLabels = ['total_users', 'active_users', 'inactive_users', 'admin_users'];
    
    statElements.forEach((element, index) => {
        if (index < statLabels.length) {
            element.setAttribute('data-stat', statLabels[index]);
        }
    });

    // Agregar efectos de hover a las tarjetas
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}); 