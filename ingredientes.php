<?php
@session_start();

if (class_exists('BBDD')) {
class ingredientes extends BBDD{
	
	
	function nuevoIngrediente(){
	
		echo "<form action='nuevoIngrediente.php'  method='post' autocomplete='off'><br/>\n";
    	echo "<label>Introduce el nombre del nuevo Ingrediente: </label><br/><br/>\n";
        echo "<input class='grande' autofocus type='text'  id='nuevoNombre' name='nuevoNombre' />\n";
    	echo "<br><span  class='alerta' id='error1' style='visibility:hidden'>Nombre de ingrediente incorrecto</span><br/><br/>\n";
	
        $mostrarIn = "SELECT * FROM comidas ORDER BY comida ASC";
        $verIn = mysql_query($mostrarIn);
        echo "<label>Indica las comidas en las que est&aacute; presente este ingrediente </label><br/><br/>";
         echo "<table class='zebra'>";
             echo "<tr>";
             $columna=0;
        
        while($m = mysql_fetch_array($verIn)){
             $idIn = $m["id"];
             $ing = $m["comida"];
			 echo "<td><input class='mini' type='checkbox' name='$idIn' >"  .  "\n" ;   
			 echo "<label>" . $ing . "</label></td>" ;
              $columna++;
             if ($columna==3){
                    echo "</tr><tr>";
                    $columna=0;
                    }
             
            }
                  echo "</tr>";
        echo "</table>";
        
        /*echo "<br/><input type='submit' id='enviaok' style='visibility:hidden' value='envia' / >\n";*/
    	echo "<div class='limpia'></div>";
    	echo "<br/><input type='submit' id='enviaok' style='visibility:hidden' value='envia' / >\n";
    	 
        
        echo "</form>\n";
    	
    	include("compruebaAjaxIngredientes.htm");
		
	
		
		}
	
	function agregaIngrediente(){
	   if ($_POST["nuevoNombre"]==""){
	      	echo "<script type='text/javascript'> window.location = 'nuevoIngrediente.php';</script>";
		   }
		   
       
        $registro = "INSERT INTO ingredientes (ingrediente) VALUES ('".$_POST["nuevoNombre"]."');";
  		mysql_query($registro);
		
        
        $idact= mysql_insert_id();
        
        $trg1 = "SELECT MAX(ID) FROM comidas";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO comidaingrediente(idcomida, idIngrediente) VALUES (" . $contadortxt . "," . $idact . " );";
    	    mysql_query($inserta)
                or die ("algo falla al insertar el registro...");
			}
		  }
        
        
        unset($_POST["nuevoNombre"]);
	 	//echo "<h4>El Ingrediente ha sido creado</h4>";
    	//echo "<br/>";
    	//echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
		echo "<script type='text/javascript'>window.location = 'nuevoIngrediente.php';</script>";
		}
        
 	
		function eligeIngrediente($a){
		echo "<h2>Selecciona el ingrediente que deseas " . $a . "</h2>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        $mostrarN = "SELECT * FROM ingredientes ORDER BY ingrediente";
        $verN = mysql_query($mostrarN);
        echo "<select name=ingredienteElegido>\n";
        while($m = mysql_fetch_array($verN)){
            echo "<option class='grande' value=" . $m["id"]. ">" . $m["ingrediente"] ."\n" ;    
        	}
        echo "<input type='submit' value='$a' / >" ;    
        echo "</form>";
		}
        
        
	function muestraIngrediente(){
		$_SESSION["modificado"]=$_POST["ingredienteElegido"];
    	echo "<form action='modificaIngrediente.php'  method='post'>\n";
            $modificado=$_POST["ingredienteElegido"];
            $mostrarN2 = "SELECT * FROM ingredientes where id='$modificado'" ;
       	    $verN2 = mysql_query($mostrarN2);
        
            while($x = mysql_fetch_array($verN2)){
                echo "<label class='izq'>Ingrediente a modificar</label><br>";
                $nuevoT = $x["ingrediente"];
                echo "<input  type='text' name='ingredienteModificado2' value = '$nuevoT' ><br/><br/>" ;
                
                
        $mostrarIn = "SELECT * FROM comidas ORDER BY comida";
        
        $verIn = mysql_query($mostrarIn);
        echo "<table class='zebra'>";
        echo "<tr>";
        $columna=0;
        while($m = mysql_fetch_array($verIn)){
             $idCom = $m["id"];
             $com = $m["comida"];
             
             
                 $ing = $m ["comida"];
                 $mostrarIn2 = 'SELECT * FROM comidaingrediente WHERE idComida= ' . $idCom . ' AND idIngrediente = ' . $modificado ;
                 $verIngMarcados = mysql_query($mostrarIn2);
             
             if (mysql_num_rows($verIngMarcados)>0){
			 echo "<td><input class='mini' type='checkbox' checked='checked' name='$idCom' >"  .  "\n" ;   
			 }else{
			  echo "<td><input class='mini' type='checkbox' name='$idCom' >"  .  "\n" ;   
			    
			 }
             
             echo "<label>" . $com . "</label></td>" ;
             $columna++;
             if ($columna==3){
                    echo "</tr><tr>";
                    $columna=0;
                    
                 }
            }
        echo "</tr>";
        echo "</table>";
        echo "<div class='limpia'></div>";        
        echo "<input type='submit' value='modifica' / >" ; 
        }
   
     echo "</form>";
		}
	
    
	function modificaIngrediente(){
			
		$IngredienteM = $_POST["ingredienteModificado2"];
        $modificado=$_SESSION["modificado"];
        $txtsql= "UPDATE ingredientes SET ingrediente='$IngredienteM' where id='$modificado' " ;
        $verN3 = mysql_query($txtsql);
   
        $trg1 = "SELECT MAX(ID) FROM comidas";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO comidaingrediente(idcomida, idIngrediente) VALUES (" . $contadortxt . "," . $modificado .  " );";
    	
			}else{
			 $inserta= "DELETE FROM comidaingrediente where idIngrediente = '$modificado' AND idcomida ='$contadortxt' " ;
        	}
            $actualiza=mysql_query($inserta);
		  }
   
   
        //echo "<h4>El Ingrediente ha sido modificado</h4>";
        //echo "<br/>";
        //echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
        echo "<script type='text/javascript'>window.location = 'modificaIngrediente.php';</script>";
		}
	
    
    function borraIngrediente(){
		$ingredienteE = $_POST["ingredienteElegido"];
        $alE = $_POST["ingredienteElegido"];
       	$trg1 = "SELECT MAX(ID) FROM ingredientes";
		$trg2 = mysql_query($trg1);
 		$row = mysql_fetch_row($trg2); 
		$max_id = $row[0]; 
                
        for ($contador=0;$contador<=$max_id;$contador++){
			$contadortxt = (string)$contador;
			if($contadortxt==$alE){
        	  $borraIngrediente=$this->consultar("DELETE FROM ingredientes where id = '$contador'  ");
              $borraSusProblemas=$this->consultar("DELETE FROM alumnoIngrediente where idIngrediente = '$contador'  ");
						
            	}
			}
            echo "<script type='text/javascript'>window.location = 'eliminaIngrediente.php';</script>";
	
            }
    
    
    
    
    
    function listaIngredientes(){
		$mostrarI = "SELECT * FROM ingredientes ORDER BY ingrediente ASC" ;
       	$verN2 = mysql_query($mostrarI);
        echo "<h3>Estos son los ingredientes introducidos hasta el momento</h3>";
		while($c = mysql_fetch_array($verN2)){
            $nuevoT = $c["ingrediente"];
            echo "<p>" .$nuevoT . "</p>" ;
            }
        echo "<br/><a href='nuevoIngrediente.php'>A&ntilde;adir m&aacute;s</a>";    
    
    }
    
}	
	
}
?>	