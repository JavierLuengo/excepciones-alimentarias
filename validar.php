
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Escuela</title>
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

<?php 
if (isset($_POST["password"])&& $_POST["password"]=="1234"){
	@session_start();
	$_SESSION["conectado"]="ok";
	echo "<script>window.location.assign('index.php')</script>";
}else{



echo "<div id='cuadroInicio'>\n";

echo "<div id='fotocentro' >\n";

echo "<img id='fotogrande' src='http://www.carpehosting.com/nuevo/imagenes/est09w.jpg' alt='casa' width='400px' />";

echo "</div>";

echo "<div class='centrado' id='textocentro' >\n";
echo "<h1>Gesti&oacuten de excepciones alimentarias</h1>\n";
echo "<h2>Entorno de pruebas</h2>";
echo "<h2>Todos los datos incluidos en esta aplicaci&oacute;n son ficticios</h2>";
?>
<form action='' method='post'>
<input type='password' name='password' class='ancho120px'>
<input type='submit' value='Entrar'>

</form>
</div>


<?php } ?>

</div>
</body>
</html>