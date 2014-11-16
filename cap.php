<?php
session_start();
/*
if($_SESSION["conectado"]!="ok"){
	echo "<script>window.location.assign('validar.php')</script>";
}
*/



include ("basedatos.php");
include("alumnos.php");
include("ingredientes.php");
include("comidas.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Escuela</title>
	
	  <!-- Bootstrap 
    <link href="../ejemplosBootstrap/css/bootstrap.min.css" rel="stylesheet">
-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
	
	<link rel="stylesheet" href="fancydropdown.css">
	<link rel='stylesheet' href='css/estilo2.css' type='text/css' />
	
	<script>
	window.onload=function(){
	
	var alturamax = window.innerHeight-document.getElementById("menu").clientHeight- document.getElementById("footer").clientHeight;
  
  if (document.getElementById("cuadroInicio")!=null){
	var alturaCI = document.getElementById("cuadroInicio").clientHeight;
		
	 if (alturaCI< alturamax ){
		document.getElementById("cuadroInicio").style.height = alturamax-40+"px" ;
	}
	}
	
	
	if (document.getElementById("centro")!=null){
	var alturaCentro = document.getElementById("centro").clientHeight;
	
 if (alturaCentro< alturamax ){
		document.getElementById("centro").style.height = alturamax-129+"px" ;
	}
	}
	
}

</script>
	
	
</head>
<body>

<div id="menu">

        
<ul class="tabs">
	<li><h4><a href="index.php">Inicio</a></h4></li>
	
	<li class="hasmore"><a href="#"><span>Alumnos</span></a>
		<ul class="dropdown">
			<li><a href="nuevoAlumno.php">Altas</a></li>
			<li><a href="eliminaAlumno.php">Bajas</a></li>
			<li class="last"><a href="modificaAlumno.php">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Comidas</span></a>
		<ul class="dropdown">
			<li><a href="nuevaComida.php">Altas</a></li>
			<li><a href="eliminaComida.php">Bajas</a></li>
			<li class="last"><a href="modificaComida.php">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Ingredientes</span></a>
		<ul class="dropdown">
			<li><a href="nuevoIngrediente.php">Altas</a></li>
			<li><a href="eliminaIngrediente.php">Bajas</a></li>
			<li class="last"><a href="modificaIngrediente.php#">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Listados</span></a>
		<ul class="dropdown">
			<li><a href="consultaIngrediente.php">Ingredientes</a></li>
			<li><a href="consultaAlumno.php">Alumnos</a></li>
			<li class="last"><a href="consultaComida.php">Comidas</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Problemas</span></a>
		<ul class="dropdown">
			<li><a href="menuporcurso.php">Men&uacute;</a></li>
			<li class="last"><a href="desayunomerienda.php">Desayuno/merienda</a></li>
		</ul>
	</li>
	
	<li><h4><a href="/">Carpehosting</a></h4></li>
</ul>
</div>

<script type="text/javascript" src="fancydropdown.js"></script>