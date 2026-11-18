<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion7",
        "LINK" => ""
    ]
];

$res=filter_var(12, FILTER_VALIDATE_INT);

$o=[
    "options"=>[
        "min_range"=>100,
        "max_range"=>200,
        "default"=>100
    ]
];
$res=filter_var('0x81', FILTER_VALIDATE_INT, $o);

$o=[
    "options"=>[
        "min_range"=>0,
        "max_range"=>500,
        "default"=>100
    ],
    "flags"=>FILTER_FLAG_ALLOW_HEX 
];
$res=filter_var('0x81', FILTER_VALIDATE_INT, $o);


//inicializaciones
$datos = [
    "coordX" => 30,
    "coordY" => 50
];
$errores = [];


if (isset($_POST["cr"])) 
    {
        //verifico coordenada X
        $coordX = "";
        
        if ($coordX <= 0)
            $errores["coordX"][] = "Debe indicarse una coordenada X";
        if ($coordX > 500)
            $errores["coordX"][] = "La coordenada no puede ser mayor de 500";
        $datos["coordX"] = $coordX;
        
        //verifico coordenada Y
        $coordY = 0;
        
        if ($coordY <= 0)
            {
                $errores["coordY"][] = "Debe indicarse una coordenada Y";
            }
        $datos["coordY"] = $coordY;


        if (!$errores) //no hay errores hago la insercion
        {
            //codigo para el nuevo articulo
            $codigo = 1; //codigo
            //se guarda el articulo
            //ir a ver el articulo insertado
            //header("location: verArticulo.php?id=$codigo");
            exit;
        }
    }


//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 7");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 5", $barraUbi);
cuerpo($datos,$errores); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($datos,$errores)
{

?>
    <br>
    <br>
    <br>
<?php
    formulario($datos, $errores);
}

function formulario(array $datos, array $errores)
{
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div><br><br>";
    }
?>
    <form action="" method="post">
        <label for="coordX">Coordenada x: </label>
        <input type="number" name="coordX" id="coordX"
            value="<?= $datos["coordX"]; ?>"maxlength=500><br>
        
        <label for="precio">Coordenada Y: </label>
        <input type="number" name="coordY" id="coordY"
            value="<?php echo $datos["coordY"]; ?>" maxlength="3"><br>
        <input type="submit" class="boton" value="Crear" name="cr">
    </form>
<?php

    

    
}
