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
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_M = $_POST['apellido_M'];
    $puesto = $_POST['puesto'];
    $turno = $_POST['turno'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
   $fecha = date("Y-m-d");

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO empleados (id, nombre, apellido_p, apellido_M, puesto, turno, correo, telefono, fecha)
            VALUES ('$id', '$nombre', '$apellido_p', '$apellido_M', '$puesto', '$turno', '$correo', '$telefono', '$fecha')";

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
               <a href='mantener_empleado.php'>Regresar</a>
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
