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
        "TEXTO" => "Ejercicio5",
        "LINK" => ""
    ]
];

$texto = <<<'TEXTO'
<h1>Lista de contactos</h1>
Hay 3 alumnos en el grupo y 25 plazas en total.
<p>Escribir a pepe@correo.es o a ana.lopez@mail.com</p>
El curso empezo en 2024 y tiene 150 horas.
<a href="#">Mas info</a> en info@web.org
<br>
TEXTO;

// Expresiones regulares
$regexEtiqueta = '/<\/?[a-z][a-z0-9]*[^>]*>/i';
$regexNumero   = '/\b\d+\b/';
$regexEmail    = '/[a-z0-9._-]+@[a-z0-9-]+\.[a-z]{2,}/i'; 

/**Funcion que permite buscar todas las coincidencias y guardarlas en un array */
function buscarTodas($patron, $cadena)
{
    $resultado = [];
    $offset = 0;

    while (preg_match($patron, $cadena, $m, PREG_OFFSET_CAPTURE, $offset)) {
        $elemento = $m[0][0];
        $posicion = $m[0][1];
        $resultado[] = [$posicion, $elemento];
        $offset = $posicion + strlen($elemento); 
    }
    return $resultado;
}

$etiquetas = buscarTodas($regexEtiqueta, $texto);
$numeros   = buscarTodas($regexNumero, $texto);
$emails    = buscarTodas($regexEmail, $texto);

function mostrarResultados ($titulo,$resultados){
    echo "<h3>" . $titulo . " (" . count($resultados) . ")</h3>";
    echo "<ul>";
    foreach ($resultados as $r) {
        echo "<li>Posición " . $r[0] . ": <code>" . htmlspecialchars($r[1]) . "</code></li>";
    }
    echo "</ul>";
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5",$barraUbi);
cuerpo($texto,$etiquetas,$numeros,$emails); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo($texto,$etiquetas,$numeros,$emails)
{


echo "<h2>Cadena original</h2>";
echo "<pre>" . htmlspecialchars($texto) . "</pre>";

mostrarResultados("Etiquetas HTML", $etiquetas);
mostrarResultados("Números", $numeros);
mostrarResultados("Direcciones de email", $emails);



}