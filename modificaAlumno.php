<?php
include("cap.php");

echo "<div id='centro' class='redondea'>\n";

$miAlumno = new alumnos();

if(isset($_POST["alumnoModificado2"])){
	$miAlumno->modificaAlumno();
	$eliminaDuplicado = new alumnos;
	$eliminaDuplicado->eliminaDuplicadoAlumnos();
	
	}else{
if(isset($_POST["alumnoElegido"])){
    $miAlumno->muestraAlumno();    
}else{
    $miAlumno->eligeAlumno("modificar");
	echo "<img src='imagenes/fondo1.jpg' alt='3scuela' class='ancho60'>\n";	
	
	
    }
}
	

echo "</div>\n";

include("footer.php");
?>

