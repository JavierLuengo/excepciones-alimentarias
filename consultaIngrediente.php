<?php
include("cap.php");
echo "<div id='centro' class='redondea'>\n";

$miIngrediente = new ingredientes();

$miIngrediente -> listaIngredientes();  

echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>