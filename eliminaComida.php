<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miexComida = new comidas();

if(isset($_POST["comidaElegido"])){
    $miexComida->borraComida();    
}else{
    $miexComida->eligeComida("eliminar");
    }

echo "</div>\n";

echo "</div>\n";


include("footer.php");
?>