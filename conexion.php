<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "registro2025";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {//objeto contiene la descripción del error.
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}


/*GET:
Los datos enviados a través de GET se adjuntan a la URL como una cadena de consulta (query string) después del signo de interrogación ?.
Los datos son visibles en la URL, lo que significa que cualquier usuario puede verlos.
Los datos tienen una limitación de longitud (generalmente alrededor de 2048 caracteres), lo que puede ser un problema si se envían grandes cantidades de datos.
Se utiliza principalmente para solicitudes de lectura, como obtener una página web o filtrar datos, donde los datos enviados no modifican el estado del servidor.
Es útil para realizar marcadores de página (bookmarks) o compartir enlaces.
No se recomienda para el envío de datos sensibles, como contraseñas.
*/
/*
POST:
Los datos enviados a través de POST se envían en el cuerpo de la solicitud HTTP, por lo que no son visibles en la URL.
No hay límite en la longitud de los datos que se pueden enviar a través de POST.
Se utiliza para enviar datos sensibles, como contraseñas o información de tarjetas de crédito, ya que los datos no son visibles en la URL.
Se utiliza comúnmente para enviar datos a un servidor que pueden causar cambios en el estado del servidor, como agregar un nuevo registro a una base de datos o enviar un formulario.
No es adecuado para marcadores de página o compartir enlaces, ya que los datos no están incluidos en la URL. */
?>
