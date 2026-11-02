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
        "TEXTO" => "Ejercicio4",
        "LINK" => ""
    ]
];

$valor1 = 17.5;
$valor2 = 379987.4;

//Dar formato a los numeros
$formato1 = number_format($valor1,1,',','.');
$formato2 = number_format($valor2,2,',','.');

//Poner o quitar numeros con str_pad
$primero = str_pad($formato1, 15, "0", STR_PAD_LEFT); 
$segundo = str_pad($formato2, 15, " ", STR_PAD_LEFT);

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4",$barraUbi);
cuerpo($primero,$segundo); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo($primero,$segundo)
{
echo "<pre>";
echo "el primer valor -" . $primero . "-, el segundo valor -" . $segundo . "-";
echo "</pre>";

}