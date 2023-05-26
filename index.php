<?php
require_once "config/config.php";
require_once "funciones.php";
?>
<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ./login/login.php');
	exit;
}
$userID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>

<head>
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="style/styleIndex.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="icon" type="img/png" href="img/logo7.png" />
</head>

<body>

	<img src="img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">

	<div class="button-container">
		<a href="mandar.php" class="button">
			<div class="icon">
				<i class="fas fa-paper-plane"></i>
			</div>
			<div class="text">
				Mandar ruta
			</div>
		</a>

		<a href="crear.php?id='<?php $userID ?>' " class="button">
			<div class="icon">
				<i class="fas fa-plus-circle"></i>
			</div>
			<div class="text">
				Crear ruta
			</div>
		</a>

		<a href="minijuegos/minijuegos.php" class="button">
			<div class="icon">
				<i class="fas fa-dice"></i>
			</div>
			<div class="text">
				Minijuegos
			</div>
		</a>

		<a href="login/welcome.php" class="button">
			<div class="icon">
				<i class="fas fa-user"></i>
			</div>
			<div class="text">
				Mi perfil
			</div>
		</a>
	</div>
	<?php

		if (isset($_SESSION['id'])) {
			$rol = obtenerRol($_SESSION['id'], $mysql_db);
			if ($rol == 2) { // Si el rol es 2, mostrar las siguientes etiquetas
		?>
				<div class="container2">
					<a href="crud/crudusuario/index.php" class="button">
						<div class="icon">
							<i class="fas fa-users-cog"></i>
						</div>
						<div class="text">
							Control de usuarios
						</div>
					</a>

					<a href="crud/crudruta/index.php" class="button">
						<div class="icon">
							<i class="fas fa-hammer"></i>
						</div>
						<div class="text">
							Control de rutas
						</div>
					</a>
				</div>
		<?php
			}
		}
		?>
	
</body>

</html>