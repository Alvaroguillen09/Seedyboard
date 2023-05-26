<?php

session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
    header('location: ./login/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <title>Crear rutas</title>
    <link rel="icon" type="img/png" href="img/logo7.png" />
    <link rel="stylesheet" href="style/styleCrear.css">
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var areas = document.querySelectorAll("area");
    var initialCircle = document.getElementById("initialCircle");
    var circles = [];
    var firstClick = true;

    areas.forEach(function(area, index) {
      area.addEventListener("click", function(event) {
        var coords = this.coords.split(",");
        var left = parseInt(coords[0]);
        var top = parseInt(coords[1]);
        var right = parseInt(coords[2]);
        var bottom = parseInt(coords[3]);

        var centerX = (left + right) / 2;
        var centerY = (top + bottom) / 2;

        // Verificar si el círculo ya existe en esa posición
        var existingCircle = document.querySelector(".circle[data-center-x='" + centerX + "'][data-center-y='" + centerY + "']");
        if (existingCircle) {
          // Si el círculo existe, eliminarlo
          existingCircle.remove();
        } else {
          // Si el círculo no existe, crear uno nuevo
          var circle = document.createElement("div");
          circle.className = "circle";
          circle.dataset.centerX = centerX;
          circle.dataset.centerY = centerY;

          // Obtener el contenedor de la imagen
          var imageContainer = document.querySelector(".contenedor-imagen");

          // Calcular la posición absoluta del círculo en relación con el contenedor de la imagen
          var containerRect = imageContainer.getBoundingClientRect();
          var containerLeft = containerRect.left + window.scrollX;
          var containerTop = containerRect.top + window.scrollY;

          // Calcular la posición absoluta del círculo en relación con la ventana
          var circleX = containerLeft + centerX;
          var circleY = containerTop + centerY;

          // Establecer la posición absoluta del círculo
          circle.style.left = circleX + "px";
          circle.style.top = circleY + "px";

          // Asignar el color al círculo según el primer click y los siguientes
          if (firstClick) {
            circle.style.backgroundColor = "green"; // Primer círculo en verde
            firstClick = false;
          } else {
            circle.style.backgroundColor = "red"; // Resto de círculos en rojo
          }

          // Verificar si ya existe el círculo inicial y eliminarlo
          if (initialCircle) {
            initialCircle.remove();
            initialCircle = null;
          }

          imageContainer.appendChild(circle);
        }
      });
    });
  });
</script>

</head>

