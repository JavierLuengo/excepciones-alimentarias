<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$todaslasComidas = new comidas();
$todaslasComidas -> listaComidas();  

echo "</div>\n";



echo "</div>\n";

include("footer.php");
?>