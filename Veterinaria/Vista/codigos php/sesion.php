<?php
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "Veterinaria");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Validar datos enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Consulta en administradores
    $sql_admin = "SELECT * FROM administradores WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultado_admin = mysqli_query($conexion, $sql_admin);

   // Consulta en clientes
    $sql_cliente = "SELECT * FROM clientes WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultado_cliente = mysqli_query($conexion, $sql_cliente);

    if ($resultado_admin && mysqli_num_rows($resultado_admin) > 0) {
        // Usuario administrador válido
        $_SESSION['usuario'] = $correo;
        header("Location: ../Paginas html/administrador.html");
        exit();
    } elseif ($resultado_cliente && mysqli_num_rows($resultado_cliente) > 0) {
        // Usuario cliente válido
        $_SESSION['usuario'] = $correo;
        header("Location: ../cliente/perfil_cliente.php"); // Página del perfil del cliente
        exit();
    } else {


       echo '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
   <link rel="stylesheet" href="../CSS/sesion.css">
 <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
</head>
<body>



<header class="hero">
 <img src="../Imagenes/logo-sf.png" class="logo">
  <nav class="navbar">
 
    <a></a>
    <a></a>
    <a></a>
    <a></a>
      <a href="../index.html"><i class="fa-solid fa-house"></i>Inicio</a>
  </nav>
</header>

<h1>¡Contraseña incorrecta!</h1>
 <a href="../Paginas html/sesion.html"><i class="fas fa-arrow-left"></i> Vuelve a intentarlo </a>

<footer>

      <p>&copy; 2025 Veterinaria Super Pets</p>
   <p>Ramirez San Martin Angeles Valeria, Rositas Santiago Evelyn Johana</p>
    
  
</footer>

</body>
</html>';
    }
}

mysqli_close($conexion);
?>