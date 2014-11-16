<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";


if(isset($_POST["primerPlato"]) || isset($_POST["segundolato"]) || isset($_POST["postre"]) || isset($_POST["cursoElegido"]) ){

    $miMenu = new comidas();
    $miMenu -> muestraProblemasHoyPorCurso();  
}else{
    $miMenuporCurso = new comidas();
    $miMenuporCurso -> eligeCurso();
    }

echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>