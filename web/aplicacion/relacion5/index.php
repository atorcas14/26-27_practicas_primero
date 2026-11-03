<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

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



//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 5");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 5", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    

?>
    
    

<?php
}
