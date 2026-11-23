<?php
include_once(dirname(__FILE__) . "/../librerias/val_normal.php");
include_once(dirname(__FILE__) . "/../clases/Punto.php");
include_once(dirname(__FILE__) . "/../clases/ImagenPuntos.php");

function rutaFicheroPuntos():string{
    return dirname(__FILE__) . "/ficheros" . Punto::nombreArchivo(). ".dat";
}

function lineaAPunto(string $linea):?Punto{
    $partes = explode(";",$linea);
    if(count($partes)!==4) return null;
    [$x,$y,$color,$grosor] = array_map("trim",$partes);

    if(!ctype_digit($x) || !ctype_digit($y) || !ctype_digit($grosor)) return null;
    if(!\VALNORMAL\validaEntero($x,0,500,-1) || !\VALNORMAL\validaEntero($y,0,500,-1)) return null;
    if(!\VALNORMAL\validaRango($color, Punto::COLORES,2) ||!\VALNORMAL\validaRango($grosor, Punto::GROSORES,2)) return null;

    try{
        return new Punto((int)$x,(int)$y,$color,(int)$grosor);
    }
    catch(Throwable $e){
        return null;
    }
}

function puntoALinea(Punto $p): string
{
    return $p->getX() . " ; " . $p->getY() . " ; " . $p->getColor() . " ; " . $p->getGrosor();
}

function &damePuntos(): array
{
    static $puntos = null;
    if($puntos==null){
        $puntos = [];
        $ruta = rutaFicheroPuntos();
        if (is_file($ruta)) {
            foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
                $p = lineaAPunto($linea);
                if ($p !== null) $puntos[] = $p;
            }
        }
    }
    return $puntos;
}

function guardarPuntos(array $puntos):bool{
    $ruta = rutaFicheroPuntos();
    $carpeta = dirname($ruta);
    if(!is_dir($carpeta)&&!mkdir($carpeta,0775,true)) return false;

    $lineas = array_map("puntoALinea", $puntos);
    $contenido = $lineas ? implode("\n",$lineas) . "\n" : "";
    return file_put_contents($ruta,$contenido,LOCK_EX) !== false;
}