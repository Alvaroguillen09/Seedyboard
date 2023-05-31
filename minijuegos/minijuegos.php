<!DOCTYPE html>
<html>

<head>
    <title>Minijuegos</title>
    <link rel="stylesheet" type="text/css" href="styleMinijuegos.css">
    <link rel="icon" type="img/png" href="../img/logo7.png" />
</head>

<body>
<img src="../img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">
<br>
<h1>Minijuegos</h1>
<p>Elige uno de nuestros minijuegos y pon a prueba tus habilidades en la escalada.<p>
    <div class="game-container"><br>
        <div class="game-title">Solo quedara uno</div><br>
        <img src="../img/mini1.jpg" alt="Imagen del juego">
        <div class="game-description"><strong>Descripción:</strong><br><br>
            Este minijuego pondrá a prueba tu habilidad y resistencia. En la pared, cada 5 segundos, un LED se apagará.<br>
            Al principio, será fácil, pero a medida que avances, el cansancio y las opciones de agarre se reducirán, <br>
            planteándote un desafío cada vez mayor. ¿Podrás soportarlo hasta el final?
            <br><br>
            <strong>Dificultad:</strong> Media
        </div>
        <div class="button-container">
            <form action="mandar_arduino2.php" method="post"class="inline-form">
                <input type="hidden" name="valor" value="103">
                <input class="button" type="submit" value="Jugar">
            </form>
            <form action="mandar_arduino2.php" method="post"class="inline-form">
                <input type="hidden" name="valor" value="105">
                <input class="button" type="submit" value="Terminar">
            </form>
        </div>
    </div>
<br><br>
    <div class="game-container"><br>
        <div class="game-title">Sígueme</div><br>
        <img src="../img/mini3.jpg" alt="Imagen del juego">
        <div class="game-description"><strong>Descripción:</strong><br><br>
            Un LED se desplazará por la pared de manera aleatoria y tú deberás intentar seguirlo con todas tus fuerzas.<br>
            Cada movimiento requerirá concentración y destreza, pero ten cuidado, ya que tu resistencia será puesta a <br>
            prueba hasta sus límites.
            <br><br>
            <strong>Dificultad:</strong> Media
        </div><div class="button-container">
  <form action="mandar_arduino2.php" method="post" class="inline-form">
    <input type="hidden" name="valor" value="104">
    <input class="button" type="submit" value="Jugar">
  </form>
  <form action="mandar_arduino2.php" method="post" class="inline-form">
    <input type="hidden" name="valor" value="105">
    <input class="button" type="submit" value="Terminar">
  </form>
</div>

    </div>
<br><br>
    <p>¿Tienes una idea para un emocionante minijuego? ¡Queremos escuchar tus sugerencias y convertirlas en realidad! Comparte tu propuesta y sé parte de la diversión.
        Haz clic <a href="formulario.php" class="btn btn-primary">Aqui</a> para enviar tu idea.</p>
        
    <a href="../index.php" class="volver-atras">Volver atrás</a>
</body>

</html>