-- Crear la base de datos
CREATE DATABASE registro2025;

-- Usar la base de datos
USE registro2025;

-- Crear la tabla personas
CREATE TABLE personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL
);

-- Insertar algunos datos de prueba (opcional)
INSERT INTO personas (nombre, apellido, edad, direccion, correo, telefono) VALUES
('Juan', 'Pérez', 25, 'Av. Principal #123', 'juan.perez@email.com', '12345678'),
('María', 'Gómez', 30, 'Calle Secundaria #456', 'maria.gomez@email.com', '87654321');
