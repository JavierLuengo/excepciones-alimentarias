<?php

class cabecera {
    
    function crearCabecera($titcabecera){
        @session_start();
        $pagactual = $_SERVER['PHP_SELF'];
        /*       
        if ($pagactual != "/stpauls/index.php"){
            
            if (isset($_SESSION["conexion"])){
                if ($_SESSION["conexion"]!="conexionSegura"){
                    
                header("Location: index.php");
                    
                }else{
                   header("Location: index.php"); 
                }
                
            } else {
                header("Location: index.php");
                }
            } 
            */
            
        echo "<div id='cabecera' >\n";
		echo "<div id='logo'>";
		echo "<img id='logo2' src='http://www.carpehosting.com/nuevo/imagenes/logo6.png' alt='logo' />";	
        echo "</div>";
		echo $titcabecera;
        echo "</div>\n";
        }
        
     function crearMenu() {	
echo "<div id='menu'>";	 

echo "<ul id='nav'>";
	echo "<li><a>Inicio</a>";
    echo "<ul>\n";
			echo "<li><a href='listadoproblemas.php'>Listado general</a></li>\n";
			echo "<li><a href='index.php'>Salir</a></li>\n";
			echo "</ul>\n";
            echo "<div class='clear'></div>";
    echo "</li>\n";
    
    
 	echo "<li><a>Alumnos</a>\n";
 		echo "<ul>\n";
 			echo "<li><a href='nuevoAlumno.php'>Altas</a></li>\n";
 			echo "<li><a href='eliminaAlumno.php'>Bajas</a></li>\n";
 			echo "<li><a href='modificaAlumno.php'>Modificar</a></li>\n";
 		echo "</ul>\n";
        echo "<div class='clear'></div>";
 	echo "</li>\n";
 	echo "<li><a>Comidas</a>";
    echo "<ul>\n";
   			echo "<li><a href='nuevaComida.php'>Altas</a></li>\n";
 			echo "<li><a href='eliminaComida.php'>Bajas</a></li>\n";
 			echo "<li><a href='modificaComida.php'>Modificar</a></li>\n"; 
    echo "</ul>\n"; 
     echo "<div class='clear'></div>";
     
    echo "</li>";
 	echo "<li><a>Ingredientes</a>";
    echo "<ul>\n";
        	echo "<li><a href='nuevoIngrediente.php'>Altas</a></li>\n";
 			echo "<li><a href='eliminaIngrediente.php'>Bajas</a></li>\n";
 			echo "<li><a href='modificaIngrediente.php'>Modificar</a></li>\n";
 		echo "</ul>\n";
        echo "<div class='clear'></div>";
        echo "</li>\n";
    echo "<li><a>Listados</a>";
    		echo "<ul>\n";
			echo "<li><a href='consultaIngrediente.php'>Ingredientes</a></li>\n";
			echo "<li><a href='consultaAlumno.php'>Alumnos</a></li>\n";
			echo "<li><a href='consultaComida.php'>Comidas</a></li>\n";
			echo "</ul>\n";
            echo "<div class='clear'></div>";
 	echo "</li>\n";
 	echo "<li><a>Problemas</a>";
    		echo "<ul>\n";
			echo "<li><a href='menuporcurso.php'>Men&uacute;</a></li>\n";
			echo "<li><a href='desayunomerienda.php'>D.merienda</a></li>\n";
			
            echo "</ul>\n";
            echo "<div class='clear'></div>";
 	echo "</li>\n";
 	
 	
 	
 	
 	
echo "</ul>\n";
echo "<div class='clear'></div>";
	
echo "</div>";		
		
	}   
        
     }
?>    