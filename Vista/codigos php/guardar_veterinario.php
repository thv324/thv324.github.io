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
    // Sanitizar datos del formulario
    $nombre      = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido_p  = mysqli_real_escape_string($conexion, $_POST['apellido_p']);
    $apellido_m  = mysqli_real_escape_string($conexion, $_POST['apellido_m']);
    $puesto      = mysqli_real_escape_string($conexion, $_POST['puesto']);
    $correo      = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono    = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $turno       = mysqli_real_escape_string($conexion, $_POST['turno']);

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO veterinarios (nombre, apellido_P, apellido_M, puesto, correo, telefono, turno)
            VALUES ('$nombre', '$apellido_p', '$apellido_m', '$puesto', '$correo', '$telefono', '$turno')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Veterinario Registrado</title>
            <link rel='stylesheet' href='../CSS/cliente.css'>
        </head>
        <body>
            <h1>¡Registro exitoso!</h1>
            <div class='regresar'>
               <a href='mantener_veterinario.php'>Regresar</a>
            </div>
        </body>
        </html>";
    } else {
        echo "<p>Error al registrar: " . mysqli_error($conexion) . "</p>";
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>