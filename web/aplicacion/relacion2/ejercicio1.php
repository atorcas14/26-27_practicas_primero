<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barraUbi = [
<<<<<<< HEAD
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 2",
        "LINK" => "/aplicacion/relacion2/index.php"
    ],
    [
        "TEXTO" => "Ejercicio1",
        "LINK" => ""
    ]
];
$nombre = "Pepe";
$modulo = "Desarrollo web";

$cadena = "Esto es una cadena";
$cadena2 = "Aquí mañana se viene";
$cadenaHEREDOC = <<<HTML_HEREDOC
=======
    ["TEXTO" => "Inicio", "LINK" => "/index.php"],
    ["TEXTO" => "Relacion 2", "LINK" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio1", "LINK" => ""]
];

$nombre = "Pepe";
$modulo = "Desarrollo web";

// Comillas dobles: interpreta variables y caracteres de escape
$cadena_dobles = "Hola, el alumno <b>$nombre</b> está matriculado en \"$modulo\".\nAquí mañana se viene.";

// Comillas simples: texto literal, no interpreta variables ni \n
$cadena_simples = 'Hola, el alumno <b>$nombre</b> está matriculado en \'$modulo\'.\nAquí mañana se viene.';

// HEREDOC: se comporta como comillas dobles
$cadena_heredoc = <<<HTML_HEREDOC
>>>>>>> 27c1729be77dc179e70f03533017404cc550d661
Ejemplo con HEREDOC:
Hola, el alumno <b>$nombre</b> está matriculado en '$modulo'.
Los caracteres especiales se muestran sin problema: á, é, ñ.
Permite usar tanto "comillas dobles" como 'simples' de manera directa.
<<<<<<< HEAD

HTML_HEREDOC;
$cadenaNOWDOC = <<<'HTML_NOWDOC'
Hola, el alumno <b>$nombre</b> (aquí verás el texto literal de la variable).
Conserva las etiquetas HTML sin procesar, comillas "dobles", 'simples' y letras á, é, ñ.

=======
HTML_HEREDOC;

// NOWDOC: se comporta como comillas simples
$cadena_nowdoc = <<<'HTML_NOWDOC'
Hola, el alumno <b>$nombre</b> (aquí verás el texto literal de la variable).
Conserva las etiquetas HTML sin procesar, comillas "dobles", 'simples' y letras á, é, ñ.
>>>>>>> 27c1729be77dc179e70f03533017404cc550d661
HTML_NOWDOC;

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 1");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1", $barraUbi);
cuerpo($cadena_dobles, $cadena_simples, $cadena_heredoc, $cadena_nowdoc);
finCuerpo();

// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo($cadena_dobles, $cadena_simples, $cadena_heredoc, $cadena_nowdoc)
{
    echo "<pre>";

<<<<<<< HEAD
// SALIDA EN PANTALLA
// Usamos <pre> para conservar los saltos de línea (\n) y espacios en el navegador.
// Usamos htmlspecialchars() para transformar los caracteres < y > en entidades web, 
// evitando que el navegador ejecute el HTML.

echo "<pre>";

echo "<h3>1. Resultado de Comillas Dobles:</h3>";
// echo htmlspecialchars($cadena_dobles);

echo "<h3>2. Resultado de Comillas Simples:</h3>";
// echo htmlspecialchars($cadena_simples);

echo "<h3>3. Resultado de HEREDOC:</h3>";
// echo htmlspecialchars($cadena_heredoc);

echo "<h3>4. Resultado de NOWDOC:</h3>";
// echo htmlspecialchars($cadena_nowdoc);

echo "</pre>";
=======
    echo "<h3>1. Resultado de Comillas Dobles:</h3>";
    echo htmlspecialchars($cadena_dobles);

    echo "<h3>2. Resultado de Comillas Simples:</h3>";
    echo htmlspecialchars($cadena_simples);
>>>>>>> 27c1729be77dc179e70f03533017404cc550d661

    echo "<h3>3. Resultado de HEREDOC:</h3>";
    echo htmlspecialchars($cadena_heredoc);

    echo "<h3>4. Resultado de NOWDOC:</h3>";
    echo htmlspecialchars($cadena_nowdoc);

    echo "</pre>";
}