<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: ../../login/login.php');
	exit;
}
// Incluir archivo de configuración
require_once "../../config/config.php";
require_once "../../funciones.php";

// Inicializar variables
$id = $_GET["id"] ?? null;

// Si el id está vacío, redirigir a la página principal
if(!$id){
    header("location: index.php");
    exit;
}

// Obtener el rol del usuario
// $rol = obtenerRol($_SESSION["id"], $mysql_db);

// // Verificar el rol del usuario y eliminar el usuario si es posible
// if ($rol == 2) {
  // Eliminar usuario
  $sql = "DELETE FROM rutas WHERE id = ?";
  if($stmt = $mysql_db->prepare($sql)){
      $stmt->bind_param("i", $id);
      if($stmt->execute()){
          // Usuario eliminado correctamente, redirigir a la página principal
          header("location: index.php");
          exit;
      } else{
          // Ha ocurrido un error al eliminar el usuario
          echo "Ha ocurrido un error al eliminar el usuario";
      }
      $stmt->close();
  } else {
      // Ha ocurrido un error al eliminar el usuario
      echo "Ha ocurrido un error al eliminar el usuario";
  }
// } else {
//   // Si el rol del usuario no es 3, mostrar un mensaje de error
//   echo "No tiene permisos para eliminar usuarios.";
// }

// Cerrar la conexión a la base de datos
$mysql_db->close();

?>