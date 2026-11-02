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
        "TEXTO" => "Relacion3",
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
    echo "Los tres parametros: ".devuelve($valor,4,7)."<br>";
    // echo "Primer parametro: ".devuelve($valor)."<br>";  //Este da error porque espera 3 parametros, no 1
    echo "Primer y segundo parametro: ".devuelve($valor,3)."<br>";
    // echo "Primer y tercer parametro: ".devuelve($valor,,7);  //Este da error porque no se puede poner el primer y tercer parametro
    ?>
    <hr>
    <h1>Ejercicio 5</h1>
    <?php
    
    echo "Resta: ".hacerOperacion("resta",3,1)."<br>";
    echo "Multiplicacion: ". hacerOperacion("multiplicacion",3,4);
    ?>
    <hr>
    <h1>Ejercicio 6</h1>
    <?php
    $sumar = function ($a, $b) {
    return $a + $b;
    };
    $restar = function ($a, $b) {
        return $a - $b;
    };
    $multiplicar = function ($a, $b) {
        return $a * $b;
    };
    echo "Suma desde una funcion flecha: ".llamadaAFuncion(1,2,fn($a,$b)=>$a+$b)."<br>";
    echo "Multiplicacion desde una funcion flecha: ". llamadaAFuncion(5,4,$multiplicar)."<br>";
    echo "Resta desde una funcion flecha: ". llamadaAFuncion(5,4,$restar)."<br>";
    echo "Suma desde una funcion flecha: ". llamadaAFuncion(5,4,$sumar);
    ?>
    <hr>
    <h1>Ejercicio 7</h1>
    <?php
    $vector=array("uno","grande","caminos","a");
    echo "Array desordenado: <br>";
    foreach($vector as $elem){
        echo $elem." ";
    }
    ordenar($vector);//el vector debe quedar (“caminos”,”grande”,”uno”,”a”)
    echo "<br>Array ordenado: <br>";
    foreach($vector as $elem){
        echo $elem." ";
    }
}

