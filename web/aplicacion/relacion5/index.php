<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_filter.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_normal.php");
include_once(dirname(__FILE__) . "/scripts/librerias/validacion.php");
//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion5",
        "LINK" => ""
    ]
];

//Prueba validaEntero
$a = 5;
$b = 50;
$c = 0;

$r1 = \VALNORMAL\validaEntero($a, 1, 10, 0);
$r2 = \VALFILTER\validaEntero($b, 1, 10, 0);
$r3 = \VALFILTER\validaEntero($c, 0, 10, 99);

//Prueba validaHora
$hora1 = "24:00:00";
$r4 = \VALNORMAL\validaHora($hora1, "00:00:00");

$hora2 = " 23:59:59 ";
$r5 = \VALFILTER\validaHora($hora2, "00:00:00");

//Prueba validaFecha
$fecha1 = "29/02/2023";
$r6 = \VALNORMAL\validaFecha($fecha1, "01/01/2000");

$fecha2 = "5/11/1999";
$r7 = \VALFILTER\validaFecha($fecha2, "01/01/2000");

//Prueba validaReal
$real1 = "3.5";
$r8 = \VALNORMAL\validaReal($real1, -5.0, 10.0, 0.0);

$real2 = "25.7";
$r9 = \VALFILTER\validaReal($real2, -5.0, 10.0, 0.0);

// Email
$email1 = " juan@correo.com ";
$r11 = \VALNORMAL\validaEmail($email1, "defecto@correo.com");
$email2 = "juan@correo";
$r12 = \VALFILTER\validaEmail($email2, "defecto@correo.com");
$email3 = "ju an@correo.com";
$r13 = \VALFILTER\validaEmail($email3, "defecto@correo.com");

// Cadena (longitud máxima 5)
$cad1 = "hola";
$r14 = \VALNORMAL\validaCadena($cad1, 5, "corta");
$cad2 = "demasiado larga";
$r15 = \VALFILTER\validaCadena($cad2, 5, "corta");

// Expresión (solo 3 letras mayúsculas)
$exp1 = "ABC";
$r16 = \VALNORMAL\validaExpresion($exp1, '/^[A-Z]{3}$/', "XXX");
$exp2 = "abc1";
$r17 = \VALFILTER\validaExpresion($exp2, '/^[A-Z]{3}$/', "XXX");

// Rango (no modifica la variable)
$posibles = ["rojo", "verde", "azul"];
$r18  = \VALNORMAL\validaRango("verde", $posibles);                 // valor
$r19  = \VALFILTER\validaRango("negro", $posibles);                 // no está
$r110 = \VALNORMAL\validaRango("b", ["a" => 1, "b" => 2], 2);       // clave
$r111 = \VALFILTER\validaRango("1", ["a" => 1, "b" => 2], 2);       // no es clave



// Array con todas las pruebas: [nombre, valor final, resultado]
$pruebas = [
    ["NORMAL validaEntero  \$a",     $a,     $r1],
    ["FILTER validaEntero  \$b",     $b,     $r2],
    ["FILTER validaEntero  \$c",     $c,     $r3],
    ["NORMAL validaHora    \$hora1", $hora1, $r4],
    ["FILTER validaHora    \$hora2", $hora2, $r5],
    ["NORMAL validaFecha   \$fecha1", $fecha1, $r6],
    ["FILTER validaFecha   \$fecha2", $fecha2, $r7],
    ["NORMAL validaReal    \$real1", $real1, $r8],
    ["FILTER validaReal    \$real2", $real2, $r9],
    ["NORMAL validaEmail \$email1", $email1, $r11],
    ["FILTER validaEmail \$email2", $email2, $r12],
    ["FILTER validaEmail \$email3", $email3, $r13],
    ["NORMAL validaCadena \$cad1",  $cad1,   $r14],
    ["FILTER validaCadena \$cad2",  $cad2,   $r15],
    ["NORMAL validaExpresion \$exp1", $exp1, $r16],
    ["FILTER validaExpresion \$exp2", $exp2, $r17],
    ["NORMAL validaRango 'verde' tipo 1", "verde", $r18],
    ["FILTER validaRango 'negro' tipo 1", "negro", $r19],
    ["NORMAL validaRango 'b' tipo 2",     "b",     $r110],
    ["FILTER validaRango '1' tipo 2",     "1",     $r111]
];

