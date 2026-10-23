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
$vector=array();//el vector vacio 
$numero=0; 
cuentaVeces($vector,"1osición",7,$numero); //$vector (“1osición”=>7). En numero se 
//de vuelve 1 porque es la primera llamada… 
cuentaVeces($vector,"otra",2,$numero);//$vector(“otra”=>9).En numero se devuelve 2 
//porque es la segunda llamada… 
?>
    <h1>Ejercicio 1</h1>
    <?php
    echo cuentaVeces($vector,"1osición",7,$numero)."<br>";
    echo cuentaVeces($vector,"otra",2,$numero);
    ?>
    <hr>
    <h1>Ejercicio 2</h1>
    <?php
    echo generarCadena(7);//crea la cadena de 7 caracteres “AcG_%15”
    ?>
    <hr>
    <h1>Ejercicio 3</h1>
    <?php
    echo "Suma: ".operaciones(1,2,4,6,8,10)."<br>";
    echo "Resta: ".operaciones(2,2,4,6,8,10)."<br>";
    echo "Multiplicacion: ".operaciones(3,2,4,6,8,10)."<br>";
    echo  "Otra opcion: ".operaciones(5,2,5,7,3,4);
    ?>
    <hr>
    <h1>Ejercicio 4</h1>
    <?php
    $valor=7;
    echo "Suma: ".devuelve($valor,4)."<br>";
    echo "Resta: ".operaciones(2,2,4,6,8,10)."<br>";
    echo "Multiplicacion: ".operaciones(3,2,4,6,8,10)."<br>";
    echo  "Otra opcion: ".operaciones(5,2,5,7,3,4);

}

