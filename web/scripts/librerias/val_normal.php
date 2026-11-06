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
    $limpio = preg_replace('/[^0-9+-]/', '', (string)$var);

    
    if (preg_match('/^[+-]?\d+$/', $limpio) && (int)$limpio >= $min && (int)$limpio <= $max) {
        $var = (int)$limpio;      
        return true;
    }
    $var = $defecto;
    return false;
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

    $limpio = preg_replace('/[^0-9.+-]/', '', (string)$var);

    if (is_numeric($limpio) && (float)$limpio >= $min && (float)$limpio <= $max) {
        $var = (float)$limpio; 
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida una fecha
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaFecha(string &$var,string $defecto):bool{
    $fecha = trim($var);

    if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $fecha, $m)
        && checkdate((int)$m[2], (int)$m[1], (int)$m[3])) {
        $var = sprintf("%02d/%02d/%04d", $m[1], $m[2], $m[3]);   
        return true;
    }
    $var = $defecto;
    return false;
}