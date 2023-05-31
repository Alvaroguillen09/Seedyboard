<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ../../login/login.php');
	exit;
}

// Incluir archivos de configuración y funciones
require_once "../../config/config.php";
require_once "../../funciones.php";

// Verificar si el usuario tiene el rol adecuado
if (!isset($_SESSION['id']) || obtenerRol($_SESSION['id'], $mysql_db) != 2) {
  // Si el usuario no tiene el rol adecuado, redirigirlo a otra página
  header("Location: welcome.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="../style/styleIndex.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../img/logo7.png" />
    <title>Control de rutas</title>
</head>
<body>
<img src="../../login/img2/logo.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
<h2> Control de rutas: </h2>
<?php

// Consultamos los registros de la tabla "users"
$sql = "SELECT * FROM rutas";
$resultado = mysqli_query($mysql_db, $sql);
 
// Verificamos si hay registros
if (mysqli_num_rows($resultado) > 0) {
    // Si hay registros, los mostramos en una tabla
    echo "<table>";
    echo "<tr><td colspan='6'><a href='crearruta.php?user_id=" . $_SESSION['id'] . "'>Crear una nueva ruta</a></td></tr>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Leds</th><th>Dificultad</th><th>Descripcion</th><th>IdUsuario</th><th>Acciones</th></tr>";
    while ($fila1 = mysqli_fetch_assoc($resultado)) {
      // Definimos el número de filas y columnas
      $numFilas = 12;
$numColumnas = 8;
$ledsArray = explode(", ", $fila1['leds']); // Convertimos la cadena a un arreglo

$combinaciones = array();

for ($fila = 0; $fila < $numFilas; $fila++) {
  for ($columna = 0; $columna < $numColumnas; $columna++) {
    $indice = ($columna * $numFilas) + $fila;
    if (isset($ledsArray[$indice]) && $ledsArray[$indice] == 255) {
      $letra = chr(65 + $columna);
      $numero = $fila + 1;

      // Verificar si la columna es par para invertir la numeración de la fila
      if ($columna % 2 == 1) {
        $numero = $numFilas - $fila;
      }

      $combinaciones[] = $letra . $numero;
    }
  }
}

// Ordenar alfabéticamente y luego numéricamente
sort($combinaciones);
usort($combinaciones, function($a, $b) {
  $letraA = substr($a, 0, 1);
  $letraB = substr($b, 0, 1);
  $numeroA = substr($a, 1);
  $numeroB = substr($b, 1);

  if ($letraA == $letraB) {
    return $numeroA - $numeroB;
  } else {
    return strcmp($letraA, $letraB);
  }
});


        echo "<tr>";
        echo "<td>" . $fila1['id'] . "</td>";
        echo "<td>" . $fila1['nombre'] . "</td>";
        echo "<td>";
        // Mostrar los elementos del array $combinaciones
   foreach ($combinaciones as $combinacion) {
     echo $combinacion . " ";
   }
 
   echo "</td>";
        echo "<td>" . $fila1['dificultad'] . "</td>";
        echo "<td>" . $fila1['descripcion'] . "</td>";
        echo "<td>" . $fila1['user_id'] . "</td>";
        echo "<td><a href='editarruta.php?id=" . $fila1['id'] . "'><i class='fa fa-edit'></i> Editar</a> <br> <a href='borrarruta.php?id=" . $fila1['id'] . "&user_id=" . $fila1['user_id'] . "' onclick='return confirm(\"¿Está seguro que desea eliminar este registro?\")'><i class='fa fa-trash'></i> Borrar</a></td>";
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

