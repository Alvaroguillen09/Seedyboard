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
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $rol_id = trim($_POST["rol_id"]);

  // Verificamos que se hayan ingresado los datos obligatorios
  if (empty($username) || empty($password) || empty($rol_id)) {
    $error = "Por favor, ingrese todos los datos obligatorios.";
  } else {

    // Actualizamos los datos del usuario en la base de datos
    $stmt = $mysql_db->prepare("UPDATE users SET username = ?, password = ?, rol_id = ? WHERE id = ?");
    $stmt->bind_param("ssii", $username, $password, $rol_id, $id);

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

  $stmt = $mysql_db->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $password = $row["password"];
    $rol_id = $row["rol_id"];
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
  <title>Editar Usuario</title>
</head>

<body>
<img src="../../login/img2/logo.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;" width="15%">
  <h1>Editar Usuario</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
      <label>Nombre de usuario:</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <br><br>
    </div>
    <div>
      <label>Contraseña:</label>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <br><br>
    </div>
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