// Entero (rango 1-10, defecto 0)
$ent1 = "7";
$rv1 = validaEntero($ent1, 1, 10, 0);
$ent2 = "50";
$rv2 = validaEntero($ent2, 1, 10, 0);

// Real (rango -5 a 10, defecto 0.0)
$real1 = "3.5";
$rv3 = validaReal($real1, -5.0, 10.0, 0.0);
$real2 = "abc";
$rv4 = validaReal($real2, -5.0, 10.0, 0.0);

// Fecha
$fecha1 = "1/2/2023";
$rv5 = validaFecha($fecha1, "01/01/2000");
$fecha2 = "29/02/2023";
$rv6 = validaFecha($fecha2, "01/01/2000");

// Hora
$hora1 = "0:5:1";
$rv7 = validaHora($hora1, "00:00:00");
$hora2 = "24:00:00";
$rv8 = validaHora($hora2, "00:00:00");

// Email
$email1 = " juan@correo.com ";
$rv9 = validaEmail($email1, "defecto@correo.com");
$email2 = "juan@correo";
$rv10 = validaEmail($email2, "defecto@correo.com");

// Cadena (longitud máxima 5)
$cad1 = "hola";
$rv11 = validaCadena($cad1, 5, "corta");
$cad2 = "demasiado larga";
$rv12 = validaCadena($cad2, 5, "corta");

// Expresión (3 letras mayúsculas)
$exp1 = "ABC";
$rv13 = validaExpresion($exp1, '/^[A-Z]{3}$/', "XXX");
$exp2 = "abc1";
$rv14 = validaExpresion($exp2, '/^[A-Z]{3}$/', "XXX");

// Rango (no modifica la variable)
$posibles = ["rojo", "verde", "azul"];
$rv15 = validaRango("verde", $posibles);
$rv16 = validaRango("negro", $posibles);
$rv17 = validaRango("b", ["a" => 1, "b" => 2], 2);
$rv18 = validaRango("1", ["a" => 1, "b" => 2], 2);

// [nombre, valor final, resultado obtenido, resultado esperado]
$pruebas2 = [
    ["validaEntero \$ent1",    $ent1,   $rv1,  true],
    ["validaEntero \$ent2",    $ent2,   $rv2,  false],
    ["validaReal \$real1",     $real1,  $rv3,  true],
    ["validaReal \$real2",     $real2,  $rv4,  false],
    ["validaFecha \$fecha1",   $fecha1, $rv5,  true],
    ["validaFecha \$fecha2",   $fecha2, $rv6,  false],
    ["validaHora \$hora1",     $hora1,  $rv7,  true],
    ["validaHora \$hora2",     $hora2,  $rv8,  false],
    ["validaEmail \$email1",   $email1, $rv9,  true],
    ["validaEmail \$email2",   $email2, $rv10, false],
    ["validaCadena \$cad1",    $cad1,   $rv11, true],
    ["validaCadena \$cad2",    $cad2,   $rv12, false],
    ["validaExpresion \$exp1", $exp1,   $rv13, true],
    ["validaExpresion \$exp2", $exp2,   $rv14, false],
    ["validaRango 'verde'",    "verde", $rv15, true],
    ["validaRango 'negro'",    "negro", $rv16, false],
    ["validaRango clave 'b'",  "b",     $rv17, true],
    ["validaRango clave '1'",  "1",     $rv18, false],
];

// Opciones válidas (las incorrectas, 5 y 6, solo se pintan en el formulario)
$textosEstado = [1 => "Estudiante", 2 => "En paro", 3 => "Trabajando", 4 => "Jubilado"];
$textosEstudios = [0 => "Sin estudios", 1 => "Primaria", 2 => "Secundaria",
                   3 => "Bachillerato", 4 => "Ciclo formativo", 5 => "Universitarios"];

// Devuelve el valor de $_POST como cadena ("" si no existe o es un array manipulado)
function obtenerPost(string $clave): string
{
    return (isset($_POST[$clave]) && is_string($_POST[$clave])) ? $_POST[$clave] : "";
}

// Valores iniciales del formulario
$datos = [
    "nombre" => "", "password" => "", "nacimiento" => "",
    "carnet_dia" => "", "carnet_mes" => "", "carnet_anio" => "",
    "hora" => "", "estado" => 0, "estudios" => [],
    "hermanos" => 0, "sueldo" => 1100.0
];
$errores = [];
$correcto = false;

