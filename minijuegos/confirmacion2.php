<?php

session_start();

// Obtener el valor 103 de la página minijuegos.php
$minijuego = $_POST['valor'];


// Abrir la conexión con el puerto COM4
$puerto_serial = fopen("COM4", "w");

// Enviar el valor 103 al puerto serial
fwrite($puerto_serial, $minijuego);

// Cerrar la conexión con el puerto serial
fclose($puerto_serial);

// Eliminar la variable de sesión
unset($_SESSION['valor']);


var_dump($minijuego);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Confirmación</title>
	<link rel="icon" type="img/png" href="../img/logo7.png" />
	<link rel="stylesheet" type="text/css" href="styleConfirmacion2.css">
</head>

<body>
	<img src="../img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">
	<h1>¿Superaras el minijuego?</h1>
	<p>El valor selecionado es: <?php echo $minijuego; ?></p>
	<a href="../index.php" class="volver-atras">Volver atrás</a>
</body>

</html>