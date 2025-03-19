<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Personas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 40px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-size: 28px;
        }
        .btn-back {
            display: block;
            width: fit-content;
            margin: 0 auto 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        .table {
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 12px; /* Mayor separación */
            text-align: center;
            font-size: 16px;
        }
        .table thead th {
            background: #343a40;
            color: white;
        }
        .btn-sm {
            font-size: 14px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index.html" class="btn btn-primary btn-back">⬅ Volver al inicio</a>

    <h1>Registros de Personas</h1>

    <!-- Tabla de registros -->
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Dirección</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            if ($conn->connect_error) {
                die("<tr><td colspan='8' class='text-danger'>Error de conexión: " . $conn->connect_error . "</td></tr>");
            }

            $sql = "SELECT * FROM personas";
            $result = $conn->query($sql);

            if (!$result) {
                die("<tr><td colspan='8' class='text-danger'>Error en la consulta: " . $conn->error . "</td></tr>");
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["apellido"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["edad"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["direccion"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["correo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
                    echo "<td>";
                    echo "<a href='actualizar.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning btn-sm me-2'>Actualizar</a>";
                    echo "<a href='eliminar.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center text-muted'>No se encontraron registros</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>


 

