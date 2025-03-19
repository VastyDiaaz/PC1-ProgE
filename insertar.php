<?php
// Incluir archivo de conexion a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $nombre = trim($_POST['nombree']);
    $apellido = trim($_POST['apellido']);
    $edad = intval($_POST['edadd']);
    $direccion = trim($_POST['direccion']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);

    // Verificar si la conexión a la base de datos es válida
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si el correo ya existe en la base de datos
    $stmt = $conn->prepare("SELECT id FROM personas WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Error: El correo ya está registrado. <a href='index.html'>Volver</a>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close(); // Cerramos el statement antes de reutilizarlo

    // **CREAR UN NUEVO STATEMENT PARA INSERTAR LOS DATOS**
    $stmt = $conn->prepare("INSERT INTO personas (nombre, apellido, edad, direccion, correo, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssisss", $nombre, $apellido, $edad, $direccion, $correo, $telefono);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='index.html'>Volver</a>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}

  ?>
