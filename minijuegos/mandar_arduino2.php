<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ./login/login.php');
	exit;
}

// Obtener el valor 103 de la página minijuegos.php
$minijuego = $_POST['valor'];


// Abrir la conexión con el puerto COM4
$puerto_serial = fopen("COM4", "w");

// Enviar el valor 103 al puerto serial
fwrite($puerto_serial, $minijuego);

// Cerrar la conexión con el puerto serial
fclose($puerto_serial);

// Redirigir al usuario a la página de confirmación
header("Location: confirmacion2.php");

$_SESSION['valor'] = $minijuego;
exit();
?>
