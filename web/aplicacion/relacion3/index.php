<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("./libreria.php");
//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Inicio",
        "LINK" => ""
    ]
];
//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 3");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 3", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <h1>Ejercicio 1</h1>
    
<?php
}
