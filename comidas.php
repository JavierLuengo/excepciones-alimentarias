<?php
@session_start();

if (class_exists('BBDD')) {
    
class comidas extends BBDD{
	
	
	function nuevoComida(){
	
		echo "<form action='nuevaComida.php'  method='post' autocomplete='off'><br/>\n";
    	echo "<label>Introduce el nombre de la nueva comida: </label><br/>\n";
        echo "<input autofocus class='grande' type='text' id='nuevoNombre' name='nuevoNombre' />\n";
    	echo "<span  class='alerta' id='error1' style='visibility:hidden'>Nombre de comida incorrecto</span><br/><br/>\n";
        
        echo "<label>Introduce sus ingredientes: </label><br/>\n" ;
        
        $mostrarIn = "SELECT * FROM ingredientes ORDER BY ingrediente";
        $verIn = mysql_query($mostrarIn);
        echo "<table class='zebra'>";
        echo "<tr>";
        $columna=0;
        while($m = mysql_fetch_array($verIn)){
             $idIn = $m["id"];
             $ing = $m["ingrediente"];
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
    	
    	include("compruebaAjaxComidas.htm");
    	
		}
	
	function agregaComida(){
	   if ($_POST["nuevoNombre"]==""){
	      	echo "<script type='text/javascript'> window.location = 'nuevaComida.php';</script>";
	   }
       
	    $registro = "INSERT INTO comidas (comida) VALUES ('".$_POST["nuevoNombre"]."');";
  		mysql_query($registro)
          or die ("algo falla al insertar el registro de comida...");
        
        $idact= mysql_insert_id();
        
        $trg1 = "SELECT MAX(ID) FROM ingredientes";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO comidaingrediente(idcomida, idIngrediente) VALUES (" . $idact . "," . $contadortxt . " );";
    	    mysql_query($inserta)
                or die ("algo falla al insertar el registro...");
			}
		  }
        
        unset($_POST["nuevocomida"]);
		//echo "<h4>La comida ha sido creada</h4>";
    	//echo "<br/>";
    	//echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
		echo "<script type='text/javascript'> window.location = 'nuevaComida.php';</script>";
		}
	
	function eligeComida($a){
		echo "<h2>Selecciona el comida que deseas " . $a . "</h2>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        $mostrarN = "SELECT * FROM comidas ORDER BY comida";
        $verN = mysql_query($mostrarN);
        echo "<select class='grande' name=comidaElegido>\n";
        while($m = mysql_fetch_array($verN)){
            echo "<option class='grande' value=" . $m["id"]. ">" . $m["comida"] ."\n" ;    
        	}
        echo "<input type='submit' value='$a' / >" ;    
        echo "</form>";
		}
	
    
    function eligeCurso(){
		echo "<h2>Selecciona el men&uacute; del d&iacute;a  </h2><br/>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        echo "<label>Curso</label>";
        echo "<input class='mini' type='text' name='cursoElegido' id='cursoElegido' ><br/>";
        
        // primer plato ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
        echo "<label class='grande' >Primer plato</label>";
		echo "<select class='grande' name=primerPlato>\n";
        while($m1 = mysql_fetch_array($verN)){
            echo "<option value=" . $m1["id"]. ">" . $m1["comida"] ."\n" ;    
        	}
        echo "</select><br/>";	

		  // segundo plato ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
		echo "<label class='grande'>Segundo plato</label>";
        echo "<select class='grande' name=segundoPlato>\n";
        while($m2 = mysql_fetch_array($verN)){
            echo "<option value=" . $m2["id"]. ">" . $m2["comida"] ."\n" ;    
        	}	
		echo "</select><br/>";	

  		// postre ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);		
		echo "<label class='grande'>Postre</label>";
        echo "<select class='grande' name=postre>\n";
        while($m3 = mysql_fetch_array($verN)){
            echo "<option value=" . $m3["id"]. ">" . $m3["comida"] ."\n" ;    
        	}	
        echo "</select><br/>";	
			
        echo "<input type='submit' value='Enviar' / >" ;    
        echo "</form>";
					
		
	
	}
    
    
    
	function muestraComida(){
		$_SESSION["modificado"]=$_POST["comidaElegido"];
    	echo "<form action='modificaComida.php'  method='post'>\n";
        $modificado=$_POST["comidaElegido"];
        $mostrarN2 = "SELECT * FROM comidas where id='$modificado'" ;
       	$verN2 = mysql_query($mostrarN2);
        
		while($x = mysql_fetch_array($verN2)){
            echo "<label >Comida a modificar</label><br>";
            $nuevoT = $x["comida"];
            echo "<input   type='text' name='comidaModificado2' value = '$nuevoT' ><br/><br/>" ;
            
            $mostrarIn = "SELECT * FROM ingredientes ORDER BY ingrediente ASC";
            $verIn = mysql_query($mostrarIn);
            
            
        echo "<table class='zebra'>";
            echo "<tr>";
            $columna=0;
            while($m = mysql_fetch_array($verIn)){
                 $idIn = $m["id"];
                 $ing = $m ["ingrediente"];
                 $mostrarIn2 = 'SELECT * FROM comidaingrediente WHERE idIngrediente= ' . $idIn . ' AND idcomida = ' . $modificado ;
                 $verIngMarcados = mysql_query($mostrarIn2);
                 
                 if (mysql_num_rows($verIngMarcados)>0){
			         echo "<td><input class='mini' type='checkbox' checked='checked' name='$idIn' >"  .  "\n" ;   
			         }else{
			             echo "<td><input class='mini' type='checkbox' name='$idIn' >"  .  "\n" ;
                         }
                 
                 echo "<label>" . $ing . "</label>" ;
                 echo "</td>";
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
	
	function modificaComida(){
			
		$comidaM = $_POST["comidaModificado2"];
        $modificado=$_SESSION["modificado"];
        $txtsql= "UPDATE comidas SET comida='$comidaM' where id='$modificado' " ;
        $verN3 = mysql_query($txtsql) or die (mysql_error());
       
        $trg1 = "SELECT MAX(ID) FROM ingredientes";
        $trg2 = mysql_query($trg1);
        $row = mysql_fetch_row($trg2); 
        $max_id = $row[0]; 
        
        for ($contador=0;$contador<=$max_id;$contador++){
	       $contadortxt = (string)$contador;
           if(isset($_POST[$contadortxt])){
            $c = $_POST[$contadortxt]; 
           	$inserta = "INSERT INTO comidaingrediente(idcomida, idIngrediente) VALUES (" . $modificado . "," . $contadortxt . " );";
    	
			}else{
			 $inserta= "DELETE FROM comidaingrediente where idcomida = '$modificado' AND idIngrediente ='$contadortxt' " ;
        	}
            $actualiza=mysql_query($inserta);
		  }
          $duplicado=$this->consultar("CREATE TABLE temporal AS SELECT * FROM comidaingrediente GROUP BY idIngrediente , idComida");
        $duplicado=$this->consultar("DROP TABLE comidaingrediente");
        $duplicado=$this->consultar("RENAME TABLE temporal TO comidaingrediente");
    
        
        //echo "<h4>La comida ha sido modificada</h4>";
        //echo "<br/>";
        //echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
        
        echo "<script type='text/javascript'> window.location = 'modificaComida.php';</script>";
		
	    }
	
     function eliminaDuplicadoComidas(){
        $duplicado=$this->consultar("CREATE TABLE temporal AS SELECT * FROM comidaingrediente GROUP BY idIngrediente , idComida");
        $duplicado=$this->consultar("DROP TABLE comidaingrediente");
        $duplicado=$this->consultar("RENAME TABLE temporal TO comidaingrediente");
     }
    
    
	
	function borraComida(){
		$comidaE = $_POST["comidaElegido"];
        $alE = $_POST["comidaElegido"];
       	$trg1 = "SELECT MAX(ID) FROM comidas";
		$trg2 = mysql_query($trg1);
 		$row = mysql_fetch_row($trg2); 
		$max_id = $row[0]; 
                
        for ($contador=0;$contador<=$max_id;$contador++){
			$contadortxt = (string)$contador;
			if($contadortxt==$alE){
        		//$txtsql= "DELETE FROM comidas where id = '$contador'  " ;
        		//mysql_query($txtsql);
              $borraComida=$this->consultar("DELETE FROM comidas where id = '$contador'  ");
              $borraSusProblemas=$this->consultar("DELETE FROM comidaingrediente where idComida = '$contador'  ");
			
                
                
                
				}
			}
			
		//echo "<h4>El comida ha sido eliminado</h4>";
        //echo "<br/>";
        //echo "<img src='imagenes/teclado.jpg' alt='teclado' />";
        echo "<script type='text/javascript'> window.location = 'eliminaComida.php';</script>";
		
	}
	
	function listaComidas(){
		echo "<h3>Estos son las comidas introducidas:</h3>";
		$comidasTodas = $this->consultar("SELECT * FROM comidas ORDER BY comida");
		while($a = mysql_fetch_array($comidasTodas)){
		echo $a[1]  ."<br/>";
						
		}
		echo "<br/><a href='nuevaComida.php'>A&ntilde;adir m&aacute;s</a>";
	}

	
	function entraMenuDesayunoMerienda(){
		echo "<h2>Selecciona el desayuno y la merienda</h2><br/>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        echo "<label>Curso</label>";
        echo "<input class='mini' type='text' name='cursoElegido' id='cursoElegido' ><br/>";
        
        
        // desayuno ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
        echo "<label>Desayuno</label>";
		echo "<select class='grande' name=desayuno>\n";
        while($m1 = mysql_fetch_array($verN)){
            echo "<option value=" . $m1["id"]. ">" . $m1["comida"] ."\n" ;    
        	}
        echo "</select><br/>";	

		  // merienda ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
		echo "<label >Merienda</label>";
        echo "<select class='grande' name=merienda>\n";
        while($m2 = mysql_fetch_array($verN)){
            echo "<option value=" . $m2["id"]. ">" . $m2["comida"] ."\n" ;    
        	}	
		echo "</select><br/>";	

  			
        echo "<input type='submit' value='Enviar' / >" ;    
        echo "</form>";
		}
	
    
    function entraMenu(){
		echo "<h2>Selecciona el men&uacute; del d&iacute;a  </h2>\n";
		$pagactual = $_SERVER['PHP_SELF'];
        echo "<form action='$pagactual'  method='post'>\n";
        
        // primer plato ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
        echo "<label class='grande' >Primer plato</label>";
		echo "<select class='grande' name=primerPlato>\n";
        while($m1 = mysql_fetch_array($verN)){
            echo "<option value=" . $m1["id"]. ">" . $m1["comida"] ."\n" ;    
        	}
        echo "</select><br/>";	

		  // segundo plato ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);
		echo "<label class='grande'>Segundo plato</label>";
        echo "<select class='grande' name=segundoPlato>\n";
        while($m2 = mysql_fetch_array($verN)){
            echo "<option value=" . $m2["id"]. ">" . $m2["comida"] ."\n" ;    
        	}	
		echo "</select><br/>";	

  		// postre ////////////////////////////////////////////////////////////////////////
		$mostrarN = "SELECT * FROM comidas ORDER BY comida ASC";
        $verN = mysql_query($mostrarN);		
		echo "<label class='grande'>Postre</label>";
        echo "<select class='grande' name=postre>\n";
        while($m3 = mysql_fetch_array($verN)){
            echo "<option value=" . $m3["id"]. ">" . $m3["comida"] ."\n" ;    
        	}	
        echo "</select><br/>";	
			
        echo "<input type='submit' value='Enviar' / >" ;    
        echo "</form>";
		}
    
	function muestraProblemas(){
		
		echo "<h3>Estos son los problemas de los alumnos actuales con todas las comidas introducidas en el sistema:</h3>";
			
		$problemas = $this->consultar("SELECT alumnoingrediente.idAlumno , alumnoingrediente.idIngrediente, comidaingrediente.idComida  FROM  alumnoingrediente INNER JOIN comidaingrediente WHERE alumnoingrediente.idIngrediente = comidaingrediente.idIngrediente ");
        
        
		while($x = mysql_fetch_array($problemas)){  
			$ida=$x[0];
			
			// diccionario de nombres de alumnos /////////////////////////////////////////	
			$alumnosTodos = $this->consultar("SELECT * FROM alumnos ORDER BY nombre");
	
			while($r = mysql_fetch_array($alumnosTodos)){
				
			if ($r[0]==$ida){
					echo $r[1] ;
                    echo " del curso " .  $r[2];    
				}
				}
			///////////////////////////////////////////////////////////////////////////////	
								
				echo " tiene problemas con la comida ";
			
			// diccionario nombres de comida ///////////////////////////////////////////
				$comidasTodas = $this->consultar("SELECT * FROM comidas ORDER BY comida");
				while($t = mysql_fetch_array($comidasTodas)){
				                                
			if ($t[0]==$x[2]){
					echo $t[1] ;     
				}
				}
			////////////////////////////////////////////////////////////////////////////	
				
			echo " porque tiene " ;
            
            $idc = $x[1];  // identificador de la comida
					            
        // diccionario de ingredientes /////////////////////////////////////////	
			$ingredientesTodos = $this->consultar("SELECT * FROM ingredientes ");
	
			while($zz = mysql_fetch_array($ingredientesTodos)){
				
			if ($zz[0]==$idc){
					echo $zz[1] ;     
				}
				}
			///////////////////////////////////////////////////////////////////////////////	
			            
			echo ".<br/>";
				
				}	
		
	}

	function muestraProblemasHoy(){
		
		echo "<h3>Estos son los problemas de los alumnos actuales con las comidas introducidas en el men�:</h3>";
		
		$p1 = $_POST["primerPlato"];
		$p2 = $_POST["segundoPlato"];
		$postre = $_POST["postre"];
			
		$problemas = $this->consultar("SELECT alumnoingrediente.idAlumno , alumnoingrediente.idIngrediente, comidaingrediente.idComida  FROM  alumnoingrediente INNER JOIN comidaingrediente WHERE alumnoingrediente.idIngrediente = comidaingrediente.idIngrediente AND (comidaingrediente.idComida='$p1' OR comidaingrediente.idComida='$p2' OR comidaingrediente.idComida='$postre')");
        
             
        $alumnosTodos1 = $this->consultar("SELECT * FROM alumnos ORDER BY nombre");
	
        
		while($x = mysql_fetch_array($problemas)){  
			$ida=$x[0];
			
			// diccionario de nombres de alumnos /////////////////////////////////////////	
			$alumnosTodos = $this->consultar("SELECT * FROM alumnos ORDER BY nombre");
	
			while($r = mysql_fetch_array($alumnosTodos)){
				
			if ($r[0]==$ida){
					echo $r[1] ;
                    echo " del curso " .  $r[2];    
				}
				}
			///////////////////////////////////////////////////////////////////////////////	
								
				echo " tiene problemas con la comida ";
			
			// diccionario nombres de comida ///////////////////////////////////////////
				$comidasTodas = $this->consultar("SELECT * FROM comidas ORDER BY comida");
				while($t = mysql_fetch_array($comidasTodas)){
				                                
			if ($t[0]==$x[2]){
					echo $t[1] ;     
				}
				}
			////////////////////////////////////////////////////////////////////////////	
				
			echo " porque tiene " ;
            
            $idc = $x[1];  // identificador de la comida
					            
        // diccionario de ingredientes /////////////////////////////////////////	
			$ingredientesTodos = $this->consultar("SELECT * FROM ingredientes ");
	
			while($zz = mysql_fetch_array($ingredientesTodos)){
				
			if ($zz[0]==$idc){
					echo $zz[1] ;     
				}
				}
			///////////////////////////////////////////////////////////////////////////////	
			            
			echo ".<br/>";
				
				}	
		
	}	

	function muestraProblemasDesayunoMeriendaHoy(){
		
		echo "<h3>Estos son los problemas del desayuno y merienda introducidos:</h3><br/>";
		
		$p1 = $_POST["desayuno"];
		$p2 = $_POST["merienda"];
        $cursoElegido = $_POST["cursoElegido"];
			
		 
        if ($cursoElegido==""){
            	$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
                                    
                                          
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND (comidas.id=$p1 OR comidas.id=$p2 )
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
                
        }else{	
		$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
        
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND alumnos.curso='$cursoElegido'
                                        AND (comidas.id=$p1 OR comidas.id=$p2 )
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
        }        



        echo "<table class='zebra'>";
        echo "<th>Curso</th><th>Alumno</th><th>Ingrediente</th><th>Comida</th>";
	   
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>$x[4]</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[5]</td>";
            echo "<td>$x[6]</td>";
            echo "</tr>";
				}	
        echo "</table>";
        echo "<br/>";	
         echo "<br/><br/><button onclick='window.print()' class='aviso' >imprimir</button>";
       	
		
	}

	function tablaProblemas(){
		
		echo "<h3>Estos son los problemas de los alumnos actuales con todas las comidas introducidas en el sistema:</h3><br/>";
		
        	
		$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida 
        
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida

                                        AND ingredientes.id=comidaingrediente.idIngrediente  

                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        
                                        ORDER BY alumnos.curso , ingredientes.ingrediente
                                        
                                        ");


        echo "<table class='zebra'>";
        echo "<th>Curso</th><th>Alumno</th><th>Ingrediente</th><th>Comida</th>";
	
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>$x[4]</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[5]</td>";
            echo "<td>$x[6]</td>";
            echo "</tr>";
				}	
        echo "</table>";
        echo "<br/>";
         echo "<br/><br/><button onclick='window.print()' class='aviso' >imprimir</button>";
       	
		
	}
    
    	function muestraProblemasHoyPorCurso(){
    	   
       	$p1 = $_POST["primerPlato"];
		$p2 = $_POST["segundoPlato"];
		$postre = $_POST["postre"];   
        $cursoElegido=$_POST["cursoElegido"];
		
		echo "<h3>Estos son los problemas de las comidas introducidas:</h3><br/>";
		
        
        if ($cursoElegido==""){
            	$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
                                    
                                          
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
                
        }else{	
		$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
        
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND alumnos.curso='$cursoElegido'
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
        }                                

       $_SESSION["problemas"] = $problemas;

        echo "<table class='zebra'>";
        echo "<th>Curso</th><th>Alumno</th><th>Ingrediente</th><th>Comida</th>";
	
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>$x[4]</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[5]</td>";
            echo "<td>$x[6]</td>";
            echo "</tr>";
				}	
        echo "</table>";
        echo "<br/><button onclick='window.print()' class='aviso' >imprimir</button><br/><br/>";
       	
//////////// ORDENES A COCINA ///////////////////////////////////////////////////////	
    echo "<br><h3 class='ancho80'>ordenes a cocina para substituci&oacute;n</h3><br/>";
       
     if ($cursoElegido==""){
            	$problemas = $this->consultar("SELECT ingredientes.id, comidas.id , ingredientes.ingrediente, comidas.comida  
                                    
                                          
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                        
                                        GROUP BY ingredientes.id, comidas.id
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
                
        }else{	
		$problemas = $this->consultar("SELECT ingredientes.id, comidas.id , ingredientes.ingrediente, comidas.comida  
        
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND alumnos.curso='$cursoElegido'
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                         GROUP BY ingredientes.id, comidas.id
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
        }                       
    
   
   $cantidad=0;
   while($contar = mysql_fetch_array($problemas)){
    echo $contar[3];
    $cantidad++;
   }
   
    echo $cantidad;
    
    echo "<table class='zebra'>";
        echo "<th>Cantidad</th><th>Comida</th><th>Causa del problema</th>";
	
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>x</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[2]</td>";
           
            echo "</tr>";
				}	
        echo "</table>";
        echo "<br/>";
        
    
    }
    
    function alternativas(){
       
    	  echo "este listado est&aacute; pendiente de desarrollo";
          
          $problemas = $_SESSION["problemas"];
          // $problemas2 = array_unique($problemas["comida"]);
          
        echo "<table class='zebra'>";
        echo "<th>Curso</th><th>Alumno</th><th>Ingrediente</th><th>Comida</th>";
	
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>$x[4]</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[5]</td>";
            echo "<td>$x[6]</td>";
            echo "</tr>";
				}	
        echo "</table>";
            
         }
          
          
          /*
       	$p1 = $_POST["primerPlato"];
		$p2 = $_POST["segundoPlato"];
		$postre = $_POST["postre"];   
        $cursoElegido=$_POST["cursoElegido"];
		
		echo "<h3>Estos son los problemas de las comidas introducidas:</h3><br/>";
		
        
        if ($cursoElegido==""){
            	$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
                                    
                                          
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
                
        }else{	
		$problemas = $this->consultar("SELECT alumnos.id, ingredientes.id, comidas.id , alumnos.nombre, alumnos.curso, ingredientes.ingrediente, comidas.comida  
        
                                    FROM  alumnos, comidas, ingredientes, alumnoingrediente , comidaingrediente 

                                    WHERE 

                                        alumnos.id=alumnoingrediente.idAlumno

                                        AND comidas.id=comidaingrediente.idComida
                                        AND ingredientes.id=comidaingrediente.idIngrediente  
                                        AND ingredientes.id=alumnoingrediente.idIngrediente  

                                        AND comidaingrediente.idIngrediente=alumnoingrediente.idIngrediente
                                        AND alumnos.curso='$cursoElegido'
                                        AND (comidas.id=$p1 OR comidas.id=$p2 OR comidas.id=$postre)
                                         ORDER BY alumnos.curso , ingredientes.ingrediente
                                        ");
        }                                




        echo "<table class='zebra'>";
        echo "<th>Curso</th><th>Alumno</th><th>Ingrediente</th><th>Comida</th>";
	
        while($x = mysql_fetch_array($problemas)){  
           	echo "<tr>";
            echo "<td>$x[4]</td>";
            echo "<td>$x[3]</td>";
            echo "<td>$x[5]</td>";
            echo "<td>$x[6]</td>";
            echo "</tr>";
				}	
        echo "</table>";
        echo "<br/>";
        echo "<a class='aviso' href='alternativas.php'>ordenes a cocina para substituci&oacute;n</a>";
  	*/	
	
    
	
}	
	
}
?>	