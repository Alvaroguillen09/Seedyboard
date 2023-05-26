<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ./login/login.php');
	exit;
}

// Obtener la ruta seleccionada y los LEDs correspondientes
$ruta_seleccionada = $_POST['ruta'];

// Abrir la conexión con el puerto COM6
$puerto_serial = fopen("COM6", "w");

// Enviar los LEDs correspondientes a Arduino
fwrite($puerto_serial, $ruta_seleccionada);

// Cerrar la conexión con el puerto serial
fclose($puerto_serial);

// Redirigir al usuario a la página de confirmación
header("Location: confirmacion.php");

$_SESSION['ruta_seleccionada'] = $ruta_seleccionada;
exit();
?>
