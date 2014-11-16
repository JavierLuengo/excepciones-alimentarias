<?php
include("cap.php");
echo "<div id='centro' class='redondea'>\n";

$miNuevoAlumno = new comidas();

if(isset($_POST["nuevoNombre"]) && $_POST["nuevoNombre"] != "" ){
    $miNuevoAlumno -> agregaComida();  
}else{
    $miNuevoAlumno -> nuevoComida();
    }

echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>