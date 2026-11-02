<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once(dirname(__FILE__)."/scripts/clases/InstrumentoBase.php");
include_once(dirname(__FILE__)."/scripts/clases/InstrumentoViento.php");
include_once(dirname(__FILE__)."/scripts/clases/IFabricable.php");
include_once(dirname(__FILE__)."/scripts/clases/Flauta.php");
include_once(dirname(__FILE__)."/scripts/clases/EstadoCivil.php");
include_once(dirname(__FILE__)."/scripts/clases/Persona.php");
include_once(dirname(__FILE__)."/scripts/clases/SerieFibonacci.php");
include_once(dirname(__FILE__)."/scripts/clases/ClaseMisPropiedades.php");
//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion4",
        "LINK" => ""
    ]
];

//Flautas
$lineas = [];


$f1 = Flauta::CrearDesdeArray([]);                                     // madera, 15
$f2 = Flauta::CrearDesdeArray(["material" => "metal", "edad" => 5]);
$f3 = Flauta::CrearDesdeArray(["edad" => 30]);                         // madera, 30

$lineas[] = "--- Flautas creadas ---";
$lineas[] = (string)$f1;
$lineas[] = (string)$f2;
$lineas[] = (string)$f3;


$f1->envejecer();
$f1->setDescripcion("Flauta del colegio");
$lineas[] = "--- Tras envejecer y cambiar descripción ---";
$lineas[] = (string)$f1;
$lineas[] = "Edad: " . $f1->getEdad();
$lineas[] = "Descripción: " . $f1->getDescripcion();
$lineas[] = "Sonido: " . $f1->sonido();
$lineas[] = "Afinar: " . $f1->afinar();


$lineas[] = "--- Fabricación y reciclado ---";
$lineas[] = "Madera, fabricación: " . $f3->metodoFabricacion();
$lineas[] = "Madera, reciclado: " . $f3->metodoReciclado();
$lineas[] = "Metal, fabricación: " . $f2->metodoFabricacion();
$lineas[] = "Metal, reciclado: " . $f2->metodoReciclado();


$clon = clone $f2;
$lineas[] = "--- Clonación de la flauta de metal ---";
$lineas[] = "Original: " . $f2;
$lineas[] = "Clon:     " . $clon;


//EstadoCivil y Persona
// Valores posibles del enum: [10, 20, 30, 40]
$valores = array_map(fn($caso) => $caso->valor(), EstadoCivil::casos());

// Valor aleatorio entre los posibles
$valorAleatorio = $valores[array_rand($valores)];

// Convertimos el valor en el caso del enum
$estado = EstadoCivil::from($valorAleatorio);

// Creamos la persona con ese estado
$persona = Persona::registrarPersona(
    "Ana",
    "15/03/1995",
    "calle Sol 4",
    "antequera",
    $estado
);

$lineasPersona = [];
$lineasPersona[] = "Valores posibles: " . implode(", ", $valores);
$lineasPersona[] = "Valor aleatorio elegido: " . $valorAleatorio;
$lineasPersona[] = "Estado obtenido: " . $estado->descripcion();
$lineasPersona[] = "Persona: " . $persona;
$lineasPersona[] = "Comprobación (getEstado coincide): " . ($persona->getEstado() === $estado ? "OK" : "FALLO");



//Fibonacci
// Con el Iterator
$conIterator = "";
foreach (new SerieFibonacci(10) as $valor) {
    $conIterator .= "$valor &nbsp;";
}

// Con el generador estático
$conGenerador = "";
foreach (SerieFibonacci::fFibonacci(10) as $valor) {
    $conGenerador .= "$valor &nbsp;";
}


//ClaseMisPropiedades
$lineasPropiedades = [];
$Objeto = new ClaseMisPropiedades();

// 1) Propiedad pública y propiedades dinámicas
$Objeto->propPublica = "publica";
$Objeto->propiedad1 = 25;
$Objeto->propiedad2 = "cadena de texto";
$lineasPropiedades[] = "--- Lectura ---";
$lineasPropiedades[] = "la propiedad 1 vale " . $Objeto->propiedad1;
$lineasPropiedades[] = "la propiedad 2 vale " . $Objeto->propiedad2;
$lineasPropiedades[] = "propPublica vale " . $Objeto->propPublica;

// 2) Modificar una dinámica y añadir otras de distinto tipo
$Objeto->propiedad1 = 100;
$Objeto->decimal = 3.14;
$Objeto->lista = [1, 2, 3];
$lineasPropiedades[] = "--- Modificar y añadir ---";
$lineasPropiedades[] = "propiedad1 ahora vale " . $Objeto->propiedad1;
$lineasPropiedades[] = "decimal vale " . $Objeto->decimal;
$lineasPropiedades[] = "lista vale " . implode(", ", $Objeto->lista);

// 3) isset y unset
$lineasPropiedades[] = "--- isset y unset ---";
$lineasPropiedades[] = "isset(propiedad1): " . (isset($Objeto->propiedad1) ? "sí" : "no");
$lineasPropiedades[] = "isset(propiedad3): " . (isset($Objeto->propiedad3) ? "sí" : "no");
unset($Objeto->decimal);
$lineasPropiedades[] = "Tras unset(decimal), isset: " . (isset($Objeto->decimal) ? "sí" : "no");

// 4) Lo que no está permitido (se captura el error)
$lineasPropiedades[] = "--- Accesos no permitidos ---";
try {
    $Objeto->_propPrivada = "privada";
    $lineasPropiedades[] = "FALLO: se permitió asignar _propPrivada";
} catch (Exception $e) {
    $lineasPropiedades[] = "Error esperado: " . $e->getMessage();
}
try {
    echo $Objeto->propiedad3;
    $lineasPropiedades[] = "FALLO: propiedad3 no debería existir";
} catch (Exception $e) {
    $lineasPropiedades[] = "Error esperado: " . $e->getMessage();
}

// 5) Recorrido con foreach
$lineasPropiedades[] = "--- foreach ---";
foreach ($Objeto as $clave => $valor) {
    $texto = is_array($valor) ? implode(", ", $valor) : $valor;
    $lineasPropiedades[] = $clave . " => " . $texto;
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 4");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 4", $barraUbi);
cuerpo($conGenerador,$conIterator, $lineas, $lineasPersona, $lineasPropiedades); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($conGenerador,$conIterator, $lineas, $lineasPersona, $lineasPropiedades)
{
    

?>
    
    <?php 
    echo "<h2>Clase Flauta</h2>";
    foreach ($lineas as $linea) {
        echo ($linea) . "\n";
    }
    echo "<br>";

    echo "<h2>Clase EstadoCivil y Persona</h2>";
    foreach ($lineasPersona as $linea) {
        echo ($linea) . "\n";
    }

    echo "<h2>Serie de Fibonacci</h2>";
    echo "<p>Con Iterator: " . $conIterator . "</p>";
    echo "<p>Con generador: " . $conGenerador . "</p>";

    echo "<h2>ClaseMisPropiedades</h2>";
    foreach ($lineasPropiedades as $linea) {
        echo ($linea) . "\n";
    }
    ?>

<?php
}
