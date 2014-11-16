<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Escuela</title>
	<link rel="stylesheet" href="fancydropdown.css">
</head>
<body>

<div id="menu">

        
<ul class="tabs">
	<li><h4><a href="#">Inicio</a></h4></li>
	
	<li class="hasmore"><a href="#"><span>Alumnos</span></a>
		<ul class="dropdown">
			<li><a href="nuevoAlumno.php">Altas</a></li>
			<li><a href="eliminaAlumno.php">Bajas</a></li>
			<li class="last"><a href="modificaAlumno.php">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Comidas</span></a>
		<ul class="dropdown">
			<li><a href="#">Altas</a></li>
			<li><a href="#">Bajas</a></li>
			<li class="last"><a href="#">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Ingredientes</span></a>
		<ul class="dropdown">
			<li><a href="#">Altas</a></li>
			<li><a href="#">Bajas</a></li>
			<li class="last"><a href="#">Modificaciones</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Listados</span></a>
		<ul class="dropdown">
			<li><a href="#">Ingredientes</a></li>
			<li><a href="#">Alumnos</a></li>
			<li class="last"><a href="#">Comidas</a></li>
		</ul>
	</li>
	<li class="hasmore"><a href="#"><span>Problemas</span></a>
		<ul class="dropdown">
			<li><a href="#">Men&uacute;</a></li>
			<li class="last"><a href="#">Desayuno/merienda</a></li>
		</ul>
	</li>
	
	<li><a href="#"><span>Bookmarks</span></a></li>
</ul>
</div>

<script type="text/javascript" src="fancydropdown.js"></script>
</body>
</html>
