<?php
Class Flauta extends InstrumentoViento implements IFabricable{

    /**
     * Constructor para crear flautas
     *
     * @param string $material
     * @param integer $edad
     */
    private function __construct(string $material="madera",int $edad=15)
    {
        parent::__construct($material,$edad);
    }

    /**
     * Un constructor que nos permite crear objetos desde un array
     *
     * 
     */
    public static function CrearDesdeArray(array $datos = []): Flauta
    {
        $material = $datos["material"] ?? "madera";
        $edad     = $datos["edad"] ?? 15;
        return new self($material, $edad);
    }

    /**
     * Redefinicion de la funcion sonido
     *
     * @return string
     */
    #[Override]
    public function sonido():string{
        return "sonido suave";
    }

    /**
     * Redefinicion del metodoFabricacion de IFabricable
     *
     * @return string
     */
    final public function metodoFabricacion():string{
        if ($this->material == "metal") {
            return "1) Cortar el tubo metálico. 2) Perforar los orificios de las notas. "
                 . "3) Soldar las llaves y el mecanismo. 4) Pulir y afinar.";
        }
        // madera (y cualquier otro material)
        return "1) Seleccionar y secar la madera. 2) Tornear el tubo. "
             . "3) Perforar los orificios de las notas. 4) Barnizar y afinar.";
    }

    /**
     * Redefinicion del metodoReciclado de IFabricable
     *
     * @return string
     */
    final public function metodoReciclado():string{
        if ($this->material == "metal") {
            return "Llevar al contenedor de metales para su fundición y reutilización.";
        }
        return "Reutilizar la madera como material de carpintería o llevar a un punto de reciclaje de madera.";
    }

    /**
     * Funcion de clonado 
     *
     * @return void
     */
    public function __clone(){
        $this->edad=0;
        $this->orden = self::$creacion+1;
        self::$creacion+1;
    }

}