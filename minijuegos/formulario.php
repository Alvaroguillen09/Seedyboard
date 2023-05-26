<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="img/png" href="../img/logo7.png" />
    <title>Sugerencias</title>
    <link rel="stylesheet" href="styleFormulario.css">
</head>

<body>
    <img src="../img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;"><br>
    <h2>Envía tu sugerencia para un minijuego nuevo:</h2>
    <div class="game-container"><br>
        <div class="game-description2">
            <form action="mailto:contactoseedyboard@gmail.com?cc=soporteseedyboard@gmail.com&subject=Minijuego%20nuevo:%20" method="post" enctype="text/plain">
                <label for="nombre">Nombre:</label><br><br>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="descripcion">Descripción y reglas del minijuego:</label><br><br>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>
                <input class="button" type="submit" value="Enviar">
            </form>
        </div>

    </div>
    <a href="../index.php" class="volver-atras">Volver atrás</a>
</body>

</html>