<?php
Class ClaseMisPropiedades implements Iterator{
    //Variables
    private array $_propiedades = [];       // propiedades dinámicas
    public mixed $propPublica = null;
    private mixed $_propPrivada = 25;

    // Datos para el recorrido (se rellenan en rewind)
    private array $_claves = [];
    private array $_valores = [];
    private int $_posicion = 0;

    private function esReservada(string $nombre): bool
    {
        return $nombre === "_propPrivada"
            || $nombre === "_propiedades"
            || $nombre === "_claves"
            || $nombre === "_valores"
            || $nombre === "_posicion";
    }

    //Getter's setter's isset y unset
    public function __set(string $nombre, mixed $valor): void
    {
        if ($this->esReservada($nombre)) {
            throw new Exception("No se puede asignar un valor a la propiedad privada $nombre");
        }
        $this->_propiedades[$nombre] = $valor;
    }

    public function __get(string $nombre): mixed
    {
        if ($this->esReservada($nombre)) {
            throw new Exception("No se puede acceder a la propiedad privada $nombre");
        }
        if (!array_key_exists($nombre, $this->_propiedades)) {
            throw new Exception("La propiedad $nombre no existe");
        }
        return $this->_propiedades[$nombre];
    }

    public function __isset(string $nombre): bool
    {
        return !$this->esReservada($nombre) && isset($this->_propiedades[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        if (!$this->esReservada($nombre)) {
            unset($this->_propiedades[$nombre]);
        }
    }

    // ---- Iterator ----
    public function rewind(): void
    {
        $this->_claves = [];
        $this->_valores = [];

        // Primero las dinámicas, con prefijo oi_
        foreach ($this->_propiedades as $clave => $valor) {
            $this->_claves[] = "oi_" . $clave;
            $this->_valores[] = $valor;
        }
        // Al final propPublica y _propPrivada
        $this->_claves[] = "oi_propPublica";
        $this->_valores[] = $this->propPublica;
        $this->_claves[] = "oi__propPrivada";
        $this->_valores[] = $this->_propPrivada;

        $this->_posicion = 0;
    }

    public function valid(): bool
    {
        return $this->_posicion < count($this->_claves);
    }

    public function current(): mixed
    {
        return $this->_valores[$this->_posicion];
    }

    public function key(): mixed
    {
        return $this->_claves[$this->_posicion];
    }

    public function next(): void
    {
        $this->_posicion++;
    }
}