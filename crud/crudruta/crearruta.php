<?php
// Incluimos la conexión a la base de datos
require_once "../../config/config.php";
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
  header('location: ../../login/login.php');
  exit;
}
// Inicializamos las variables que contendrán los valores ingresados por el usuario
$nombre = "";
$leds = "";
$dificultad = "";
$descripcion = "";
$user_id = "";


// Verificamos si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validamos los datos ingresados por el usuario
  $nombre = trim($_POST["nombre"]);
  $leds = trim($_POST["leds"]);
  $dificultad = trim($_POST["dificultad"]);
  $descripcion = trim($_POST["descripcion"]);
  $user_id = trim($_POST["user_id"]);

  // Verificamos que se hayan ingresado los datos obligatorios
  if (empty($nombre) || empty($dificultad)) {
    $error = "Por favor, ingrese todos los datos obligatorios.";
  } else {

    // Insertamos los datos del usuario en la base de datos
    $stmt = $mysql_db->prepare("INSERT INTO rutas (nombre, leds, dificultad, descripcion, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nombre, $leds, $dificultad, $descripcion, $user_id);

    if ($stmt->execute()) {
      // Si la inserción es exitosa, redirigimos al usuario a la página de inicio
      header("location: index.php");
      exit();
    } else {
      // Si la inserción falla, mostramos un mensaje de error
      $error = "Ha ocurrido un error al crear el usuario.";
    }

    // Cerramos la conexión con la base de datos
    $stmt->close();
    $mysql_db->close();
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../style/styleCrear.css">
  <title>Crear ruta</title>
  <link rel="icon" type="image/png" href="../../img/logo7.png" />
</head>

<body>
  <img src="../../img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
  <h1>Crear ruta</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
      <br><br>
      <label for="leds">Leds:</label>
      <input type="text" name="leds" id="leds" value="<?php echo $leds; ?>">
      <div><br>
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
        </select>
      </div>
      <br>
      <label for="descripcion">Descripcion:</label>
      <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
      <!-- recuperar el user_id de index.php y mostrarlo -->
      <br><br>
      <label for="user_id">Id usuario: </label>
      <input type="text" name="user_id" id="user_id" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>" readonly>
      <br><br>




    </div>
    <div>
      <input type="submit" value="Crear">
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