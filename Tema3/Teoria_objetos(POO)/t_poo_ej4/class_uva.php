<?php
require "class_fruta.php";
class Uva extends Fruta{
    //atributos
    private $tieneSemilla;
    //constructor
    public function __construct($color_nuevo,$tamanio_nuevo,$tiene){
        //aquí se usara parent:: en lugar de super
        parent::__construct($color_nuevo,$tamanio_nuevo);
        $this->tieneSemilla=$tiene;
    }
    //getter
    public function tieneSemilla(){
        return $this->tieneSemilla;
    }
    public function imprimir()
    {
        //se puede poner parent o this
        echo "<p><strong>Color: </strong>" . $this->getColor() . "<br>";

        echo "<strong>Tamaño: </strong>" . parent::getTamanio() . "</p>";
    }
}
?>