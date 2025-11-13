
-- Base de datos Clínica
CREATE DATABASE IF NOT EXISTS clinica_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinica_db;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) UNIQUE,
  contraseña VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS especialistas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  especialidad VARCHAR(100),
  nombre VARCHAR(100),
  horario VARCHAR(100),
  contacto VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS qr_tokens (
  token VARCHAR(64) PRIMARY KEY,
  usuario VARCHAR(50),
  expira_at DATETIME
) ENGINE=InnoDB;

-- Usuario admin por defecto: admin / admin123 (se inserta automáticamente en login.php si vacío)
