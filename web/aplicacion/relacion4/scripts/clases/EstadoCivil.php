<?php

Enum EstadoCivil:int{
    //Valores 
    case Soltero = 10;
    case Casado = 20;
    case Pareja = 30;
    case Viudo = 40;

    /**
     * Funcion que devuelve la descripcion
     *
     * @return string
     */
    public function descripcion():string{
        return $this->name;
    }

    /**
     * Funcion que devuelve el valor
     *
     * @return integer
     */
    public function valor():int{
        return $this->value;
    }

    /**
     * Funcion que devuelve todos los casos en un array
     *
     * @return array
     */
    public static function casos():array{
        return self::cases();
    }
}