<body>
<img src="img/logo5.PNG" alt="Mi imagen" style="display: block; margin: 0 auto;">
<h1>Crea tu ruta</h1>
<p>Selecciona las piezas que tendrá la ruta, asígnale un nombre y proporciona una breve descripción sobre cómo completarla y añádele un grado de dificultad.</p>
    <div class="wrapper">
        <form>
            <div class="contenedor-imagen">
                <img src="img/paredFinal.png" usemap="#image-map" style="display: block; margin: 0 auto; border-radius: 15px; border: 3px solid rgb(33, 40, 43);">
                <map name="image-map">
                    <area shape="rect" alt="1" title="1" coords="67,597,104,630">
                    <area shape="rect" alt="2" title="2" coords="102,588,60,551">
                    <area shape="rect" alt="3" title="3" coords="102,534,54,486">
                    <area shape="rect" alt="4" title="4" coords="111,483,56,445">
                    <area shape="rect" alt="5" title="5" coords="109,438,56,394">
                    <area shape="rect" alt="6" title="6" coords="108,388,57,347">
                    <area shape="rect" alt="7" title="7" coords="106,340,53,301">
                    <area shape="rect" alt="8" title="8" coords="104,295,46,251">
                    <area shape="rect" alt="9" title="9" coords="108,245,52,201">
                    <area shape="rect" alt="10" title="10" coords="108,193,56,150">
                    <area shape="rect" alt="11" title="11" coords="104,143,54,109">
                    <area shape="rect" alt="12" title="12" coords="109,100,52,58">
                    <area shape="rect" alt="13" title="13" coords="113,55,160,100">
                    <area shape="rect" alt="14" title="14" coords="110,106,157,138">
                    <area shape="rect" alt="15" title="15" coords="116,147,160,197">
                    <area shape="rect" alt="16" title="16" coords="115,203,161,245">
                    <area shape="rect" alt="17" title="17" coords="114,247,161,291">
                    <area shape="rect" alt="18" title="18" coords="115,298,157,340">
                    <area shape="rect" alt="19" title="19" coords="117,346,159,386">
                    <area shape="rect" alt="20" title="20" coords="116,392,160,434">
                    <area shape="rect" alt="21" title="21" coords="119,444,152,477">
                    <area shape="rect" alt="22" title="22" coords="112,488,160,527">
                    <area shape="rect" alt="23" title="23" coords="107,536,158,586">
                    <area shape="rect" alt="24" title="24" coords="113,595,156,629">
                    <area shape="rect" alt="25" title="25" coords="202,623,168,596">
                    <area shape="rect" alt="26" title="26" coords="203,586,162,541">
                    <area shape="rect" alt="27" title="27" coords="202,531,170,494">
                    <area shape="rect" alt="28" title="28" coords="199,483,166,442">
                    <area shape="rect" alt="29" title="29" coords="198,435,166,392">
                    <area shape="rect" alt="30" title="30" coords="200,383,164,348">
                    <area shape="rect" alt="31" title="31" coords="206,344,165,302">
                    <area shape="rect" alt="32" title="32" coords="206,293,168,248">
                    <area shape="rect" alt="33" title="33" coords="208,239,169,199">
                    <area shape="rect" alt="34" title="34" coords="208,194,165,152">
                    <area shape="rect" alt="35" title="35" coords="205,147,165,106">
                    <area shape="rect" alt="36" title="36" coords="210,99,167,56">
                    <area shape="rect" alt="37" title="37" coords="214,54,254,99">
                    <area shape="rect" alt="38" title="38" coords="212,106,251,140">
                    <area shape="rect" alt="39" title="39" coords="215,148,253,190">
                    <area shape="rect" alt="40" title="40" coords="214,198,259,245">
                    <area shape="rect" alt="41" title="41" coords="212,251,255,290">
                    <area shape="rect" alt="42" title="42" coords="213,300,254,336">
                    <area shape="rect" alt="43" title="43" coords="209,349,259,390">
                    <area shape="rect" alt="44" title="44" coords="207,396,258,434">
                    <area shape="rect" alt="45" title="45" coords="208,444,256,481">
                    <area shape="rect" alt="46" title="46" coords="209,488,255,534">
                    <area shape="rect" alt="47" title="47" coords="211,543,256,585">
                    <area shape="rect" alt="48" title="48" coords="210,592,254,631">
                    <area shape="rect" alt="49" title="49" coords="304,632,265,592">
                    <area shape="rect" alt="50" title="50" coords="300,583,262,545">
                    <area shape="rect" alt="51" title="51" coords="299,539,263,489">
                    <area shape="rect" alt="52" title="52" coords="300,484,262,445">
                    <area shape="rect" alt="53" title="53" coords="300,440,262,394">
                    <area shape="rect" alt="54" title="54" coords="302,388,267,348">
                    <area shape="rect" alt="55" title="55" coords="305,341,262,299">
                    <area shape="rect" alt="56" title="56" coords="302,292,261,253">
                    <area shape="rect" alt="57" title="57" coords="298,244,267,199">
                    <area shape="rect" alt="58" title="58" coords="298,192,262,159">
                    <area shape="rect" alt="59" title="59" coords="304,151,260,108">
                    <area shape="rect" alt="60" title="60" coords="297,100,259,57">
                    <area shape="rect" alt="61" title="61" coords="308,55,344,96">
                    <area shape="rect" alt="62" title="62" coords="310,105,349,147">
                    <area shape="rect" alt="63" title="63" coords="310,155,350,188">
                    <area shape="rect" alt="64" title="64" coords="307,195,358,243">
                    <area shape="rect" alt="65" title="65" coords="307,247,357,294">
                    <area shape="rect" alt="66" title="66" coords="312,300,349,344">
                    <area shape="rect" alt="67" title="67" coords="308,349,353,389">
                    <area shape="rect" alt="68" title="68" coords="307,395,355,436">
                    <area shape="rect" alt="69" title="69" coords="307,442,355,484">
                    <area shape="rect" alt="70" title="70" coords="307,491,353,536">
                    <area shape="rect" alt="71" title="71" coords="305,542,354,585">
                    <area shape="rect" alt="72" title="72" coords="308,591,353,633">
                    <area shape="rect" alt="73" title="73" coords="394,629,360,593">
                    <area shape="rect" alt="74" title="74" coords="397,583,362,540">
                    <area shape="rect" alt="75" title="75" coords="398,534,360,489">
                    <area shape="rect" alt="76" title="76" coords="402,481,362,445">
                    <area shape="rect" alt="77" title="77" coords="398,437,360,394">
                    <area shape="rect" alt="78" title="78" coords="398,387,359,347">
                    <area shape="rect" alt="79" title="79" coords="403,339,354,301">
                    <area shape="rect" alt="80" title="80" coords="400,292,363,249">
                    <area shape="rect" alt="81" title="81" coords="400,242,365,202">
                    <area shape="rect" alt="82" title="82" coords="405,191,359,158">
                    <area shape="rect" alt="83" title="83" coords="400,151,357,106">
                    <area shape="rect" alt="84" title="84" coords="400,97,358,51">
                    <area shape="rect" alt="85" title="85" coords="407,51,447,95">
                    <area shape="rect" alt="86" title="86" coords="406,106,451,147">
                    <area shape="rect" alt="87" title="87" coords="410,156,451,196">
                    <area shape="rect" alt="88" title="88" coords="406,202,453,246">
                    <area shape="rect" alt="89" title="89" coords="408,253,446,290">
                    <area shape="rect" alt="90" title="90" coords="410,296,456,344">
                    <area shape="rect" alt="91" title="91" coords="403,349,452,386">
                    <area shape="rect" alt="92" title="92" coords="405,392,449,437">
                    <area shape="rect" alt="93" title="93" coords="408,442,458,484">
                    <area shape="rect" alt="94" title="94" coords="403,493,454,537">
                    <area shape="rect" alt="95" title="95" coords="403,545,454,583">
                    <area shape="rect" alt="96" title="96" coords="402,593,452,631">
                </map>

            </div>

            <script>
                // Obtener todas las áreas
                var areas = document.getElementsByTagName('area');

                // Array para almacenar los valores de los checkbox
                var valoresCheckbox = [];

                // Añadir un evento de clic a cada área
                for (var i = 0; i < areas.length; i++) {
                    areas[i].addEventListener('click', function() {
                        // Obtener el checkbox asociado a esta área
                        var checkbox = document.getElementById('checkbox' + this.title);
                        if (checkbox.checked) {
                            checkbox.value = 0; // Si el checkbox estaba marcado, establecer el valor a 255
                        } else {
                            checkbox.value = 255; // Si el checkbox no estaba marcado, establecer el valor a 0
                        }
                        checkbox.checked = !checkbox.checked;

                        // Almacenar el valor del checkbox en el array
                        var index = parseInt(this.title) - 1;
                        valoresCheckbox[index] = checkbox.value;

                        // Recorrer todas las checkbox para verificar si hay alguna que no esté marcada
                        for (var j = 0; j < areas.length; j++) {
                            var checkboxTemp = document.getElementById('checkbox' + (j + 1));
                            if (!checkboxTemp.checked) {
                                checkboxTemp.value = 0; // Si la checkbox no está marcada, establecer el valor a 0
                                valoresCheckbox[j] = checkboxTemp.value;
                            }
                        }

                        console.log(valoresCheckbox); // Mostrar el array en la consola
                        var resultadoDiv = document.getElementById('resultado');
                        resultadoDiv.innerHTML = valoresCheckbox.join(', ');
                    });
                }
            </script>

            <style>
                .oculto {
                    display: none;
                }
            </style>
            <div class="oculto">
                <form name="hola" method="POST">

                    <input type="checkbox" onclick='agregarValor()' id="checkbox1" style="display: none;" name="opcion1"><label for="checkbox1" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox2" style="display: none;" name="opcion2"><label for="checkbox2" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox3" style="display: none;" name="opcion3"><label for="checkbox3" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox4" style="display: none;" name="opcion4"><label for="checkbox4" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox5" style="display: none;" name="opcion5"><label for="checkbox5" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox6" style="display: none;" name="opcion6"><label for="checkbox6" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox7" style="display: none;" name="opcion7"><label for="checkbox7" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox8" style="display: none;" name="opcion8"><label for="checkbox8" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox9" style="display: none;" name="opcion9"><label for="checkbox9" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox10" style="display: none;" name="opcion10"><label for="checkbox10" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox11" style="display: none;" name="opcion11"><label for="checkbox11" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox12" style="display: none;" name="opcion12"><label for="checkbox12" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox13" style="display: none;" name="opcion13"><label for="checkbox13" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox14" style="display: none;" name="opcion14"><label for="checkbox14" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox15" style="display: none;" name="opcion15"><label for="checkbox15" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox16" style="display: none;" name="opcion16"><label for="checkbox16" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox17" style="display: none;" name="opcion17"><label for="checkbox17" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox18" style="display: none;" name="opcion18"><label for="checkbox18" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox19" style="display: none;" name="opcion19"><label for="checkbox19" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox20" style="display: none;" name="opcion20"><label for="checkbox20" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox21" style="display: none;" name="opcion21"><label for="checkbox21" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox22" style="display: none;" name="opcion22"><label for="checkbox22" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox23" style="display: none;" name="opcion23"><label for="checkbox23" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox24" style="display: none;" name="opcion24"><label for="checkbox24" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox25" style="display: none;" name="opcion25"><label for="checkbox25" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox26" style="display: none;" name="opcion26"><label for="checkbox26" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox27" style="display: none;" name="opcion27"><label for="checkbox27" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox28" style="display: none;" name="opcion28"><label for="checkbox28" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox29" style="display: none;" name="opcion29"><label for="checkbox29" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox30" style="display: none;" name="opcion30"><label for="checkbox30" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox31" style="display: none;" name="opcion31"><label for="checkbox31" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox32" style="display: none;" name="opcion32"><label for="checkbox32" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox33" style="display: none;" name="opcion33"><label for="checkbox33" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox34" style="display: none;" name="opcion34"><label for="checkbox34" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox35" style="display: none;" name="opcion35"><label for="checkbox35" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox36" style="display: none;" name="opcion36"><label for="checkbox36" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox37" style="display: none;" name="opcion37"><label for="checkbox37" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox38" style="display: none;" name="opcion38"><label for="checkbox38" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox39" style="display: none;" name="opcion39"><label for="checkbox39" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox40" style="display: none;" name="opcion40"><label for="checkbox40" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox41" style="display: none;" name="opcion41"><label for="checkbox41" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox42" style="display: none;" name="opcion42"><label for="checkbox42" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox43" style="display: none;" name="opcion43"><label for="checkbox43" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox44" style="display: none;" name="opcion44"><label for="checkbox44" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox45" style="display: none;" name="opcion45"><label for="checkbox45" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox46" style="display: none;" name="opcion46"><label for="checkbox46" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox47" style="display: none;" name="opcion47"><label for="checkbox47" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox48" style="display: none;" name="opcion48"><label for="checkbox48" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox49" style="display: none;" name="opcion49"><label for="checkbox49" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox50" style="display: none;" name="opcion50"><label for="checkbox50" hidden></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox51" style="display: none;" name="opcion51"><label for="checkbox51"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox52" style="display: none;" name="opcion52"><label for="checkbox52"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox53" style="display: none;" name="opcion53"><label for="checkbox53"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox54" style="display: none;" name="opcion54"><label for="checkbox54"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox55" style="display: none;" name="opcion55"><label for="checkbox55"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox56" style="display: none;" name="opcion56"><label for="checkbox56"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox57" style="display: none;" name="opcion57"><label for="checkbox57"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox58" style="display: none;" name="opcion58"><label for="checkbox58"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox59" style="display: none;" name="opcion59"><label for="checkbox59"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox60" style="display: none;" name="opcion60"><label for="checkbox60"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox61" style="display: none;" name="opcion61"><label for="checkbox61"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox62" style="display: none;" name="opcion62"><label for="checkbox62"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox63" style="display: none;" name="opcion63"><label for="checkbox63"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox64" style="display: none;" name="opcion64"><label for="checkbox64"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox65" style="display: none;" name="opcion65"><label for="checkbox65"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox66" style="display: none;" name="opcion66"><label for="checkbox66"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox67" style="display: none;" name="opcion67"><label for="checkbox67"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox68" style="display: none;" name="opcion68"><label for="checkbox68"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox69" style="display: none;" name="opcion69"><label for="checkbox69"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox70" style="display: none;" name="opcion70"><label for="checkbox70"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox71" style="display: none;" name="opcion71"><label for="checkbox71"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox72" style="display: none;" name="opcion72"><label for="checkbox72"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox73" style="display: none;" name="opcion73"><label for="checkbox73"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox74" style="display: none;" name="opcion74"><label for="checkbox74"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox75" style="display: none;" name="opcion75"><label for="checkbox75"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox76" style="display: none;" name="opcion76"><label for="checkbox76"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox77" style="display: none;" name="opcion77"><label for="checkbox77"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox78" style="display: none;" name="opcion78"><label for="checkbox78"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox79" style="display: none;" name="opcion79"><label for="checkbox79"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox80" style="display: none;" name="opcion80"><label for="checkbox80"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox81" style="display: none;" name="opcion81"><label for="checkbox81"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox82" style="display: none;" name="opcion82"><label for="checkbox82"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox83" style="display: none;" name="opcion83"><label for="checkbox83"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox84" style="display: none;" name="opcion84"><label for="checkbox84"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox85" style="display: none;" name="opcion85"><label for="checkbox85"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox86" style="display: none;" name="opcion86"><label for="checkbox86"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox87" style="display: none;" name="opcion87"><label for="checkbox87"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox88" style="display: none;" name="opcion88"><label for="checkbox88"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox89" style="display: none;" name="opcion89"><label for="checkbox89"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox90" style="display: none;" name="opcion90"><label for="checkbox90"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox91" style="display: none;" name="opcion91"><label for="checkbox91"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox92" style="display: none;" name="opcion92"><label for="checkbox92"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox93" style="display: none;" name="opcion93"><label for="checkbox93"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox94" style="display: none;" name="opcion94"><label for="checkbox94"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox95" style="display: none;" name="opcion95"><label for="checkbox95"></label><br>
                    <input type="checkbox" onclick='agregarValor()' id="checkbox96" style="display: none;" name="opcion96"><label for="checkbox96"></label><br>

                </form>
            </div>
            <div>
            <form method="post" onsubmit="setResultado()">
                <label for="nombre">Nombre de la ruta:</label>
                <input type="text" id="nombre" name="nombre"><br><br>

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

                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion"><br><br>


                <div id="resultado" style="display: none;"></div>
                <input type="hidden" id="resultado-hidden" name="resultado">


                <input type="submit" value="Crear">
            </form>
            <?php
            // Establecer la conexión a la base de datos
            $conn = mysqli_connect("localhost", "root", "", "escalada");

            // Procesar los datos del formulario
            if (isset($_POST['resultado'])) {
                $resultado = $_POST['resultado'];
                $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
                $dificultad = mysqli_real_escape_string($conn, $_POST['dificultad']);
                $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

                // Insertar los datos en la tabla rutas de la base de datos utilizando una consulta preparada
                $stmt = mysqli_prepare($conn, "INSERT INTO rutas (nombre, dificultad, descripcion, leds, user_id) VALUES (?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $dificultad, $descripcion, $resultado, $_SESSION['id']);
                if (mysqli_stmt_execute($stmt)) {
                    echo "La ruta se ha creado correctamente.";
                } else {
                    echo "Ha ocurrido un error.";
                }
                mysqli_stmt_close($stmt);
            }

            ?>
            </div>
            <script>
                function setResultado() {
                    var resultado = document.getElementById("resultado").innerHTML;
                    document.getElementById("resultado-hidden").value = resultado;
                }
            </script>
</div>
            
        </form>
    
    <div id="initialCircle" class="circle"></div>
    <a href="index.php" class="volver-atras">Volver atrás</a>
</body>

</html>