<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miexingrediente = new ingredientes();

if(isset($_POST["ingredienteElegido"])){
    $miexingrediente->borraIngrediente();    
}else{
    $miexingrediente->eligeIngrediente("eliminar");
    }

echo "</div>\n";

echo "</div>\n";



include("footer.php");
?>