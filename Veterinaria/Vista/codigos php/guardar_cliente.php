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
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_P'];
    $apellido_M = $_POST['apellido_M'];
    $correo = $_POST['correo'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO clientes (nombre, apellido_p, apellido_M, correo, domicilio, telefono)
            VALUES ('$nombre', '$apellido_p', '$apellido_M', '$correo', '$domicilio', '$telefono')";

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
               <a href='mantener_cliente.php'>Regresar</a>
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
