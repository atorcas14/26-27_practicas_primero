<?php


/**
 * clases sin sobrecarga
 */
class ClaseSinsobrecarga{

    public int $numero=10;


    //metodos magicos para el control de la sobrecarga
    public function _set(string $name, mixed $value):void{
        throw new \Exception("La propiedad $name no existe");
    }


    public function _get(string $name):mixed{
        throw new \Exception("La propiedad $name no existe");
        
    }


    public function __isset(string $name):bool {
        //throw new \Exception('Not implemented');
        return false;
    }

    public function __unset(string $name):void{
        //throw new \Exception('Not implemented');
        
    }

}