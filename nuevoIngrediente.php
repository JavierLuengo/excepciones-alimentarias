<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miNuevoingrediente = new ingredientes();

if(isset($_POST["nuevoNombre"]) && $_POST["nuevoNombre"] !=""){
    $miNuevoingrediente -> agregaIngrediente();  
}else{
    $miNuevoingrediente -> nuevoIngrediente();
    }






echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>