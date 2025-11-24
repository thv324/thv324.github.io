<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "Veterinaria";

$conexion = mysqli_connect($server, $user, $pass, $db);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreServicio = $_POST['nombreServicio'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion'];
    $disponibilidad = $_POST['disponibilidad'];

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO servicio (nombreServicio, descripcion, precio, duracion, disponibilidad)
            VALUES ('$nombreServicio', '$descripcion', '$precio', '$duracion', '$disponibilidad')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Cliente Registrado</title>
            <link rel='stylesheet' href='../CSS/cliente.css'>
        </head>
        <body>
            <h1>¡Registro exitoso!</h1>
            <div class='regresar'>
               <a href='mantener_servicio.php'>Regresar</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>
