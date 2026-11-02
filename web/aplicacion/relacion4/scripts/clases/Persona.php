<?php
class Persona{
    //Variables
    private string $nombre;
    private string $fecha_nacimiento;
    private string $domicilio;
    private string $localidad;
    private EstadoCivil $estado;

    /**
     * Constructor privado
     */
    private function __construct()
    {
        $this->nombre = "prueba";
        $this->fecha_nacimiento = "01/01/2000";
        $this->domicilio = "carrera 12";
        $this->localidad = "antequera";
        $this->estado = EstadoCivil::Soltero;
    }

    /**
     * Constructor estatico
     *
     * @param string $nombre
     * @param string $fecha_nacimiento
     * @param string $domicilio
     * @param string $localidad
     * @param EstadoCivil $estado
     * @return Persona
     */
    public static function registrarPersona(
        string $nombre,
        string $fecha_nacimiento,
        string $domicilio,
        string $localidad,
        EstadoCivil $estado
    ): Persona {
        $persona = new self();
        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha_nacimiento);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);
        return $persona;
    }

    // getter's and setter's 
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(string $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getDomicilio(): string
    {
        return $this->domicilio;
    }

    public function setDomicilio(string $domicilio): void
    {
        $this->domicilio = $domicilio;
    }

    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): void
    {
        $this->localidad = $localidad;
    }

    public function getEstado(): EstadoCivil
    {
        return $this->estado;
    }

    public function setEstado(EstadoCivil $estado): void
    {
        $this->estado = $estado;
    }

    /**
     * Redefinicion de toString
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->nombre . " es una persona " . $this->estado->descripcion()
            . " nacida en " . $this->fecha_nacimiento
            . " y que vive en " . $this->localidad;
    }

}