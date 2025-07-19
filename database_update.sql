-- Script para actualizar la base de datos useraccounts
-- Agregar campos necesarios para el sistema de administración

USE useraccounts;

-- Agregar columna de email si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS email VARCHAR(255) NULL;

-- Agregar columna de rol si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS role ENUM('user', 'admin') DEFAULT 'user';

-- Agregar columna de estado si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS status ENUM('active', 'inactive') DEFAULT 'active';

-- Agregar columna de fecha de creación si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Agregar columna de fecha de actualización si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Crear un usuario administrador por defecto si no existe
-- Usuario: admin
-- Contraseña: admin123 (hasheada con password_hash)
INSERT IGNORE INTO users (Users, UserPasswords, email, role, status, created_at) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@loopkin.com', 'admin', 'active', NOW());

-- Crear índices para mejorar el rendimiento
CREATE INDEX IF NOT EXISTS idx_users_role ON users(role);
CREATE INDEX IF NOT EXISTS idx_users_status ON users(status);
CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at);

-- Mostrar la estructura actualizada de la tabla
DESCRIBE users;

-- Mostrar los usuarios existentes
SELECT id, Users, email, role, status, created_at FROM users; 