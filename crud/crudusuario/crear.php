<?php
// Incluimos la conexión a la base de datos
require_once "../../config/config.php";
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
  header('location: ../../login/login.php');
  exit;
}

// Inicializamos las variables que contendrán los valores ingresados por el usuario
$username = "";
$password = "";
$rol_id = "";

// Verificamos si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validamos los datos ingresados por el usuario
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $rol_id = trim($_POST["rol_id"]);

  // Verificamos que se hayan ingresado los datos obligatorios
  if (empty($username) || empty($password) || empty($rol_id)) {
    $error = "Por favor, ingrese todos los datos obligatorios.";
  } else {
    // Insertamos los datos del usuario en la base de datos
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Codifica la contraseña

    $stmt = $mysql_db->prepare("INSERT INTO users (username, password, rol_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $hashedPassword, $rol_id);

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
  <link rel="icon" type="image/png" href="../../img/logo7.png" />
  <title>Crear Usuario</title>
</head>

<body>
  <img src="../../img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
  <h1>Crear Usuario</h1>
  <div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
      <label>Nombre de usuario:</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div><br>
    <div>
      <label>Contraseña:</label>
      <input type="password" name="password" value="<?php echo $password; ?>">
    </div><br>
    <div>
      <label>Rol:</label>
      <select name="rol_id">
        <option value="">Seleccione un rol</option>
        <?php
        // Obtenemos los roles desde la base de datos
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($conn === false) {
          die("Error: Unable to connect " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM roles";
        $result = mysqli_query($conn, $sql);
        // Iteramos por cada rol y lo mostramos en el select
        while ($row = mysqli_fetch_assoc($result)) {
          $selected = $rol_id == $row["id"] ? "selected" : "";
          echo "<option value=\"" . $row["id"] . "\" $selected>" . $row["nombre"] . "</option>";
        }
        mysqli_close($conn);
        ?>
      </select>

    </div>
    <div><br>
      <input type="submit" value="Crear">
    </div>
    <?php if (!empty($error)) { ?>
      <div>
        <p><?php echo $error; ?></p>
      </div>
    <?php } ?>
  </form>
    </div>
  <a href="index.php" class="volver-atras">Volver atrás</a>
</body>

</html>