<?php
Class InstrumentoViento extends InstrumentoBase{
    //Variable
    protected string $material = "madera";
    
    /**
     * Constructor
     *
     * @param string $material
     * @param integer $edad
     */
    #[Override]
    public function __construct(string $material = "madera", int $edad = 15)
    {
        return parent::__construct("instrumento de viento", $edad);
        $this->material=$material;
    }

    /**
     * Funcion creado de la clase abstracta
     *
     * @return string
     */
    #[Override]
    final public function afinar(): string
    {
        return "Ajustar la embocadura y la longitud del tubo hasta lograr la nota correcta";
    }

    #[Override]
    final public function sonido(): string
    {
        return "sonido suave";
    }

    /**
     * Redefinicion del toString de la clase abstracta
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString() . ". Instrumento de material " . $this->material;
    }
}