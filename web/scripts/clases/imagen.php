<?php
include_once(dirname(__FILE__) . "/../../scripts/datos/puntos.php");

$puntos = damePuntos();
$img = ImagenPuntos::dibujar($puntos);

header("Content-Type: image/jpeg");
header("Content-Disposition: attachment; filename=\"imagen_" . ImagenPuntos::nombreFichero() . ".jpg\"");
imagejpeg($img, null, 90);
imagedestroy($img);
exit;