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
        "TEXTO" => "Ejercicio3",
        "LINK" => ""
    ]
];

$longitud = 20;

// ---------- a) A partir de un array con todos los caracteres válidos ----------
$caracteres = [];


for ($i = ord('a'); $i <= ord('z'); $i++) {
    $caracteres[] = chr($i);
}

for ($i = ord('A'); $i <= ord('Z'); $i++) {
    $caracteres[] = chr($i);
}

for ($i = 0; $i <= 9; $i++) {
    $caracteres[] = (string)$i;
}

$cadenaA = "";
for ($i = 0; $i < $longitud; $i++) {
    $cadenaA .= $caracteres[mt_rand(0, count($caracteres) - 1)];
}

// ---------- b) A partir del código ASCII ----------

$cadenaB = "";
while (strlen($cadenaB) < $longitud) {
    $codigo = mt_rand(48, 122);
    $caracter = chr($codigo);

    
    if (($codigo >= 48 && $codigo <= 57) ||
        ($codigo >= 65 && $codigo <= 90) ||
        ($codigo >= 97 && $codigo <= 122)) {
        $cadenaB .= $caracter;
    }
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3",$barraUbi);
cuerpo($cadenaA,$cadenaB); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo($cadenaA,$cadenaB)
{

echo "<h3>Generar cadenas aleatorias</h3>";
echo "<p>a) Desde array de caracteres: <strong>" . $cadenaA . "</strong></p>";
echo "<p>b) Desde código ASCII: <strong>" . $cadenaB . "</strong></p>";
}