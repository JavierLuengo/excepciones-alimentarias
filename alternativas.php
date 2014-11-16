<?php
@session_start();

include ("basedatos.php");
include ("head.php");
include("cabecera.php");
include("alumnos.php");
include("comidas.php");
include("ingredientes.php");
include("pie.php");

$miHead = new head();
$miHead->crearHead("Men&uacute; del d&iacute;a");

echo "<body>\n";
echo "<div id='contenedor'>\n";

$miCabecera = new cabecera();
$miCabecera -> crearCabecera("- alternativas");

$miMenu = new cabecera();
$miMenu -> crearMenu();

echo "<div id='centro' class='redondea'>\n";

$miMenu = new comidas();
$miMenu -> alternativas();  

echo "</div>\n";

$miPie = new pie();
$miPie -> crearPie();

echo "</div>\n";
echo "</body>\n";

echo "</html>\n";
?>