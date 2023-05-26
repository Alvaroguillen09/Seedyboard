<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ../../login/login.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link  type="text/css" rel="stylesheet" href="../style/styleIndex.css">
    <link rel="icon" type="image/png" href="../../img/logo7.png" />
    <title>Control usuarios</title>

<body>
<img src="../../login/img2/logo.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
<h2> Control usuarios: </h2>
<?php

// Incluir archivos de configuración y funciones
require_once "../../config/config.php";
require_once "../../funciones.php";

// Verificar si el usuario tiene el rol adecuado
if (!isset($_SESSION['id']) || obtenerRol($_SESSION['id'], $mysql_db) != 2) {
  // Si el usuario no tiene el rol adecuado, redirigirlo a otra página
  header("Location: welcome.php");
  exit;
}
// Consultamos los registros de la tabla "users"
$sql = "SELECT users.*, roles.nombre AS nombre_rol FROM users JOIN roles ON users.rol_id = roles.id";
$resultado = mysqli_query($mysql_db, $sql);
 
// Verificamos si hay registros
if (mysqli_num_rows($resultado) > 0) {
    // Si hay registros, los mostramos en una tabla
    echo "<table>";
    echo "<tr><td colspan='6'><a href='crear.php'>Crear nuevo usuario</a></td></tr>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Password</th><th>Rol</th><th>Fecha de creación</th><th>Acciones</th></tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['username'] . "</td>";
        echo "<td>" . $fila['password'] . "</td>";
        echo "<td>" . $fila['nombre_rol'] . "</td>";
        echo "<td>" . $fila['created_at'] . "</td>";
        echo "<td><a href='editar.php?id=" . $fila['id'] . "'><i class='fas fa-edit'></i> Editar</a> | <a href='borrar.php?id=" . $fila['id'] . "&rol_id=" . $fila['rol_id'] . "' onclick='return confirm(\"¿Está seguro que desea eliminar este registro?\")'><i class='fas fa-trash-alt'></i> Borrar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Si no hay registros, mostramos un mensaje
    echo "No hay registros.";
}
?>
<a href="../../index.php" class="volver-atras">Volver atrás</a>
</body>
</html>

