<?php
namespace VALNORMAL;

/**
 * Funcion que valida un valor entero
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $defecto
 * @return boolean
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool{
    $sanitized_var = filter_var($var, FILTER_SANITIZE_NUMBER_INT);
    $resultado = false;
    if((is_int($var))&&($var>=$min) && ($var<=$max)){
        $resultado = true;
    }
    $var = $defecto;
    return $resultado;
}

function validaReal (float &$var, float $min, float $max, float $defecto):bool{

    $limpiar = filter_var($var,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $resultado = filter_var($limpiar,FILTER_VALIDATE_FLOAT);

    if($resultado||$resultado<$min||$resultado>$max){
        return false;
        $var=$defecto;
    }

    $var=$defecto;
    return true;
}