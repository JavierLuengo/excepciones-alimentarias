<?php
include("cap.php");
echo "<div id='centro' class='redondea'>\n";

$miNuevoAlumno = new alumnos();

if(isset($_POST["nuevoNombre"]) && $_POST["nuevoNombre"] != "" ){
    $miNuevoAlumno -> agregaAlumno();  
}else{
    $miNuevoAlumno -> nuevoAlumno();
    }

echo "</div>\n";


echo "</div>\n";

include("footer.php");
?>