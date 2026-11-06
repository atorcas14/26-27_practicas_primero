<?php
namespace VALFILTER;

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
    $limpiar = filter_var($var,FILTER_SANITIZE_NUMBER_INT);
    $resultado = filter_var($limpiar,FILTER_VALIDATE_INT, ["options" => ["min_range"=>$min, "max_range"=>$max]]);
    if(!$resultado){
        return false;
    }
    $var=$defecto;
    return true;
}

/**
 * Funcion que valida un numero real
 *
 * @param float $var
 * @param float $min
 * @param float $max
 * @param float $defecto
 * @return boolean
 */
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