<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

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

// Lo primero: cargar los puntos del fichero del cliente
$puntos = Punto::cargar();
$datos = ["x" => "", "y" => "", "color" => "", "grosor" => ""];
$errores = [];
$mensajes = [];

// ---------- BORRAR ----------
if (isset($_POST["borrar"])) {
    $i = pPost("punto");
    if (ctype_digit($i) && (int)$i < count($puntos)) {
        unset($puntos[(int)$i]);
        $puntos = array_values($puntos);
        if (Punto::guardar($puntos) && Punto::guardarImagen($puntos)) {
            header("Location: " . $_SERVER["PHP_SELF"] . "?borrado=1");
            exit;
        }
        $errores["borrar"][] = "No se pudo actualizar el fichero o la imagen";
    } else {
        $errores["borrar"][] = "Debe seleccionarse un punto válido";
    }
}
if (isset($_GET["borrado"])) $mensajes[] = "Punto borrado correctamente";

// ---------- AÑADIR ----------
if (isset($_POST["guardar"])) {
    foreach (["x", "y", "color", "grosor"] as $c) $datos[$c] = pPost($c);

    foreach (["x", "y"] as $c) {
        if (!ctype_digit($datos[$c]) || (int)$datos[$c] > 500) {
            $errores[$c][] = "$c debe ser un entero entre 0 y 500";
        }
    }
    if ($datos["color"] === "") $errores["color"][] = "Debe seleccionarse un color";
    elseif (!\VALNORMAL\validaRango($datos["color"], Punto::COLORES, 2)) $errores["color"][] = "El color no es válido";

    if ($datos["grosor"] === "") $errores["grosor"][] = "Debe seleccionarse un grosor";
    elseif (!\VALNORMAL\validaRango($datos["grosor"], Punto::GROSORES, 2)) $errores["grosor"][] = "El grosor no es válido";

    if (!$errores) {
        $puntos[] = new Punto((int)$datos["x"], (int)$datos["y"], $datos["color"], (int)$datos["grosor"]);
        if (Punto::guardar($puntos) && Punto::guardarImagen($puntos)) {
            $mensajes[] = "Punto guardado correctamente";
            $datos = ["x" => "", "y" => "", "color" => "", "grosor" => ""];
        } else {
            array_pop($puntos);
            $errores["guardar"][] = "No se pudo escribir el fichero o la imagen (permisos)";
        }
    }
}

// ---------- SUBIR FICHERO ----------
if (isset($_POST["subir"])) {
    $f = $_FILES["fichero"] ?? null;
    if ($f === null || $f["error"] === UPLOAD_ERR_NO_FILE) {
        $errores["fichero"][] = "Debe seleccionarse un fichero";
    } elseif ($f["error"] !== UPLOAD_ERR_OK) {
        $errores["fichero"][] = "Error al subir el fichero";
    } elseif (strtolower(pathinfo($f["name"], PATHINFO_EXTENSION)) !== "txt") {
        $errores["fichero"][] = "El fichero debe ser .txt";
    } else {
        $nuevos = 0; $rechazados = 0;
        foreach (file($f["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $l) {
            $p = Punto::desdeLinea($l);
            if ($p === null) { $rechazados++; } else { $puntos[] = $p; $nuevos++; }
        }
        if ($nuevos > 0 && !(Punto::guardar($puntos) && Punto::guardarImagen($puntos))) {
            $errores["fichero"][] = "No se pudo actualizar el fichero o la imagen";
        } else {
            $mensajes[] = "Subida terminada: $nuevos añadidos, $rechazados rechazadas";
        }
    }
}

// La imagen se crea al conectarse un usuario (vacía) si aún no existe
if (!is_file(Punto::rutaImagen())) {
    Punto::guardarImagen($puntos);
}
$imagenOk = is_file(Punto::rutaImagen());
$srcImagen = Punto::urlImagen() . "?v=" . time();

//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 7");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 7", $barraUbi);
cuerpo($datos, $errores, $mensajes, $puntos, $imagenOk, $srcImagen); //llamo a la vista
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

function mostrarFormularioBorrar(array $puntos, array $errores)
{
    echo "<h3>Borrar un punto</h3>";
    if (!$puntos) {
        echo "<p>No hay puntos que borrar.</p>";
        return;
    }
    echo "<form method='post' action='" . pEsc($_SERVER["PHP_SELF"]) . "'>";
    echo "<select name='punto'>";
    foreach ($puntos as $i => $p) {
        echo "<option value='$i'>" . pEsc(($i + 1) . " - (" . $p->getX() . ", " . $p->getY() . ") "
            . Punto::COLORES[$p->getColor()]["nombre"] . ", " . Punto::GROSORES[$p->getGrosor()]) . "</option>";
    }
    echo "</select> ";
    echo "<input type='submit' name='borrar' value='Borrar'><br>";
    erroresCampo($errores, "borrar");
    echo "</form>";
}

//vista
function mostrarFormularioSubida(array $errores)
{
    echo "<h3>Subir fichero de puntos (.txt)</h3>";
    echo "<p>Una línea por punto: <code>x ; y ; color ; grosor</code></p>";
    echo "<form method='post' enctype='multipart/form-data' action='" . pEsc($_SERVER["PHP_SELF"]) . "'>";
    echo "<input type='file' name='fichero' accept='.txt'> ";
    echo "<input type='submit' name='subir' value='Subir'><br>";
    erroresCampo($errores, "fichero");
    echo "</form>";
}

//vista
function cuerpo($datos, $errores, $mensajes, $puntos, $imagenOk, $srcImagen)
{

    echo "<h2>Puntos</h2>";
    foreach ($mensajes as $m) {
        echo "<p style='color:green'>" . pEsc($m) . "</p>";
    }

    echo "<h3>Nuevo punto</h3>";
    mostrarFormularioPunto($datos, $errores);
    mostrarFormularioBorrar($puntos, $errores);
    mostrarFormularioSubida($errores);

    // Textarea: una línea por punto
    $lineas = [];
    foreach ($puntos as $p) {
        $lineas[] = $p->aLinea();
    }
    echo "<h3>Puntos almacenados (" . count($puntos) . ")</h3>";
    echo "<textarea rows='8' cols='60' readonly>" . pEsc(implode("\n", $lineas)) . "</textarea>";

    echo "<h3>Imagen</h3>";
    if ($imagenOk) {
        echo "<img src='" . pEsc($srcImagen) . "' alt='Puntos' width='500' height='500'><br>";
    } else {
        echo "<p style='color:#b00020'>No se pudo generar la imagen (revisa GD y permisos de /imagenes/puntos/).</p>";
    }
    echo "<p><a href='../../../scripts/clases/imagen.php'>Descargar imagen</a></p>"; 
}