<?php


/**
 * clases dinamica
 * 
 * - Si la propiedad empieza por m o M la doy por buena
 * - Una propiedad sobrecargada siempre tendra el valor 234
 * 
 */
Class ClaseDinamica
{
 //variable privada para mantener las propiedades
 //creadas de formadinámica
 private array $_datos=array();
 //variable pública, se accede directamente a ella
 public int $varPublica=10;
 //se llamará de forma automática cuando se lea
 //una propiedad y no sea visible.
 public function __get(string $nombre)
 {
 if(isset($this->_datos[$nombre]))
 return $this->_datos[$nombre];
 else
 //si no existe lanza una excepción
 throw new Exception('No existe la propiedad.');
 }
 //se llamará de forma automática cuando se escriba
 //una propiedad y no sea visible
 public function __set(string $nombre,mixed $valor)
 {
 //puede filtrar que propiedades están o no disponibles
 //no permito propiedades cuyo nombre tenga una
 //longitud de mas de 10 caracteres
 if (mb_strlen($nombre)>10)
 throw new Exception('No existe la propiedad.');
 //creo/actualizo la variable dinámica.
 $this->_datos[$nombre]=$valor;
 }
 //se llamará automáticamente al ejecutar isset o
 //empty
 public function __isset(string $nombre):bool
 {
 return(isset($this->_datos[$nombre]));
 }
//se llamará automáticamente al ejecutar
//unset
 public function __unset(string $nombre)
 {
 unset($this->_datos[$nombre]);
 }
}
$obj=new ClaseDinamica();
//se accede directamente a la propiedad al ser publica.
$obj->varPublica=12;
echo $obj->varPublica;
//la propiedad nueva no está definida en la clase.
//se llama automáticamente a __set
$obj->nueva=10;
//la propiedad nueva no está definida en la clase.
//se llama automáticamente a __get
echo $obj->nueva;
//se comprueba si existe la propiedad nueva.
//como no es visible se llama de forma automática
//a __isset
if (isset($obj->nueva))
 echo "la propiedad nueva existe";
//se elimina la propiedad nueva
unset($this->nueva);
//accede a una propiedad que no se ha inicializado antes
//se lanza una excepcion.
echo $obj->noexiste;
