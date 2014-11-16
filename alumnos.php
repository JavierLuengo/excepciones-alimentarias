<?php
@session_start();

if (class_exists('BBDD')) {
class alumnos extends BBDD{
	
	
	function nuevoAlumno(){
	
		echo "<form action='nuevoAlumno.php'  method='post'><br/>\n";
    	echo "<label>Introduce el nombre del nuevo alumno: </label><br/>\n";
        echo "<input autofocus class='grande' type='text' id='nuevoNombre' name='nuevoNombre' />\n";
    	echo "<span  class='alerta' id='error1' style='visibility:hidden'>Nombre incorrecto</span><br/>";
        
		echo "<label>Introduce el curso: </label><br/>\n";
       	 echo "<input  class='mini' type='text' id='nuevoCurso' name='nuevoCurso' />\n";
       	 echo "<span class='alerta' id='error2' style='visibility:hidden'>Curso incorrecto</span><br/>";
        
        echo "<label>Introduce sus incompatibilidades: </label><br/>\n" ;
        
         echo "<table class='zebra'>";
        echo "<tr>";
        $columna=0;
        
        
        $mostrarIn = "SELECT * FROM ingredientes ORDER BY ingrediente ASC";
        $verIn = mysql_query($mostrarIn);
        
        while($m = mysql_fetch_array($verIn)){
             $idIn = $m["id"];
             $ing = $m ["ingrediente"];
			 echo "<td><input class='mini' type='checkbox' name='$idIn' >"  .  "\n" ;   
			 echo "<label>" . $ing . "</label></td>" ;
             $columna++;
             if ($columna==4){
                    echo "</tr><tr>";
                    $columna=0;
                    
                 }
              
            }
        echo "</tr>";
        echo "</table>";
        
    	echo "<br/><input id='enviaok' style='visibility:hidden' type='submit' value='envia' / >\n";
    	echo "</form>\n";
    	
       	include("compruebaAjax.htm");
    	
		}
	
	function agregaAlumno(){
	   if ($_POST["nuevoNombre"]=="" || $_POST["nuevoCurso"]==""){
	      	echo "<script type='text/javascript'> window.location = 'nuevoAlumno.php';</script>";
	   }
       
	    $registro = "INSERT INTO alumnos (nombre, curso) VALUES ('".$_POST["nuevoNombre"]."','".$_POST["nuevoCurso"]."' );";
  		mysql_query($registro);
        $idact= mysql_insert_id();
        
        $trg1 = "SELECT MAX(ID) FROM ingredientes";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO alumnoingrediente(idAlumno, idIngrediente) VALUES (" . $idact . "," . $contadortxt . " );";
    	    mysql_query($inserta)
                or die ("algo falla al insertar el registro...");
			}
		  }
        
        unset($_POST["nuevoAlumno"]);
		unset($_POST["nuevoCurso"]);
	 	//echo "<h4>El alumno ha sido creado</h4>";
    	//echo "<br/>";
    	//echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
		echo "<script type='text/javascript'> window.location = 'nuevoAlumno.php';</script>";
		}
	
	function eligeAlumno($a){
		echo "<h2>Selecciona el alumno que deseas " . $a . "</h2>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        $mostrarN = "SELECT * FROM alumnos ORDER BY nombre";
        $verN = mysql_query($mostrarN);
        echo "<select name=alumnoElegido>\n";
        while($m = mysql_fetch_array($verN)){
            echo "<option value=" . $m["id"]. ">" . $m["nombre"] ."\n" ;    
        	}
        echo "<input type='submit' value='$a' / >" ;    
        echo "</form>";
		}
	
	function muestraAlumno(){
		$_SESSION["modificado"]=$_POST["alumnoElegido"];
    	echo "<form action='modificaAlumno.php'  method='post'>\n";
        $modificado=$_POST["alumnoElegido"];
        $mostrarN2 = "SELECT * FROM alumnos where id='$modificado'" ;
       	$verN2 = mysql_query($mostrarN2);
        
        
        
        
		while($x = mysql_fetch_array($verN2)){
            echo "<br><label class='izq' >Nombre a modificar</label>";
            $nuevoT = $x["nombre"];
            echo "<input  type='text' name='alumnoModificado2' value = '$nuevoT' ><br/><br/>" ;
            echo "<br><label class='izq' >Curso a modificar</label>";
            $nuevocurso = $x["curso"];
            echo "<input  type='text' name='cursoModificado2' value = '$nuevocurso' ><br/><br/>" ;
            
            $mostrarIn = "SELECT * FROM ingredientes ORDER BY ingrediente ASC";
            $verIn = mysql_query($mostrarIn);
            
             echo "<table class='zebra'>";
             echo "<tr>";
             $columna=0;
        
            while($m = mysql_fetch_array($verIn)){
                 $idIn = $m["id"];
                 $ing = $m ["ingrediente"];
                 $mostrarIn2 = 'SELECT * FROM alumnoingrediente WHERE idIngrediente= ' . $idIn . ' AND idAlumno = ' . $modificado ;
                 $verIngMarcados = mysql_query($mostrarIn2);
                 
                 if (mysql_num_rows($verIngMarcados)>0){
			         echo "<td><input class='mini' type='checkbox' checked='checked' name='$idIn' >"  .  "\n" ;   
			         }else{
			             echo "<td><input class='mini' type='checkbox' name='$idIn' >"  .  "\n" ;
                         }
                 
                 echo "<label>" . $ing . "</label></td>" ;
                 $columna++;
             if ($columna==4){
                    echo "</tr><tr>";
                    $columna=0;
                    }
                }
          
           echo "</tr>";
        echo "</table>";
          
            echo "<br/><input type='submit' value='modifica' / >" ; 
            }
   
        echo "</form>";
		
	   }
	
	function modificaAlumno(){
			
		$alumnoM = $_POST["alumnoModificado2"];
        $cursoM = $_POST["cursoModificado2"];
        $modificado=$_SESSION["modificado"];
        $txtsql= "UPDATE alumnos SET nombre='$alumnoM', curso='$cursoM' where id='$modificado' " ;
        $verN3 = mysql_query($txtsql);
        
        $trg1 = "SELECT MAX(ID) FROM ingredientes ";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO alumnoingrediente(idAlumno, idIngrediente) VALUES (" . $modificado . "," . $contadortxt . " );";
    	    }else{
			 $inserta= "DELETE FROM alumnoingrediente where idAlumno = '$modificado' AND idIngrediente ='$contadortxt' " ;
        	}
            $actualiza=mysql_query($inserta);
            
		  }
          
        $duplicado=$this->consultar("CREATE TABLE temporal AS SELECT * FROM alumnoingrediente GROUP BY idIngrediente , idAlumno");
        $duplicado=$this->consultar("DROP TABLE alumnoingrediente");
        $duplicado=$this->consultar("RENAME TABLE temporal TO alumnoingrediente");
      
        
        //echo "<h4>El alumno ha sido modificado</h4>";
        //echo "<br/>";
        //echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
        echo "<script type='text/javascript'> window.location = 'modificaAlumno.php';</script>";
	    }
	
	
    function eliminaDuplicadoAlumnos(){
        $duplicado=$this->consultar("CREATE TABLE temporal AS SELECT * FROM alumnoingrediente GROUP BY idIngrediente , idAlumno");
        $duplicado=$this->consultar("DROP TABLE alumnoingrediente");
        $duplicado=$this->consultar("RENAME TABLE temporal TO alumnoingrediente");
     }
    
	function borraAlumno(){
		$alumnoE = $_POST["alumnoElegido"];
        $alE = $_POST["alumnoElegido"];
       	$trg1 = "SELECT MAX(ID) FROM alumnos";
		$trg2 = mysql_query($trg1);
 		$row = mysql_fetch_row($trg2); 
		$max_id = $row[0]; 
                
        for ($contador=0;$contador<=$max_id;$contador++){
			$contadortxt = (string)$contador;
			if($contadortxt==$alE){
        		//$txtsql= "DELETE FROM alumnos where id = '$contador'  " ;
        		//mysql_query($txtsql);
              $borraAlumno=$this->consultar("DELETE FROM alumnos where id = '$contador'  ");
              $borraSusProblemas=$this->consultar("DELETE FROM alumnoingrediente where idAlumno = '$contador'  ");
						
            	}
			}
			
		//echo "<h4>El alumno ha sido eliminado</h4>";
        //echo "<br/>";
        //echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
        echo "<script type='text/javascript'> window.location = 'eliminaAlumno.php';</script>";
		
	}
    
    
  function listaAlumnos(){
		echo "<h3>Estos son los alumnos introducidos:</h3>";
		$alumnosTodos = $this->consultar("SELECT * FROM alumnos ORDER BY curso");
		while($a = mysql_fetch_array($alumnosTodos)){
			echo "<h2>".$a[1] ." del curso " . $a[2] ."</h2>";
			$ingAlumno = $this->consultar("SELECT DISTINCT ingredientes.ingrediente FROM alumnoingrediente INNER JOIN ingredientes WHERE alumnoingrediente.idIngrediente=ingredientes.id AND alumnoingrediente.idAlumno=$a[0]");
			
			echo "<table class='tabla2'>";
			while($b= mysql_fetch_array($ingAlumno)){
				echo "<td>".$b[0]."</td>";
			}
			
			echo "</table>";  
			
						
		}
		echo "<br/><a href='nuevoAlumno.php'>A&ntilde;adir m&aacute;s</a>";
	}
    
      
    
    
}	
	
}
?>	