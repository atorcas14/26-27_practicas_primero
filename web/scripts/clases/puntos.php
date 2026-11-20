<?php
include_once(dirname(__FILE__) . "/../clases/Punto.php");

function &damePuntos(): array
{
    static $puntos = [];
    return $puntos;
}