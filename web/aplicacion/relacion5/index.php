<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_filter.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_normal.php");

//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion5",
        "LINK" => ""
    ]
];

//Prueba validarEntero
$a=5;
$b=50;
$c=0;

$r1 = \VALNORMAL\validaEntero($a,1,10,0);
$r2 = \VALFILTER\validaEntero($b,1,10,0);
$r3 = \VALFILTER\validaEntero($c,0,10,99);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 5");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 5", $barraUbi);
cuerpo($r1, $r2, $r3); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($r1, $r2, $r3)
{

?>
    <h1>Prueba validarEntero</h1> <br>
<?php

    echo "Valor r1: " . $r1;
    echo "Valor r2: " . $r2;
    echo "Valor r3: " . $r3;
}
