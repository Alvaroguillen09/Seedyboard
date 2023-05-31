<?php

session_start();
$ruta_seleccionada = $_SESSION['ruta_seleccionada'];
// Obtener el valor de los LEDs seleccionados
$leds = $ruta_seleccionada;
// Abrir la conexión con el puerto COM4
$puerto_serial = fopen("COM4", "w");
// Enviar los valores de los LEDs a Arduino
fwrite($puerto_serial, $leds);

// Cerrar la conexión con el puerto serial
fclose($puerto_serial);

// Eliminar la variable de sesión
unset($_SESSION['ruta_seleccionada']);

$numFilas = 12;
$numColumnas = 8;
$ledsArray = explode(", ", $leds); // Convertimos la cadena a un arreglo

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

?>

<!DOCTYPE html>
<html>

<head>
	<title>Confirmación</title>
	<link rel="icon" type="img/png" href="img/logo7.png" />
	<link rel="stylesheet" type="text/css" href="style/styleConfirmacion.css">
</head>

<body>
<img src="img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">
	<h1>¡Completa la ruta y alcanza tu máximo potencial en la escalada!</h1>
	<p>Agarres: <?php
	// Imprimir las combinaciones ordenadas
	foreach ($combinaciones as $combinacion) {
	echo $combinacion . " ";
  }
	?></p>
	<a href="index.php" class="volver-atras">Volver atrás</a>
</body>

</html>