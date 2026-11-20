<?php
include_once(dirname(__FILE__) . "../../librerias/val_normal.php");

final class Punto
{
    // nombre_inglés => [nombre español, [rojo, verde, azul]]
    const COLORES = [
        "black"  => ["nombre" => "negro",    "rgb" => [0, 0, 0]],
        "red"    => ["nombre" => "rojo",     "rgb" => [255, 0, 0]],
        "green"  => ["nombre" => "verde",    "rgb" => [0, 255, 0]],
        "blue"   => ["nombre" => "azul",     "rgb" => [0, 0, 255]],
        "yellow" => ["nombre" => "amarillo", "rgb" => [255, 255, 0]],
    ];

    const GROSORES = [1 => "fino", 2 => "medio", 3 => "grueso"];

    private int $x = 0;
    private int $y = 0;
    private string $color = "black";
    private int $grosor = 1;

    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if (!$this->setX($x) || !$this->setY($y) || !$this->setColor($color) || !$this->setGrosor($grosor)) {
            throw new InvalidArgumentException("Los datos del punto no son válidos");
        }
    }

    // Sin propiedades dinámicas
    public function __set(string $nombre, mixed $valor): void
    {
        throw new Error("No se pueden crear propiedades dinámicas: $nombre");
    }

    public function __get(string $nombre): mixed
    {
        throw new Error("Propiedad inaccesible o inexistente: $nombre");
    }

    public function getX(): int { return $this->x; }
    public function getY(): int { return $this->y; }
    public function getColor(): string { return $this->color; }
    public function getGrosor(): int { return $this->grosor; }

    public function setX(mixed $x): bool
    {
        $v = $x;
        if (!validaEntero($v, 0, 20000, 0)) return false;
        $this->x = $v;
        return true;
    }

    public function setY(mixed $y): bool
    {
        $v = $y;
        if (!validaEntero($v, 0, 20000, 0)) return false;
        $this->y = $v;
        return true;
    }

    public function setColor(string $color): bool
    {
        if (!validaRango($color, self::COLORES, 2)) return false;   // clave de COLORES
        $this->color = $color;
        return true;
    }

    public function setGrosor(mixed $grosor): bool
    {
        $v = $grosor;
        if (!validaEntero($v, 1, 3, 1)) return false;
        $this->grosor = $v;
        return true;
    }
}