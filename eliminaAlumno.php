<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miexAlumno = new alumnos();

if(isset($_POST["alumnoElegido"])){
    $miexAlumno->borraAlumno();    
}else{
    $miexAlumno->eligeAlumno("eliminar");
    }

echo "</div>\n";

echo "</div>\n";

include("footer.php");
?>