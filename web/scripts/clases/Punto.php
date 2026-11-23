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
        if (!\VALNORMAL\validaEntero($v, 0, 20000, 0)) return false;
        $this->x = $v;
        return true;
    }

    public function setY(mixed $y): bool
    {
        $v = $y;
        if (!\VALNORMAL\validaEntero($v, 0, 20000, 0)) return false;
        $this->y = $v;
        return true;
    }

    public function setColor(string $color): bool
    {
        if (!\VALNORMAL\validaRango($color, self::COLORES, 2)) return false;   // clave de COLORES
        $this->color = $color;
        return true;
    }

    public function setGrosor(mixed $grosor): bool
    {
        $v = $grosor;
        if (!\VALNORMAL\validaEntero($v, 1, 3, 1)) return false;
        $this->grosor = $v;
        return true;
    }
    
    public static function nombreArchivo(): string
    {
        $ip = preg_replace('/[^0-9a-zA-Z]/', '_', $_SERVER["REMOTE_ADDR"] ?? "0.0.0.0");
        $ua = $_SERVER["HTTP_USER_AGENT"] ?? "";
        if (stripos($ua, "Edg") !== false)         $nav = "edge";
        elseif (stripos($ua, "OPR") !== false)     $nav = "opera";
        elseif (stripos($ua, "Firefox") !== false) $nav = "firefox";
        elseif (stripos($ua, "Chrome") !== false)  $nav = "chrome";
        elseif (stripos($ua, "Safari") !== false)  $nav = "safari";
        else                                       $nav = "otro";
        return $ip . "_" . $nav;
    }

    public static function rutaDat(): string
    {
        return dirname(__FILE__) . "/../../puntos_" . self::nombreArchivo() . ".dat";
    }

    public static function rutaImagen(): string
    {
        return dirname(__FILE__) . "/../../imagenes/puntos/imagen_" . self::nombreArchivo() . ".jpg";
    }

    public static function urlImagen(): string
    {
        return "/imagenes/puntos/imagen_" . self::nombreArchivo() . ".jpg";
    }

    // ---------- Fichero ----------
    public function aLinea(): string
    {
        return $this->x . " ; " . $this->y . " ; " . $this->color . " ; " . $this->grosor;
    }

    // "x ; y ; color ; grosor" -> Punto, o null si no cumple las condiciones (0-500)
    public static function desdeLinea(string $linea): ?Punto
    {
        $p = array_map("trim", explode(";", $linea));
        if (count($p) !== 4) return null;
        [$x, $y, $color, $grosor] = $p;
        if (!ctype_digit($x) || !ctype_digit($y) || !ctype_digit($grosor)) return null;
        if ((int)$x > 500 || (int)$y > 500) return null;
        try {
            return new Punto((int)$x, (int)$y, $color, (int)$grosor);
        } catch (Throwable $e) {
            return null;
        }
    }
    

    public static function cargar(): array
    {
        $puntos = [];
        if (is_file(self::rutaDat())) {
            foreach (file(self::rutaDat(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $l) {
                $p = self::desdeLinea($l);
                if ($p !== null) $puntos[] = $p;
            }
        }
        return $puntos;
    }

    public static function guardar(array $puntos): bool
    {
        $lineas = array_map(fn($p) => $p->aLinea(), $puntos);
        $texto = $lineas ? implode("\n", $lineas) . "\n" : "";
        return file_put_contents(self::rutaDat(), $texto, LOCK_EX) !== false;
    }

    // ---------- Imagen (GD) ----------
    public static function dibujar(array $puntos)
    {
        $img = imagecreatetruecolor(500, 500);
        $blanco = imagecolorallocate($img, 255, 255, 255);
        $negro = imagecolorallocate($img, 0, 0, 0);
        imagefilledrectangle($img, 0, 0, 499, 499, $blanco);
        imagerectangle($img, 0, 0, 499, 499, $negro);
        foreach ($puntos as $p) {
            [$r, $b, $g] = self::COLORES[$p->getColor()]["rgb"];   // orden del enunciado: rojo, azul, verde
            $c = imagecolorallocate($img, $r, $g, $b);
            $d = $p->getGrosor() * 6;
            imagefilledellipse($img, $p->getX(), $p->getY(), $d, $d, $c);
        }
        return $img;
    }

    // Recrea el JPG (se llama solo al añadir/borrar un punto o si no existe)
    public static function guardarImagen(array $puntos): bool
    {
        $carpeta = dirname(self::rutaImagen());
        if (!is_dir($carpeta) && !mkdir($carpeta, 0775, true)) return false;
        $img = self::dibujar($puntos);
        $ok = imagejpeg($img, self::rutaImagen(), 90);
        imagedestroy($img);
        return $ok;
    }
}