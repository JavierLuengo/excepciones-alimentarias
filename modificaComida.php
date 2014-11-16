<?php
include("cap.php");
echo "<div id='centro' class='redondea'>\n";

$miComida = new comidas();

if(isset($_POST["comidaModificado2"])){
	$miComida->modificaComida();
	}else{
if(isset($_POST["comidaElegido"])){
    $miComida->muestraComida();    
}else{
    $miComida->eligeComida("modificar");
    }
}
echo "</div>\n";

echo "</div>\n";


include("footer.php");
?>