<?php

use BcMath\Number;
/*******EJERCICIO1 *****************************/
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


/********************EJERCICIO 2 ********************/
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


/******************************EJERCICIO 3*****************/
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

/************************EJERCICIO 4 *******************/
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

/******************************EJERCICIO 5 *****************/
/**
 * Funcion para sumar dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @return float
 */
function suma (int $num1, int $num2): float{
    $suma = $num1 + $num2;
    return $suma;
}

/**
 * Funcion para restar dos numeros 
 *
 * @param integer $num1
 * @param integer $num2
 * @return float
 */
function resta (int $num1, int $num2): float{
    $suma = $num1 - $num2;
    return $suma;
}

/**
 * Funcion para multiplicar dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @return float
 */
function multiplicacion (int $num1, int $num2): float{
    $suma = $num1 * $num2;
    return $suma;
}

/**
 * Funcion que permite realizar una operacion con las funciones anteriores
 *
 * @param string $tipo
 * @param integer $num1
 * @param integer $num2
 * @return float
 */
function hacerOperacion (string $tipo, int $num1, int $num2):float{
    $resultado =0;
    if($tipo=="suma")
        $resultado = suma($num1,$num2);
    else if($tipo=="resta")
        $resultado = resta($num1,$num2);
    else if($tipo=="multiplicacion")
        $resultado = multiplicacion($num1,$num2);
    else
        echo "Opcion no disponible";
    return $resultado;
}

/**************EJERCICIO 6 *******/
/**
 * Funcion que contiene un parametro callable
 *
 * @param integer $num1
 * @param integer $num2
 * @param callable $callback
 * @return integer
 */
function llamadaAFuncion (int $num1, int $num2, callable $callback):int{
    return $callback($num1,$num2);
}


/********************EJERCICIO 7 *************/
/**
 * Funcion para ordenar un array con usort
 *
 * @param array $array
 * @return void
 */
function ordenar (array &$array){
    usort($array,function ($a, $b) {
        return strlen($b)-strlen($a);
    });
}