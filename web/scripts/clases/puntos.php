<?php
include_once(dirname(__FILE__) . "/../clases/Punto.php");

function &damePuntos(): array
{
    static $puntos = null;
    if($puntos==null){
        $puntos = [
            new Punto(50, 60, "red",1),
            new Punto(200, 150, "blue",2),
            new Punto(400, 300, "green",3)
        ];
    }
    return $puntos;
}