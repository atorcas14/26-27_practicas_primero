<?php
abstract Class InstrumentoBase{
    //Variables
    private string $descripcion;
    protected int $edad = 10;

    //Variable de clase
    protected static int $creacion=0;

    //Propiedad de creacion
    private int $orden;

    //Constructor
    public function __construct(string $descripcion="", int $edad=10){
        $this->descripcion = $descripcion;
        $this->edad = $edad;
        $this->orden = self::$creacion+1;
        self::$creacion++;
    }
    
    //Getter's and setter's
    public function getDescripcion():string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion):void{
        $this->descripcion = $descripcion;
    }

    public function getEdad():int{
        return $this->edad;
    }

    public function getOrden(): int{
        return $this->orden;
    }

    //funciones abstractos
    abstract public function sonido():string;

    abstract public function afinar():string;

    //funcion que añade 1 a la edad
    public function envejecer():void{
        $this->edad++;
    }

    //funcion que muestra toda la informacion del instrumento
    public function __toString():string{
        return "instrumento con descripcion: ".$this->descripcion .
                " instancia ".$this->orden . 
                " con un total de: ".self::$creacion . 
                ". Tiene ".$this->edad. " años. Y la clase es: ". get_class($this);
    }
}