<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once ("./mis_funciones.php");

include_once ("./mis_funciones.php");

        
        
//controlador

$barra=[
     [
       "TEXTO"=> "inicio",
       "ENLACE" =>"/index.php",
     ],
       [ 
       "TEXTO"=> "pruebas",   
       "ENLACE" =>"/aplicacion/pruebas/index.php",
     ], 
       [ 
       "TEXTO"=> "eje. funciones",   
     ] 
];

$numero=doble(25);
//comprobacion
if ($numero===false)
    {
        //hay un error lo resuelve
        $numero=5;
    }

//if (($numero=doble($numero))===false)
if (!$numero=doble($numero))
    {
        exit;
    }


$numero=variosParametros(25,"2aaa8769",56);

$numero=variosParametros(25,"2",56,23,56,89,24);

// $numero=suma(1,2,3,4,5,6,7,8,9,10);
// $numero=suma1(1,2,3,4,5,6,7,8,9,10);

$n1 = 15;
$otra = "n1";

// Variable variable
$numero = $$otra;


//Variable funcion
$otra ="suma";
$numero = $otra(1,2,3,4);

//funciones anonimas
$func = function (float $a, float $b, float ...$resto):float{
  $res=0;
for($i=0;$i<func_get_args();$i++){
    $res += func_get_arg($i);
}
    return $res;
};

//$numero = $func(1,2,3,4);

//funciones flecha
$s = fn(int $a, int $b)=> $a+$b;

$numero = $s(5,20);


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas",$barra);
cuerpo($numero); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista


/**
 * funcion que me permite mostrar la vista
 *
 * @return void
 */
function cuerpo(int $n)
{
        echo "el doble del numero es $n".PHP_EOL;
        echo "el numero $n es el doble de otro ".PHP_EOL;

}


