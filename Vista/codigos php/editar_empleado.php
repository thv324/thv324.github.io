<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "Veterinaria";

$conexion = mysqli_connect($server, $user, $pass, $db);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener datos del empleado por ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM empleados WHERE id = $id";
    $resultado = $conexion->query($sql);
    $empleado = $resultado->fetch_assoc();
}

// Actualizar datos del empleado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $apellido_P = $_POST['apellido_P'];
    $apellido_M = $_POST['apellido_M'];
    $puesto = $_POST['puesto'];
    $turno = $_POST['turno'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];

    $sqlUpdate = "UPDATE empleados SET 
        nombre='$nombre', 
        apellido_P='$apellido_P', 
        apellido_M='$apellido_M', 
        puesto='$puesto', 
        turno='$turno', 
        correo='$correo', 
        telefono='$telefono', 
        fecha='$fecha'
        WHERE id=$id";

    if ($conexion->query($sqlUpdate) === TRUE) {
        header("Location: mantener_empleado.php"); // Redirige a la lista
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil Cliente</title>
<link rel="stylesheet" href="../CSS/actualizar.css">
 <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
  <nav class="navbar">
    <div class="menu-icon" onclick="toggleMenu()">
      <i class="fas fa-bars"></i>
    </div>
    
    <img src="../Imagenes/logo-sf.png">

     <div class="nav-links" id="menu">
      <a href="../codigos php/mantener_cliente.php" target="_blank"><i class="fas fa-user"></i> Cliente</a>
      <a href="../codigos php/mantener_servicio.php" target="_blank"><i class="fas fa-concierge-bell"></i> Servicios</a>
      <a href="../codigos php/mantener_veterinario.php" target="_blank"><i class="fas fa-stethoscope"></i> Veterinarios</a>
      <a href="../codigos php/mantener_empleado.php" target="_blank"><i class="fas fa-user-tie"></i> Empleados</a>
      <a href="../codigos php/mantener_mascota.php" target="_blank"><i class="fa-solid fa-paw"></i> Mascotas</a>
      <a href="../Paginas html/sesion.html" target="_blank"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
    </div>
  </nav>
</header>



<form method="post" class="form-editar">
  <h1>Editar Empleado</h1>
    <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $empleado['nombre']; ?>" required><br>
    
    <label>Apellido Paterno:</label>
    <input type="text" name="apellido_P" value="<?php echo $empleado['apellido_P']; ?>" required><br>
    
    <label>Apellido Materno:</label>
    <input type="text" name="apellido_M" value="<?php echo $empleado['apellido_M']; ?>" required><br>
    
<label>Puesto:</label>
<select name="puesto" required>
    <option value="Recepcionista" <?php if($empleado['puesto'] == 'Recepcionista') echo 'selected'; ?>>Recepcionista</option>
    <option value="Estilista" <?php if($empleado['puesto'] == 'Estilista') echo 'selected'; ?>>Estilista</option>
</select><br>
    
   
<label>Turno:</label>
<select name="turno" required>
    <option value="Matutino" <?php if($empleado['turno'] == 'Matutino') echo 'selected'; ?>>Matutino</option>
    <option value="Vespertino" <?php if($empleado['turno'] == 'Vespertino') echo 'selected'; ?>>Vespertino</option>
    <option value="Nocturno" <?php if($empleado['turno'] == 'Nocturno') echo 'selected'; ?>>Nocturno</option>
</select><br>

    
    <label>Correo:</label>
    <input type="email" name="correo" value="<?php echo $empleado['correo']; ?>" required><br>
    
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $empleado['telefono']; ?>" required><br>
    
    <label>Fecha de contratación:</label>
    <input type="date" name="fecha" value="<?php echo $empleado['fecha']; ?>" required><br>
    
    <button type="submit" class="btn-actualizar"><i class="fas fa-sync-alt"></i> Actualizar</button>
    <a href="mantener_empleado.php"><i class="fas fa-arrow-left"></i> Cancelar</a>
</form>

<!-- FOOTER -->
<footer>
  <p>&copy; 2025 Veterinaria Super Pets</p>
  <p>Ramirez San Martin Angeles Valeria, Rositas Santiago Evelyn Johana</p>
</footer>

<script>
  function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('active');
  }
</script>

</body>
</html>