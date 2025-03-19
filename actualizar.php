<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

$mensaje = "";
$clase_alerta = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $edad = intval($_POST['edad']);
    $direccion = trim($_POST['direccion']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);

    // Sentencia preparada para actualizar los datos
    $stmt = $conn->prepare("UPDATE personas SET nombre=?, apellido=?, edad=?, direccion=?, correo=?, telefono=? WHERE id=?");

    if ($stmt) {
        $stmt->bind_param("ssisssi", $nombre, $apellido, $edad, $direccion, $correo, $telefono, $id);
        if ($stmt->execute()) {
            $mensaje = "Registro actualizado correctamente.";
            $clase_alerta = "alert-success";
        } else {
            $mensaje = "Error al actualizar el registro.";
            $clase_alerta = "alert-danger";
        }
        $stmt->close();
    } else {
        $mensaje = "Error en la consulta SQL.";
        $clase_alerta = "alert-danger";
    }
}


// Verificar si se ha recibido un ID para cargar los datos
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM personas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        $mensaje = "No se encontró el registro.";
        $clase_alerta = "alert-warning";
    }
    $stmt->close();
} else {
    $mensaje = "ID de registro no especificado.";
    $clase_alerta = "alert-warning";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Actualizar Registro</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($mensaje)) : ?>
        <div class="alert <?php echo $clase_alerta; ?> text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($row)) : ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label fw-bold">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>
                </div>
            </div>
            <div class="row">
            <div class="col-md-4 mb-3">
                    <label for="edad" class="form-label fw-bold">Edad:</label>
                    <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $row['edad']; ?>" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="direccion" class="form-label fw-bold">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label fw-bold">Correo electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary px-4">Actualizar</button>
                <a href="mostrar_registro.php" class="btn btn-secondary px-4">Volver</a>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
