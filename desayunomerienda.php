<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miMenu = new comidas();

if(isset($_POST["desayuno"]) || isset($_POST["merienda"]) ){
    $miMenu -> muestraProblemasDesayunoMeriendaHoy();  
}else{
    $miMenu -> entraMenuDesayunoMerienda();
    }

echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>