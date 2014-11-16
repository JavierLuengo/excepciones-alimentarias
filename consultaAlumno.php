<?php
include("cap.php");
echo "<div id='centro' class='redondea'>\n";

$todoslosalumnos = new alumnos();
$todoslosalumnos -> listaAlumnos();  

echo "</div>\n";

echo "</div>\n";
include("footer.php");
?>