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
        "TEXTO" => "Ejercicio2",
        "LINK" => ""
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2",$barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo()
{
$cadena = "Está la niña en casa";
$longitud_bytes = strlen($cadena);
$longitud_real = mb_strlen($cadena);

//Primera forma, muestra los caracteres raros como que no lo encuentra
echo "Mostrar la cadena en diagonal";
echo "<pre>";
for($i=0;$i<strlen($cadena);$i++){
    // $espacios = str_repeat(" ",$i);
    // echo $espacios . $cadena[$i] . "\n";
    echo str_repeat(" ",$i) . $cadena[$i] ."<br>";
}

//Segunda forma con substr
for($i=0;$i<$longitud_bytes;$i++){
    $espacios = str_repeat(" ",$i);
    echo "\n".$espacios . substr($cadena, $i,1) ;
}

//Tercera forma con mb_substr
for($i=0;$i<$longitud_bytes;$i++){
    $espacios = str_repeat(" ",$i);
    $caracter = mb_substr($cadena, $i,1);
    echo "\n".$espacios .  $caracter;
}
echo "</pre>";

//Mostrar la cadena invertida y en mayuscula los caracteres pares
echo "Mostrar el orden inverso con indices negativos <br>";
$espacios_count =0;
for ($i=-1;$i>=-$longitud_real;$i--){
    $caracter = mb_substr($cadena,$i,1);
    $indice_original = $longitud_real + $i;
    if($indice_original%2==0)
        $caracter = mb_strtoupper($caracter);
    else
        $caracter = mb_strtolower($caracter);
    echo str_repeat(" ",$espacios_count) . $caracter . "\n";
}

//Separar la cadena en partes y mostrarla en distintas lineas usando el 
//caracter "a"
echo "<br>Separar la cadena en partes y mostrarlo en distintas lineas usando el caracter 'a': ";

$partes = explode("a",$cadena);

foreach($partes as $parte){
    echo $parte . "\n";
}

//BUscar la palabra "niña" y cambiarla por "mujer"
echo "<br>Buscar la palabra 'niña' y cambiarla por 'mujer': ";




}
