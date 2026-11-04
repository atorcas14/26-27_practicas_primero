<?php
namespace VALNORMAL;


function validaEntero(int &$var, int $min, int $max, int $defecto):bool{
    $sanitized_var = filter_var($var, FILTER_SANITIZE_NUMBER_INT);
    $resultado = false;
    if(filter_var($sanitized_var,FILTER_VALIDATE_INT)){
        
    }
    return $resultado;
}