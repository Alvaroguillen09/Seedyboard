<?php
function obtenerRol($id_usuario, $mysql_db) {
    // Consulta SQL para obtener el rol del usuario
    $consulta = "SELECT rol_id FROM users WHERE id = $id_usuario";
  
    // Ejecutar la consulta y obtener el resultado
    $resultado = mysqli_query($mysql_db, $consulta);
  
    // Obtener el rol del usuario desde el resultado
    $fila = mysqli_fetch_assoc($resultado);
    $rol = $fila['rol_id'];
  
    // Devolver el rol del usuario
    return $rol;
  }
  