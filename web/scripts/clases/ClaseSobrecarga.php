<?php


/**
 * clases sobrecarga con el siguiente comportamiento
 * 
 * - Si la propiedad empieza por m o M la doy por buena
 * - Una propiedad sobrecargada siempre tendra el valor 234
 * 
 */
class ClaseSobrecarga{

    public int $numero=10;


    //metodos magicos para el control de la sobrecarga
    public function _set(string $name, mixed $value):void{
        throw new \Exception("La propiedad $name no existe");
    }


    public function _get(string $name):mixed{
        if(mb_substr(mb_strtoupper($name),0,1)!=='M')
            throw new \Exception("La propiedad $name no existe");
        return 234;
    }


    public function __isset(string $name):bool {
        //throw new \Exception('Not implemented');
        return false;
    }

    public function __unset(string $name):void{
        //throw new \Exception('Not implemented');
        
    }

}