<?php
Class SerieFibonacci implements Iterator{
    //Variables
    private int $_limite;
    private int $_claveActual=0;

    /**
     * Constructor
     *
     * @param integer $limite
     */
    public function __construct(int $limite)
    {
        $this->_limite=$limite;
    }

    /**
     * Funcion que permite calcular con una formula alternativa
     *
     * @param integer $n
     * @return integer
     */
    private static function calcular(int $n):int{
        $raiz5 = sqrt(5);
        $phi = (1 + $raiz5) / 2;
        $psi = (1 - $raiz5) / 2;

        $resultado = (1 / $raiz5) * pow($phi, $n) - (1 / $raiz5) * pow($psi, $n);

        return (int) round($resultado);
    }

    // ---- Iterator ----
    public function rewind(): void
    {
        $this->_claveActual = 0;
    }

    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }

    public function current(): int
    {
        return self::calcular($this->_claveActual);
    }

    public function key(): int
    {
        return $this->_claveActual;
    }

    public function next(): void
    {
        $this->_claveActual++;
    }

    // ---- Generador estático ----
    public static function fFibonacci(int $ultimo): Generator
    {
        $anterior = 0;
        $actual = 1;

        for ($i = 0; $i <= $ultimo; $i++) {
            yield $i => $anterior;               // clave => valor
            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }
    }
}