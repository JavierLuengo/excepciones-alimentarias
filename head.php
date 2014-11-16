<?php

class head {
	
    function crearHead($tituloPagina){
        
function user_agents(){
$devices = array('iphone', 'android', 'ipad', 'iphone', 'blackberry');
foreach ($devices as $ua) {
$tsuac[] = (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), strtolower($ua))) ? 1 : 0;
}
return (in_array(1, $tsuac)) ? '.sftouchscreen()' : '';
}

    echo "<!DOCTYPE HTML>\n";	
    echo "<head>\n";
    	echo "<meta http-equiv='content-type' content='text/html; charset=iso-8859-1'>\n";
		echo "<meta name='author' content='Javier Luengo'>\n";
  		echo "<title>" . $tituloPagina . "</title>\n";
		echo "<link rel='stylesheet' href='css/estilo.css' type='text/css' />\n";
		echo "<script src='scripts/javascript.js' type='text/javascript'></script>\n";
        ?>
        
        	<style type="text/css" media="print">
	#pie, #menu, button, a {
		display:none;
		}
	#contenedor, #body, #centro, table {
	   background-color:transparent;
	}
	
	</style>
        
        
        
        
        
        <style>

.clear {clear:both}
/* remove the list style */
#nav {
margin:0;
padding:0;
list-style:none;
}
 
/* make the LI display inline */
/* it's position relative so that position absolute */
/* can be used in submenu */
#nav li {
    font-size:20px;
float:left;
display:block;
width:100px;
background:#ccc;
position:relative;
z-index:500;
margin:2px 1px;
}
 
/* this is the parent menu */
#nav li a {
display:block;
padding:8px 5px 0 5px;
font-weight:700;
height:23px;
text-decoration:none;
color:#fff;
text-align:center;
color:#333;
width:100px;
}
 
#nav li :hover {

background-color: green;
color:white;
font-weight:bold;

	/* Redondea los bordes en Firefox antiguos */
	-moz-border-radius: 10px;
	/* Redondea los bordes en Safari y Chrome */
	-webkit-border-radius: 10px;
	/* Redondea los bordes en IE 9 y 10, y en un futuro ser� el estandar*/

/* Sombrea en Firefox antiguo */
     -moz-box-shadow: 5px 5px 10px black;
     /* Sombrea en Safari y Chrome */
     -webkit-box-shadow: 5px 5px 10px black;
     /* Sombrea en IE 9 y 10, y en un futuro ser� el estandar*/
     box-shadow: 5px 5px 10px black;
}
 
/* you can make a different style for default selected value */
#nav a.selected {
color:#f00;
}
 
/* submenu, it's hidden by default */
#nav ul {
position:absolute;
left:0;
display:none;
margin:0 0 0 -1px;
padding:0;
list-style:none;
}
 
#nav ul li {
width:100px;
float:left;
border-top:1px solid #fff;
}
 
/* display block will make the link fill the whole area of LI */
#nav ul a {
display:block;
height:15px;
padding: 8px 5px;
color:#666;
}
 
#nav ul a:hover {
text-decoration:none;
}
 
/* fix ie6 small issue */
/* we should always avoid using hack like this */
/* should put it into separate file : ) */
*html #nav ul {
margin:0 0 0 -2px;
} </style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">
/*Sftouch*/
(function($){
$.fn.sftouchscreen = function() {
// Return original object to support chaining.
return this.each( function() {
// Select hyperlinks from parent menu items.
$(this).find('li > ul').closest('li').children('a').each( function() {
var $item = $(this);
// No .toggle() here as it's not possible to reset it.
$item.click( function(event){
// Already clicked? proceed to the URI.
if ($item.hasClass('sf-clicked')) {
var $uri = $item.attr('href');
window.location = $uri;
}
else {
event.preventDefault();
$item.addClass('sf-clicked');
}
}).closest('li').mouseleave( function(){
// So, we reset everything.
$item.removeClass('sf-clicked');
});
});
});
};
})(jQuery);
 
$(document).ready(function () {
$('#nav li').hover(
function () {
//show its submenu
$('ul', this).stop().slideDown(100);
},
function () {
//hide its submenu
$('ul', this).stop().slideUp(100);
}
);
$('#nav')<?php echo user_agents(); ?>;
 
});
</script>
	<?php		
    echo "</head>\n";
}
}

?>