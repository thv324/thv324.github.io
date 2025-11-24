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
    $nombreMascota = $_POST['nombreMascota'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $fechaNacimiento = date("Y-m-d");
    $sexo = $_POST['sexo'];
    $dueno = $_POST['dueno'];

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO mascotas (nombreMascota, especie, raza, fechaNacimiento, sexo, dueno)
            VALUES ('$nombreMascota', '$especie','$raza', '$fechaNacimiento', '$sexo', '$dueno')";

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
               <a href='mantener_mascota.php'>Regresar</a>
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
