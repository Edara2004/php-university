-- Script para arreglar la base de datos del sistema de administración
-- Ejecutar este script en MySQL para agregar las columnas faltantes

USE useraccounts;

-- Agregar columna email si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS email VARCHAR(255) NULL;

-- Agregar columna role si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS role ENUM('user', 'admin') DEFAULT 'user';

-- Agregar columna status si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS status ENUM('active', 'inactive') DEFAULT 'active';

-- Agregar columna created_at si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Agregar columna updated_at si no existe
ALTER TABLE users ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Crear índices para mejorar el rendimiento
CREATE INDEX IF NOT EXISTS idx_users_role ON users(role);
CREATE INDEX IF NOT EXISTS idx_users_status ON users(status);
CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at);

-- Crear usuario administrador por defecto si no existe
INSERT IGNORE INTO users (Users, UserPasswords, email, role, status, created_at) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@loopkin.com', 'admin', 'active', NOW());

-- Mostrar la estructura actualizada
DESCRIBE users;

-- Mostrar los usuarios existentes
SELECT id, Users, email, role, status, created_at FROM users; 