<?php
include("config.php");
@session_start();

class BBDD{
    function __construct(){
		$this->conectar();
		$this->seleccionarBD("stpauls");
	}
    
    function conectar(){
        mysql_connect(servidor,usuario,contrasena)
			or die ("No se puede establecer conexi&oacute;n");
    }
    
    function seleccionarBD($baseDatos){
      mysql_select_db($baseDatos)
		or die ("Ha surgido un problema al seleccionar la base de datos..." . mysql_error() );
    }
  
   function consultar($sentencia){
        return mysql_query($sentencia);        
    }
}


?>