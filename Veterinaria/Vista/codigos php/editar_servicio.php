<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "Veterinaria";

$conexion = mysqli_connect($server, $user, $pass, $db);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener datos del servicio
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM servicio WHERE id_servicio = $id";
    $resultado = $conexion->query($sql);
    $servicio = $resultado->fetch_assoc();
}

// Actualizar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombreServicio = $_POST['nombreServicio'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion'];
    $disponibilidad = $_POST['disponibilidad'];

    $sqlUpdate = "UPDATE servicio SET 
        nombreServicio='$nombreServicio',
        descripcion='$descripcion',
        precio='$precio',
        duracion='$duracion',
        disponibilidad='$disponibilidad'
        WHERE id_servicio=$id";

    if ($conexion->query($sqlUpdate) === TRUE) {
        header("Location: mantener_servicio.php");
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
  <title>Perfil Administrador</title>

  <!-- CSS SEPARADO -->
  <link rel="stylesheet" href="../CSS/actualizar.css">

  <!-- ICONOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
</head>
<body>

<!-- NAVBAR -->
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

<main class="profile-container">
  <div class="profile-card">
   
    <form method="post">
      <h1>Editar Servicio</h1>
        <input type="hidden" name="id" value="<?php echo $servicio['id_servicio']; ?>">
         
        <!-- Nombre del servicio como lista -->
        <label for="nombreServicio">Nombre del Servicio:</label>
        <select id="nombreServicio" name="nombreServicio" required>
            <option value="Hospitalizacion" <?php if($servicio['nombreServicio']=='Hospitalizacion') echo 'selected'; ?>>Hospitalización</option>
            <option value="Estetica" <?php if($servicio['nombreServicio']=='Estetica') echo 'selected'; ?>>Estética</option>
            <option value="Cremacion" <?php if($servicio['nombreServicio']=='Cremacion') echo 'selected'; ?>>Cremación</option>
        </select>

        <!-- Descripción -->
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $servicio['descripcion']; ?>" required>

        <!-- Precio -->
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" value="<?php echo $servicio['precio']; ?>" required>

        <!-- Duración -->
        <label for="duracion">Duración:</label>
        <input type="text" id="duracion" name="duracion" value="<?php echo $servicio['duracion']; ?>" required>

        <!-- Disponibilidad -->
        <label for="disponibilidad">Disponibilidad:</label>
        <input type="text" id="disponibilidad" name="disponibilidad" value="<?php echo $servicio['disponibilidad']; ?>" required>

        <!-- Botones -->
        <button type="submit" class="btn-actualizar"><i class="fas fa-sync-alt"></i> Actualizar</button>
        <a href="mantener_servicio.php"><i class="fas fa-arrow-left"></i> Cancelar</a>
    </form>
  </div>
</main>

<footer>
  <p>&copy; 2025 Veterinaria Super Pets</p>
  <p>Ramirez San Martin Angeles Valeria, Rositas Santiago Evelyn Johana</p>
</footer>

</body>
</html>