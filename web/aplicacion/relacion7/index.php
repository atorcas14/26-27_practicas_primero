<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "../../../scripts/clases/Punto.php");
include_once(dirname(__FILE__) . "../../../scripts/clases/puntos.php");
include_once(dirname(__FILE__) . "../../../scripts/clases/ImagenPuntos.php");

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

function pEsc($t): string { return htmlspecialchars((string)$t); }
function pPost(string $c): string { return (isset($_POST[$c]) && is_string($_POST[$c])) ? $_POST[$c] : ""; }

$datos = ["x" => "", "y" => "", "color" => "", "grosor" => ""];
$errores = [];
$guardado = false;
$puntos = &damePuntos();
$imagenOk = ImagenPuntos::asegurar($puntos);
$srcImagen = ImagenPuntos::rutaWeb()."?v=".time();
if (isset($_POST["guardar"])) {
    $datos["x"] = pPost("x");
    $datos["y"] = pPost("y");
    $datos["color"] = pPost("color");
    $datos["grosor"] = pPost("grosor");

    // Coordenadas entre 0 y 500
    $x = $datos["x"];
    if (!\VALNORMAL\validaEntero($x, 0, 500, -1)) {
        $errores["x"][] = "x debe ser un entero entre 0 y 500";
    } else {
        $datos["x"] = $x;
    }

    $y = $datos["y"];
    if (!\VALNORMAL\validaEntero($y, 0, 500, -1)) {
        $errores["y"][] = "y debe ser un entero entre 0 y 500";
    } else {
        $datos["y"] = $y;
    }

    // Color indicado y válido
    if ($datos["color"] === "") {
        $errores["color"][] = "Debe seleccionarse un color";
    } elseif (!\VALNORMAL\validaRango($datos["color"], Punto::COLORES, 2)) {
        $errores["color"][] = "El color no es válido";
    }

    // Grosor seleccionado y válido
    if ($datos["grosor"] === "") {
        $errores["grosor"][] = "Debe seleccionarse un grosor";
    } elseif (!\VALNORMAL\validaRango($datos["grosor"], Punto::GROSORES, 2)) {
        $errores["grosor"][] = "El grosor no es válido";
    }

    if (!$errores) {
        $puntos[] = new Punto((int)$datos["x"], (int)$datos["y"], $datos["color"], (int)$datos["grosor"]);
        $guardado = true;
        $datos = ["x" => "", "y" => "", "color" => "", "grosor" => ""];
    }
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 7");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 7", $barraUbi);
cuerpo($datos,$errores, $guardado, $puntos, $imagenOk, $srcImagen); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

function erroresCampo(array $errores, string $campo)
{
    if (isset($errores[$campo])) {
        foreach ($errores[$campo] as $e) {
            echo "<span style='color:#b00020'>" . pEsc($e) . "</span><br>";
        }
    }
}

//vista
function mostrarFormularioPunto(array $datos, array $errores)
{
    echo "<form method='post' action='" . pEsc($_SERVER["PHP_SELF"]) . "'>";

    echo "<p><label>x: <input type='text' name='x' value='" . pEsc($datos["x"]) . "'></label><br>";
    erroresCampo($errores, "x");
    echo "</p>";

    echo "<p><label>y: <input type='text' name='y' value='" . pEsc($datos["y"]) . "'></label><br>";
    erroresCampo($errores, "y");
    echo "</p>";

    echo "<p><label>Color: <select name='color'>";
    echo "<option value=''>-- elige un color --</option>";
    foreach (Punto::COLORES as $ingles => $info) {
        $sel = ($datos["color"] === (string)$ingles) ? " selected" : "";
        echo "<option value='" . pEsc($ingles) . "'$sel>" . pEsc($info["nombre"]) . "</option>";
    }
    echo "</select></label><br>";
    erroresCampo($errores, "color");
    echo "</p>";

    echo "<p>Grosor:<br>";
    foreach (Punto::GROSORES as $valor => $texto) {
        $marcado = ($datos["grosor"] === (string)$valor) ? " checked" : "";
        echo "<label><input type='radio' name='grosor' value='$valor'$marcado> " . pEsc($texto) . "</label> ";
    }
    echo "<br>";
    erroresCampo($errores, "grosor");
    echo "</p>";

    echo "<p><input type='submit' name='guardar' value='Guardar'></p>";
    echo "</form>";
}

//vista
function cuerpo($datos,$errores, $guardado, $puntos, $imagenOk, $srcImagen)
{

     echo "<h2>Nuevo punto</h2>";
    if ($guardado) {
        echo "<p style='color:green'>Punto guardado correctamente.</p>";
    }
    mostrarFormularioPunto($datos, $errores);

    // Textarea: una línea por punto
    $lineas = [];
    foreach ($puntos as $p) {
        $lineas[] = "x=" . $p->getX() . ", y=" . $p->getY()
            . ", color=" . Punto::COLORES[$p->getColor()]["nombre"]
            . ", grosor=" . Punto::GROSORES[$p->getGrosor()];
    }
    echo "<h3>Puntos almacenados (" . count($puntos) . ")</h3>";
    echo "<textarea rows='8' cols='60' readonly>" . pEsc(implode("\n", $lineas)) . "</textarea>";

    // Imagen
    echo "<h3>Imagen</h3>";
    if ($imagenOk) {
        echo "<img src='" . pEsc($srcImagen) . "' alt='Puntos' width='500' height='500'>";
    } else {
        echo "<p style='color:#b00020'>No se pudo generar la imagen (comprueba la extensión GD y los permisos de /imagenes/puntos/).</p>";
    }
}