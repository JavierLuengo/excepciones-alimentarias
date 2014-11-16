<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miIngrediente = new ingredientes();

if(isset($_POST["ingredienteModificado2"])){
	$miIngrediente->modificaIngrediente();
	}else{
if(isset($_POST["ingredienteElegido"])){
    $miIngrediente->muestraIngrediente();    
}else{
    $miIngrediente->eligeIngrediente("modificar");
    }
}
echo "</div>\n";

echo "</div>\n";


include("footer.php");
?>