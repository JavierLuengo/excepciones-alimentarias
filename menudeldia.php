<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miMenu = new comidas();

if(isset($_POST["primerPlato"]) || isset($_POST["segundolato"]) || isset($_POST["postre"])){
    $miMenu -> muestraProblemasHoy();  
}else{
    $miMenu -> entraMenu();
    }

echo "</div>\n";



echo "</div>\n";
echo "</body>\n";

echo "</html>\n";
?>