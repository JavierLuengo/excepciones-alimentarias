window.onload = function(){
	
	var altura = document.getElementById("contenedor").clientHeight;
   var alturamax = window.innerHeight- document.getElementById("cabecera").clientHeight;
   if (altura<alturamax){
        contenedor.style.height = alturamax-30+"px" ;
        }
        
     var alturaCabecera = document.getElementById("cabecera").clientHeight;
	 var alturaMenu = document.getElementById("menu").clientHeight;
	 var alturaCentro = document.getElementById("centro").clientHeight;
	 var alturaPie = document.getElementById("pie").clientHeight; 
	 
	 if ((alturaCabecera+alturaMenu+alturaCentro+alturaPie)< alturamax ){
		centro.style.height = alturamax-alturaCabecera-alturaMenu-alturaPie+"px" ;
		
	}
 
    }
 

     