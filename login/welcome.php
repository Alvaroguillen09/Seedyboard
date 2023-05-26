<?php
// Incluir archivos de configuración y funciones
require_once '../config/config.php';
require_once "../funciones.php";
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
  header('location: login.php');
  exit;
}

// Obtener el correo electrónico del usuario
$sql = "SELECT email FROM users WHERE id = " . $_SESSION['id'];
$result = mysqli_query($mysql_db, $sql);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];

// Almacenar el correo electrónico en la sesión
$_SESSION['email'] = $email;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Mi perfil</title>
  <link rel="icon" type="img/png" href="../img/logo7.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style/styleWelcome.css">
</head>

<body>
  <main>
    <section class="container wrapper">
      <div class="page-header">
        <h2 class="display-5">Bienvenido <?php echo $_SESSION['username']; ?></h2>
      </div>
      
        <?php
        // Obtener el nombre del archivo de la imagen de perfil del usuario
        $sql = "SELECT profile_picture FROM users WHERE id = " . $_SESSION['id'];
        $result = mysqli_query($mysql_db, $sql);
        $row = mysqli_fetch_assoc($result);
        $profilePicture = $row['profile_picture'];

        // Verificar si se ha cargado una imagen de perfil
        if (!empty($profilePicture) && file_exists('profile_pictures/' . $profilePicture)) {
          echo '<div class="profile-icon d-flex justify-content-center align-items-center">';
          echo '<img src="profile_pictures/' . $profilePicture . '" alt="Profile Picture" class="profile-image">';
       echo "</div>";
        } 
        else {
          echo '<div class="prof-icon d-flex justify-content-center align-items-center">';
          echo '<i class="fas fa-user-circle" style="font-size: 74px;"></i>'; // Icono de usuario predeterminado si no hay imagen de perfil
          echo "</div>";
        }
        ?>
      
      <div class="user-details">
        <h3>Datos del usuario:</h3><br>
        <p><strong>Nombre de usuario:</strong> <?php echo $_SESSION['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
      </div>
     
    </section>
  </main>
        <p><strong>Rutas creadas por ti:</strong></p>
  <?php
  // Consultamos los registros de la tabla "users"
  $sql = "SELECT * FROM rutas WHERE user_id = " . $_SESSION['id'] . " ORDER BY id DESC";
  $resultado = mysqli_query($mysql_db, $sql);

  // Verificamos si hay registros
  if (mysqli_num_rows($resultado) > 0) {
    // Si hay registros, los mostramos en una tabla
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Leds</th><th>Dificultad</th><th>Descripcion</th><th>IdUsuario</th><th>Acciones</th></tr>";
    while ($fila1 = mysqli_fetch_assoc($resultado)) {
      // Definimos el número de filas y columnas
      $numFilas = 12;
      $numColumnas = 8;
      $ledsArray = explode(", ", $fila1['leds']); // Convertimos la cadena a un arreglo

      $combinaciones = '';

      for ($fila = 0; $fila < $numFilas; $fila++) {
        for ($columna = 0; $columna < $numColumnas; $columna++) {
          $indice = $fila * $numColumnas + $columna;
          if (isset($ledsArray[$indice]) && $ledsArray[$indice] == 255) {
            $letra = chr(65 + $columna);
            $numero = $fila + 1;
            $combinaciones .= $letra . $numero . " ";
          }
        }
      }

      echo "<tr>";
      echo "<td>" . $fila1['id'] . "</td>";
      echo "<td>" . $fila1['nombre'] . "</td>";
      echo "<td>" . $combinaciones . "</td>";
      echo "<td>" . $fila1['dificultad'] . "</td>";
      echo "<td>" . $fila1['descripcion'] . "</td>";
      echo "<td>" . $fila1['user_id'] . "</td>";
      echo "<td><a href='editarruta.php?id=" . $fila1['id'] . "'><i class='fas fa-edit'></i> Editar</a> | <a href='borrarruta.php?id=" . $fila1['id'] . "&user_id=" . $fila1['user_id'] . "' onclick='return confirm(\"¿Está seguro que desea eliminar este registro?\")'><i class='fas fa-trash'></i> Borrar</a></td>";
      echo "</tr>";

    }
    echo "</table>";
  } else {
    // Si no hay registros, mostramos un mensaje
    echo "<p style='text-aling: center;'>No hay registros.<p>";
  }

  ?>
   <p><strong>Opciones:<strong></p>
      <div class="button-container">
      <button onclick="location.href='password_reset.php'" class="btn btn-block btn-outline-warning">Restablecer la contraseña</button><br>
      <button onclick="location.href='logout.php'" class="btn btn-block btn-outline-danger">Cerrar sesión</button>
      </div>
  <a href="../index.php" class="volver-atras">Volver atrás</a>
</body>

</html>