if (isset($_POST["crear"])) {

    // ---- Nombre: máx 25, no vacío, no empieza por H, en mayúsculas ----
    $nombre = mb_strtoupper(trim(obtenerPost("nombre")));
    if ($nombre === "") {
        $errores["nombre"][] = "Debe indicarse un nombre";
    } else {
        if (!validaCadena($nombre, 25, mb_substr($nombre, 0, 25))) {
            $errores["nombre"][] = "El nombre no puede tener más de 25 caracteres";
        }
        if (mb_substr($nombre, 0, 1) === "H") {
            $errores["nombre"][] = "El nombre no puede empezar por H";
        }
    }
    $datos["nombre"] = $nombre;

    // ---- Contraseña: máx 15, mín 8, mayúscula, minúscula, cifra y especial ($_-;<>@) ----
    $password = obtenerPost("password");
    $regexPass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$_\-;<>@]).{8,15}$/';
    if (!validaCadena($password, 15, "")) {
        $errores["password"][] = "La contraseña no puede tener más de 15 caracteres";
    } elseif (!validaExpresion($password, $regexPass, "")) {
        $errores["password"][] = "Mínimo 8 caracteres, con mayúscula, minúscula, cifra y un carácter de $_-;<>@";
    }
    $datos["password"] = "";   // la contraseña nunca se vuelve a mostrar

    // ---- Fecha de nacimiento ----
    $nacimiento = obtenerPost("nacimiento");
    $objNacimiento = null;
    if (!validaFecha($nacimiento, "")) {
        $errores["nacimiento"][] = "La fecha de nacimiento no es válida (dd/mm/aaaa)";
    } else {
        $objNacimiento = DateTime::createFromFormat('!d/m/Y', $nacimiento);
        if ($objNacimiento > new DateTime("today")) {
            $errores["nacimiento"][] = "La fecha de nacimiento no puede ser futura";
            $objNacimiento = null;
        }
    }
    $datos["nacimiento"] = $nacimiento;

    // ---- Fecha de carnet: día, mes y año por separado ----
    $dia  = obtenerPost("carnet_dia");
    $mes  = obtenerPost("carnet_mes");
    $anio = obtenerPost("carnet_anio");
    $okDia  = validaEntero($dia, 1, 31, 0);
    $okMes  = validaEntero($mes, 1, 12, 0);
    $okAnio = validaEntero($anio, 1900, (int)date("Y"), 0);

    if (!$okDia || !$okMes || !$okAnio) {
        $errores["carnet"][] = "Día, mes y año del carnet deben ser números válidos";
        $datos["carnet_dia"]  = $okDia  ? $dia  : "";
        $datos["carnet_mes"]  = $okMes  ? $mes  : "";
        $datos["carnet_anio"] = $okAnio ? $anio : "";
    } else {
        $datos["carnet_dia"] = $dia;
        $datos["carnet_mes"] = $mes;
        $datos["carnet_anio"] = $anio;

        // Se compone una única fecha con los tres elementos
        $fechaCarnet = sprintf("%02d/%02d/%04d", $dia, $mes, $anio);
        if (!validaFecha($fechaCarnet, "")) {
            $errores["carnet"][] = "La fecha del carnet no existe en el calendario";
        } elseif ($objNacimiento !== null) {
            // Mayoría de edad: carnet - 18 años no puede ser anterior al nacimiento
            $objCarnet = DateTime::createFromFormat('!d/m/Y', $fechaCarnet);
            $objCarnet->sub(new DateInterval("P18Y"));
            $intervalo = $objNacimiento->diff($objCarnet);
            if ($intervalo->invert === 1) {
                $errores["carnet"][] = "En la fecha del carnet la persona aún no era mayor de edad";
            }
        }
    }

    // ---- Hora de levantarse ----
    $hora = obtenerPost("hora");
    if (!validaHora($hora, "")) {
        $errores["hora"][] = "La hora no es válida (hh:mm:ss)";
    }
    $datos["hora"] = $hora;

    // ---- Estado (radio) ----
    $estadoPost = obtenerPost("estado");
    $estado = 0;
    if ($estadoPost === "") {
        $errores["estado"][] = "Debe indicarse un estado";
    } elseif (!validaRango($estadoPost, $textosEstado, 2)) {
        $errores["estado"][] = "El estado elegido no es válido";
    } else {
        $estado = (int)$estadoPost;
    }
    $datos["estado"] = $estado;

    // ---- Estudios (checkbox) ----
    $estudiosPost = (isset($_POST["estudios"]) && is_array($_POST["estudios"])) ? $_POST["estudios"] : [];
    $estudios = [];
    $hayInvalido = false;
    foreach ($estudiosPost as $e) {
        if (is_string($e) && validaRango($e, $textosEstudios, 2)) {
            $estudios[] = (int)$e;
        } else {
            $hayInvalido = true;
        }
    }
    $estudios = array_values(array_unique($estudios));
    if ($hayInvalido) {
        $errores["estudios"][] = "Se ha marcado una opción de estudios no válida";
    }
    if (!$estudios) {
        $errores["estudios"][] = "Debe seleccionarse al menos un estudio";
    }
    if (in_array(0, $estudios, true) && count($estudios) > 1) {
        $estudios = [0];   // "Sin estudios" excluye al resto
    }
    $datos["estudios"] = $estudios;

    // ---- Hermanos: entero 0-20, defecto 0 ----
    $hermanos = obtenerPost("hermanos");
    if (!validaEntero($hermanos, 0, 20, 0)) {
        $errores["hermanos"][] = "Los hermanos deben ser un entero entre 0 y 20";
    }
    $datos["hermanos"] = $hermanos;

    // ---- Sueldo: real 1000-150000, defecto 1100 ----
    $sueldo = str_replace(",", ".", obtenerPost("sueldo"));   // admite coma decimal
    if (!validaReal($sueldo, 1000.0, 150000.0, 1100.0)) {
        $errores["sueldo"][] = "El sueldo debe estar entre 1000 y 150000";
    }
    $datos["sueldo"] = $sueldo;

    if (!$errores) {
        $correcto = true;
    }
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 5");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 5", $barraUbi);
cuerpo($pruebas, $pruebas2, $datos, $errores, $correcto, $textosEstado, $textosEstudios); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($pruebas,$pruebas2, $datos, $errores, $correcto, $textosEstado, $textosEstudios)
{
    //vista: escapa texto para HTML
function h($texto): string
{
    return htmlspecialchars((string)$texto);
}

//vista: errores de un campo
function mostrarErrores(array $errores, string $campo)
{
    if (isset($errores[$campo])) {
        foreach ($errores[$campo] as $e) {
            echo "<span style='color:#b00020'>" . h($e) . "</span><br>";
        }
    }
}
    //vista: resumen cuando todo es correcto
function mostrarResumen(array $datos, array $textosEstado, array $textosEstudios)
{
    $estudios = array_map(fn($c) => $textosEstudios[$c], $datos["estudios"]);

    echo "<h3>Datos introducidos</h3><ul>";
    echo "<li>Nombre: " . h($datos["nombre"]) . "</li>";
    echo "<li>Contraseña: ******** (no se muestra)</li>";
    echo "<li>Fecha de nacimiento: " . h($datos["nacimiento"]) . "</li>";
    echo "<li>Fecha de carnet: " . h(sprintf("%02d/%02d/%04d", $datos["carnet_dia"], $datos["carnet_mes"], $datos["carnet_anio"])) . "</li>";
    echo "<li>Hora de levantarse: " . h($datos["hora"]) . "</li>";
    echo "<li>Estado: " . h($textosEstado[$datos["estado"]]) . "</li>";
    echo "<li>Estudios: " . h(implode(", ", $estudios)) . "</li>";
    echo "<li>Hermanos: " . h($datos["hermanos"]) . "</li>";
    echo "<li>Sueldo: " . h(number_format((float)$datos["sueldo"], 2, ",", ".")) . " €</li>";
    echo "</ul>";
}

function mostrarFormulario(array $datos, array $errores, array $textosEstado, array $textosEstudios)
{
    echo "<form method='post' action='" . h($_SERVER["PHP_SELF"]) . "'>";

    echo "<p><label>Nombre: <input type='text' name='nombre' maxlength='25' value='" . h($datos["nombre"]) . "'></label><br>";
    mostrarErrores($errores, "nombre");
    echo "</p>";

    echo "<p><label>Contraseña: <input type='password' name='password' maxlength='15'></label><br>";
    mostrarErrores($errores, "password");
    echo "</p>";

    echo "<p><label>Fecha de nacimiento (dd/mm/aaaa): <input type='text' name='nacimiento' value='" . h($datos["nacimiento"]) . "'></label><br>";
    mostrarErrores($errores, "nacimiento");
    echo "</p>";

    echo "<p>Fecha de carnet: ";
    echo "<input type='number' name='carnet_dia' placeholder='día' style='width:5em' value='" . h($datos["carnet_dia"]) . "'> / ";
    echo "<input type='number' name='carnet_mes' placeholder='mes' style='width:5em' value='" . h($datos["carnet_mes"]) . "'> / ";
    echo "<input type='number' name='carnet_anio' placeholder='año' style='width:6em' value='" . h($datos["carnet_anio"]) . "'><br>";
    mostrarErrores($errores, "carnet");
    echo "</p>";

    echo "<p><label>Hora de levantarse (hh:mm:ss): <input type='text' name='hora' value='" . h($datos["hora"]) . "'></label><br>";
    mostrarErrores($errores, "hora");
    echo "</p>";

    // Estado: radios (se añade el 5, incorrecto, para probar)
    echo "<p>Estado:<br>";
    $opcionesEstado = $textosEstado + [5 => "Incorrecta"];
    foreach ($opcionesEstado as $valor => $texto) {
        $marcado = ($datos["estado"] === $valor) ? " checked" : "";
        echo "<label><input type='radio' name='estado' value='$valor'$marcado> $valor - " . h($texto) . "</label><br>";
    }
    mostrarErrores($errores, "estado");
    echo "</p>";

    // Estudios: checkbox (se añade el 6, incorrecto, para probar)
    echo "<p>Estudios:<br>";
    $opcionesEstudios = $textosEstudios + [6 => "Incorrecta"];
    foreach ($opcionesEstudios as $valor => $texto) {
        $marcado = in_array($valor, $datos["estudios"], true) ? " checked" : "";
        echo "<label><input type='checkbox' name='estudios[]' value='$valor' class='estudio'$marcado onclick='controlEstudios(this)'> $valor - " . h($texto) . "</label><br>";
    }
    mostrarErrores($errores, "estudios");
    echo "</p>";

    echo "<p><label>Hermanos (0-20): <input type='number' name='hermanos' value='" . h($datos["hermanos"]) . "'></label><br>";
    mostrarErrores($errores, "hermanos");
    echo "</p>";

    echo "<p><label>Sueldo (1000-150000 €): <input type='text' name='sueldo' value='" . h($datos["sueldo"]) . "'></label><br>";
    mostrarErrores($errores, "sueldo");
    echo "</p>";

    echo "<p><input type='submit' name='crear' value='Enviar'></p>";
    echo "</form>";

    // "Sin estudios" (0) desmarca el resto, y marcar otro desmarca el 0
    echo "<script>
    function controlEstudios(el) {
        if (!el.checked) return;
        document.querySelectorAll('.estudio').forEach(function (c) {
            if (c !== el && (el.value === '0' || c.value === '0')) c.checked = false;
        });
    }
    </script>";
}

 echo "<h1>Formulario</h1>";
    if ($correcto) {
        mostrarResumen($datos, $textosEstado, $textosEstudios);
    } else {
        mostrarFormulario($datos, $errores, $textosEstado, $textosEstudios);
    }
?>
    <h1>Prueba validaEntero, validaReal, validaHora, validaFecha, validaEmail, validaCadena, validaExpresion y validaRango</h1> <br>
<?php

    foreach ($pruebas as [$nombre, $valor, $resultado]) {
        echo htmlspecialchars($nombre)
        . " = " . htmlspecialchars(var_export($valor, true))
        . " | resultado: " . var_export($resultado, true); ?><br><?php
    }

    ?>
    <h1>Prueba desde "validacion" validaEntero, validaReal, validaHora, validaFecha, validaEmail, validaCadena, validaExpresion y validaRango</h1> <br>
<?php

    foreach ($pruebas2 as [$nombre, $valor, $resultado]) {
        echo htmlspecialchars($nombre)
        . " = " . htmlspecialchars(var_export($valor, true))
        . " | resultado: " . var_export($resultado, true); ?><br><?php
    }

    
}
