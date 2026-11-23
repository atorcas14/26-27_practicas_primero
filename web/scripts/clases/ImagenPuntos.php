<?php
class ImagenPuntos
{
    const ANCHO = 500;
    const ALTO = 500;
    const CARPETA = "/imagenes/puntos/";

    // Nombre tipo: imagen_192_168_2_101_chrome.jpg
    public static function nombreFichero(): string
    {
        $ip = $_SERVER["REMOTE_ADDR"] ?? "0.0.0.0";
        $ip = preg_replace('/[^0-9a-zA-Z]/', '_', $ip);       
        $ua = $_SERVER["HTTP_USER_AGENT"] ?? "";
        // Edge y Opera llevan también "Chrome" en el agente, por eso van primero
        if (stripos($ua, "Edg") !== false)          $nav = "edge";
        elseif (stripos($ua, "OPR") !== false)      $nav = "opera";
        elseif (stripos($ua, "Firefox") !== false)  $nav = "firefox";
        elseif (stripos($ua, "Chrome") !== false)   $nav = "chrome";
        elseif (stripos($ua, "Safari") !== false)   $nav = "safari";
        else                                        $nav = "otro";

        return "imagen_" . $ip . "_" . $nav . ".jpg";
    }

    // Ruta física del fichero (en disco)
    public static function rutaFisica(): string
    {
        return dirname(__FILE__) . "/../.." . self::CARPETA . self::nombreFichero();
    }

    // Ruta web (para el src del img)
    public static function rutaWeb(): string
    {
        return self::CARPETA . self::nombreFichero();
    }

    //Metodo para dibujar 
    public static function dibujar (array $puntos){
        $img = imagecreatetruecolor(self::ANCHO,self::ALTO);
        $blanco = imagecolorallocate($img,255,255,255);
        $negro = imagecolorallocate($img,0,0,0);
        imagefilledrectangle($img,0,0,self::ANCHO-1,self::ALTO-1,$blanco);
        imagerectangle($img,0,0,self::ANCHO-1,self::ALTO-1,$negro);

        foreach($puntos as $p){
            [$r,$g,$b] = Punto::COLORES[$p->getColor()]["rgb"];
            $color = imagecolorallocate($img,$r,$g,$b);
            $radio = $p->getGrosor() * 3;
            imagefilledellipse($img, $p->getX(),$p->getY(),$radio*2, $radio*2,$color);
        }
        return $img;
    }

    // Huella de los puntos: cambia si se añade, borra o modifica alguno
    private static function huella(array $puntos): string
    {
        $partes = [];
        foreach ($puntos as $p) {
            $partes[] = $p->getX() . "," . $p->getY() . "," . $p->getColor() . "," . $p->getGrosor();
        }
        return md5(implode("|", $partes));
    }

    // Crea la imagen solo si no existe o si los puntos han cambiado
    public static function asegurar(array $puntos): bool
    {
        $ruta = self::rutaFisica();
        $marca = $ruta . ".hash";          // guarda la huella de la última imagen generada
        $huella = self::huella($puntos);

        if (is_file($ruta) && is_file($marca) && trim((string)file_get_contents($marca)) === $huella) {
            return true;                    
        }
        $carpeta = dirname($ruta);
        if(!is_dir($carpeta)&&!mkdir($carpeta,0775,true)){
            return false;
        }
        $img = self::dibujar($puntos);
        $ok = imagejpeg($img,$ruta,90);
        // imagedestroy($img);
        if ($ok) {
            file_put_contents($marca, $huella);
        }
        return $ok;
    }

    private static function generar(array $puntos, string $ruta): bool
    {
        $carpeta = dirname($ruta);
        if (!is_dir($carpeta) && !mkdir($carpeta, 0775, true)) {
            return false;
        }

        $img = imagecreatetruecolor(self::ANCHO, self::ALTO);
        $blanco = imagecolorallocate($img, 255, 255, 255);
        $negro = imagecolorallocate($img, 0, 0, 0);
        imagefilledrectangle($img, 0, 0, self::ANCHO - 1, self::ALTO - 1, $blanco);   // fondo blanco
        imagerectangle($img, 0, 0, self::ANCHO - 1, self::ALTO - 1, $negro);          // marco

        foreach ($puntos as $p) {
            [$r, $g, $b] = Punto::COLORES[$p->getColor()]["rgb"];
            $color = imagecolorallocate($img, $r, $g, $b);
            $radio = $p->getGrosor() * 3;                                             // 3, 6 o 9 px
            imagefilledellipse($img, $p->getX(), $p->getY(), $radio * 2, $radio * 2, $color);
        }

        $ok = imagejpeg($img, $ruta, 90);
        imagedestroy($img);
        return $ok;
    }
}