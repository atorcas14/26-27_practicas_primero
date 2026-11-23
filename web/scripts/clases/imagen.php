<?php
include_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

$img = Punto::dibujar(Punto::cargar());

header("Content-Type: image/jpeg");
header("Content-Disposition: attachment; filename=\"imagen_" . Punto::nombreArchivo() . ".jpg\"");
imagejpeg($img, null, 90);
imagedestroy($img);
exit;