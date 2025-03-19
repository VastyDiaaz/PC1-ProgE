<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Incluir archivo de conexión a la base de datos
    include 'conexion.php';

    // Preparar la consulta SQL con sentencia preparada
    $stmt = $conn->prepare("DELETE FROM personas WHERE id = ?");

    if ($stmt) {
        // Vincular el parámetro
        $stmt->bind_param("i", $_GET['id']);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensaje = "Registro eliminado exitosamente.";
            $clase_alerta = "alert-success";
        } else {
            $mensaje = "Error al eliminar el registro.";
            $clase_alerta = "alert-danger";
        }
        // Cerrar la consulta preparada
        $stmt->close();
        } else {
        $mensaje = "Error en la consulta SQL.";
        $clase_alerta = "alert-danger";
    }


    // Cerrar la conexión a la base de datos
    $conn->close();
    echo "Eliminado con exito. <a href='index.html'>Volver</a>";
} else {
    // Si no se recibe un ID válido, mostrará un mensaje de error
    $mensaje = "ID de registro no válido.";
    $clase_alerta = "alert-warning";
}
?>
