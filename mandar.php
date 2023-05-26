<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
    header('location: ./login/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="img/png" href="img/logo7.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
    <link rel="stylesheet" href="style/styleMandar.css">
    <link rel="icon" type="img/png" href="img/logo7.png" />
</head>

<body>
    
    <img src="img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">
    <h1>Lista de rutas:</h1>
    <p>Elige la ruta que quieres escalar.</p>
    <div class="container">
        <h2>Rutas:</h2>
        <form method="POST" action="mandar_arduino.php">
            <label for="ruta"></label>
            <select id="ruta" name="ruta">
                <?php
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "escalada";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }
                // Consulta SQL para obtener las rutas agrupadas por dificultad
                $sql = "SELECT id, nombre, leds, dificultad FROM rutas ORDER BY dificultad ASC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $rutasPorDificultad = array();

                    // Agrupar las rutas por dificultad
                    while ($row = mysqli_fetch_assoc($result)) {
                        $dificultad = $row['dificultad'];
                        if (!isset($rutasPorDificultad[$dificultad])) {
                            $rutasPorDificultad[$dificultad] = array();
                        }
                        $rutasPorDificultad[$dificultad][] = $row;
                    }

                    // Mostrar las rutas por dificultad
                    foreach ($rutasPorDificultad as $dificultad => $rutas) {
                        echo "<optgroup label='Dificultad: $dificultad'>";
                        foreach ($rutas as $ruta) {
                            echo "<option value='" . $ruta['leds'] . "'>" . $ruta['nombre'] . "</option>";
                        }
                        echo "</optgroup>";
                    }
                } else {
                    echo "No se encontraron resultados";
                    exit;
                }

                // Cierre de la conexión a la base de datos
                mysqli_close($conn);
                ?>
            </select>
            <button type="submit">Escalar</button>
        </form>
    </div>
    <a href="index.php" class="volver-atras">Volver atrás</a>
</body>

</html>