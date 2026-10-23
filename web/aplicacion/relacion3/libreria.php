<?php

use BcMath\Number;

/**
 * Funcion que nos permite añadir al array el primer numero 
 * a la posicion asociativa indicada por la cadena
 *
 * @param array $array
 * @param string $cadena
 * @param int $num1
 * @param int $num2
 */
function cuentaVeces(array &$array, string $cadena,int $num1, int &$num2):bool{
    $num2++;
    if($cadena!="2daw" || $cadena!="primera"){
        $array[$cadena] = $num1;
        return true;
    }
    else{
        return false;
    }
}

/**
 * Funcion que permite generar una cadena con una longitud determinada
 * que por defecto esta a 10 y se generan de forma aleatoria
 *
 * @param integer $longitud
 * @return boolean
 */
function generarCadena(int $longitud=10):bool|string{
    
    $caracteres = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    $array = [];
    if($longitud>0){

        for ($i = 0; $i < $longitud; $i++) {
            $array[$i] = $caracteres[mt_rand(0, count($caracteres) - 1)];
        }
        $cadena = "";
        foreach($array as $elem){
            $cadena .= $elem;
        }
        return $cadena;
        }
    else{
        return false;
    }
}

/**
 * Funcion que permite realizar unos tipos de operaciones
 *
 * @param integer $tipo
 * @param integer ...$valores
 */
function operaciones(int $tipo, int ...$valores):int{
    $total = 0;
    $primero = $valores[0];
    switch($tipo){
        case 1: 
            foreach($valores as $elem){
                $total +=$elem; 
            };
            break;
        case 2 : 
            $total=$primero;
            
            for($i=0;$i<count($valores);$i++){
                $total -= $valores[$i]; 
            };
            break;
        case 3 : 
            $total=1;
            foreach($valores as $elem){
                $total *=$elem; 
            };
            break;
        default : 
        $pares = 0;
        $impares=0;
            for($i=0;$i<count($valores);$i++){
                if($valores[$i]%2==0)
                    $pares += $valores[$i];
                else
                    $impares += $valores[$i];
                $total = $pares - $impares;
            };
            break;
    }
    return $total;
}

/**
 * Funcion para devolver la suma de 3 numeros y la multiplicacion
 *
 * @param integer $num1
 * @param integer $num2
 * @param integer $num3
 * @return float
 */
function devuelve(int $num1, int $num2, int $num3=10):float{
    $multiplicacion = $num1 * $num2 * $num3;
    $suma = $num1 + $num2 + $num3;
    $num1 = $suma;
    return $multiplicacion;
}