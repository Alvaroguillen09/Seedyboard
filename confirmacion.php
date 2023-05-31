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
	<p>Agarres: <?php echo $leds; ?></p>
	<a href="index.php" class="volver-atras">Volver atrás</a>
</body>

</html>