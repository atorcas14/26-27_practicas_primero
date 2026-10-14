<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 2",
        "LINK" => "/aplicacion/relacion2/index.php"
    ],
    [
        "TEXTO" => "Ejercicio2",
        "LINK" => ""
    ]
];

$cadena = "Está la niña en casa";

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2",$barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo()
{




}
