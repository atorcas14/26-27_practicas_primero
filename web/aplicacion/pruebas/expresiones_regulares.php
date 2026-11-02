<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

        
        
//controlador


$cadena='tienes 25 años';

//buscar años
$exp='/años/';
$resultado=[];

preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//buscar numero
$exp='/[0123456789]+/';
$exp='/[0-9]+/';

preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Expresiones regulares");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{


}