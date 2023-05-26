<?php
// Incluimos la conexión a la base de datos
require_once "../../config/config.php";
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ../../login/login.php');
	exit;
}
// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Obtenemos los valores enviados por el usuario
  $id = trim($_POST["id"]);
  $nombre = trim($_POST["nombre"]);
  $leds = trim($_POST["leds"]);
  $dificultad = trim($_POST["dificultad"]);
  $descripcion = trim($_POST["descripcion"]);
  $iduser = trim($_POST["user_id"]);

  // Verificamos que se hayan ingresado los datos obligatorios
  if (empty($nombre) || empty($leds) || empty($dificultad) || empty($descripcion)) {
    $error = "Por favor, ingrese todos los datos obligatorios.";
  } else {

    // Actualizamos los datos del usuario en la base de datos
    $stmt = $mysql_db->prepare("UPDATE rutas SET nombre = ?, leds = ?, dificultad = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $leds, $dificultad, $descripcion, $id);

    if ($stmt->execute()) {
      // Si la actualización es exitosa, redirigimos al usuario a la página de inicio
      header("location: index.php");
      exit();
    } else {
      // Si la actualización falla, mostramos un mensaje de error
      $error = "Ha ocurrido un error al actualizar el usuario.";
    }

    // Cerramos la conexión con la base de datos
    $stmt->close();
    $mysql_db->close();
  }
} else {
  // Si no se ha enviado el formulario, obtenemos los datos del usuario desde la base de datos
  $id = trim($_GET["id"]);

  $stmt = $mysql_db->prepare("SELECT * FROM rutas WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $leds = $row["leds"];
    $dificultad = $row["dificultad"];
    $descripcion = $row["descripcion"];
    $iduser = $row["user_id"];
  } else {
    // Si no se encuentra el usuario, redirigimos al usuario a la página de inicio
    header("location: index.php");
    exit();
  }

  // Cerramos la conexión con la base de datos
  $stmt->close();
  $mysql_db->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../style/styleEditar.css">
  <link rel="icon" type="image/png" href="../../img/logo7.png" />
  <title>Editar ruta</title>
</head>
<body>
<img src="../../login/img2/logo.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
  <h1>Editar ruta</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
      <label>nombre:</label>
      <input type="text" name="nombre" value="<?php echo $nombre; ?>">
      <br><br>
    </div>
    <div>
      <label>leds:</label>
      <input type="leds" name="leds" value="<?php echo $leds; ?>">
      <br><br>
    </div>
    <div>
    <label for="dificultad">Dificultad:</label>
    <select id="dificultad" name="dificultad">
            <option value="6A">6A</option>
            <option value="6A+">6A+</option>
            <option value="6B">6B</option>
            <option value="6B+">6B+</option>
            <option value="6C">6C</option>
            <option value="6C+">6C+</option>
            <option value="7A">7A</option>
            <option value="7A+">7A+</option>
            <option value="7B">7B</option>
            <option value="7B+">7B+</option>
            <option value="7C">7C</option>
            <option value="7C+">7C+</option>
            <option value="8A">8A</option>
            <option value="8A+">8A+</option>
            <option value="8B">8B</option>
            <option value="8B+">8B+</option>
            <option value="8C">8C</option>
            <option value="8C+">8C+</option>
            <option value="9A">9A</option>
            <option value="9A+">9A+</option>
            <option value="9B">9B</option>
            <option value="9B+">9B+</option>
            <option value="9C">9C</option>
    </select><br><br>
        </div>
        <div>
        <label>descripcion:</label>
        <input type="descripcion" name="descripcion" value="<?php echo $descripcion; ?>">
        </div>
        <div>
        </select>

      </div>
      <div>
        <br>
        <input type="submit" value="Actualizar">
      </div>
      <?php if (!empty($error)) { ?>
        <div>
          <p><?php echo $error; ?></p>
        </div>
      <?php } ?>
    </form>
    <a href="index.php" class="volver-atras">Volver atrás</a>
  </body>
  </html>
