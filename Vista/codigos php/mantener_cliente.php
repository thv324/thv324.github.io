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

// Consulta para obtener todos los clientes
$sql = "SELECT id_cliente, nombre, apellido_p, apellido_M, correo, domicilio, telefono FROM clientes";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Clientes</title>
    <link rel="stylesheet" href="../CSS/tablas.css">

    <!-- FONT AWESOME -->
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
            <a href="mantener_servicio.php" target="_blank"><i class="fas fa-concierge-bell"></i> Servicios</a>
            <a href="mantener_veterinario.php" target="_blank"><i class="fas fa-stethoscope"></i> Veterinarios</a>
            <a href="mantener_empleado.php" target="_blank"><i class="fas fa-user-tie"></i> Empleados</a>
            <a href="mantener_mascota.php" target="_blank"><i class="fa-solid fa-paw"></i> Mascotas</a>
            <a href="../Paginas html/sesion.html" target="_blank"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
        </div>
    </nav>
</header>

<!-- CONTENIDO -->
<h1>Lista de Clientes</h1>

<div class="top-bar">
    <a href="../Paginas html/cliente.html"><i class="fas fa-user-plus"></i> Agregar Cliente</a>
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Buscar por nombre...">
    </div>
</div>

<table id="clientesTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Domicilio</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    <?php
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['id_cliente']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['apellido_p']}</td>
                    <td>{$fila['apellido_M']}</td>
                    <td>{$fila['correo']}</td>
                    <td>{$fila['domicilio']}</td>
                    <td>{$fila['telefono']}</td>
                    <td>
                        <a href='editar_cliente.php?id={$fila['id_cliente']}' class='btn-edit'>
                            <i class='fas fa-edit'></i>
                        </a>
                        <a href='eliminar_cliente.php?id={$fila['id_cliente']}' class='btn-delete'>
                            <i class='fas fa-trash-alt'></i>
                        </a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay clientes registrados</td></tr>
         <a href='../Paginas html/administrador.html'<i class='fas fa-arrow-left'></i> Regresar</a>";
    }
    ?>
    </tbody>
</table>


<script>
    // Filtro por nombre
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#clientesTable tbody tr');

        rows.forEach(row => {
            let nombre = row.cells[1].textContent.toLowerCase();
            row.style.display = nombre.includes(filter) ? '' : 'none';
        });
    });

    // Menú desplegable
    function toggleMenu() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('active');
    }
</script>


<!-- BOTÓN REGRESAR -->
<div class="back-button" style="margin: 15px;">
 <a href="../Paginas html/administrador.html"><i class="fas fa-arrow-left"></i> Regresar</a>
</div>


<!-- FOOTER -->
<footer>
  <p>&copy; 2025 Veterinaria Super Pets</p>
  <p>Ramirez San Martin Angeles Valeria, Rositas Santiago Evelyn Johana</p>
</footer>

</body>
</html>

<?php
$conexion->close();
?>