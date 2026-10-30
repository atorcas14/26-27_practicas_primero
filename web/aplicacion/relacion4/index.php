<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__)."/scripts/clases/InstrumentoBase.php");
//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion4",
        "LINK" => ""
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 4");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 4", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    

?>
    <h2>Clase instrumento base</h2>
    <?php 
    ?>

<?php
}
