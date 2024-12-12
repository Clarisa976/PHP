<?php

//para crear una clase usaremos la palabra class más el nombre en mayúscula
class Fruta
{
    private $color,$tamanio;
    private static $n_frutas = 0;
    //constructor
    public function __construct($color_nuevo, $tamanio_nuevo)
    {
        $this->color = $color_nuevo;
        $this->tamanio = $tamanio_nuevo;
        //para llamar a métodos estáticos se usara self::
        self::$n_frutas++;
    }

    public function __destruct(){
        self::$n_frutas--;
    }
    public static function cuantaFruta(){
        return self::$n_frutas;
    }

    //setters y getters
    public function setColor($color_nuevo)
    {
        $this->color = $color_nuevo;
    }
    public function setTamanio($tamanio_nuevo)
    {
        $this->tamanio = $tamanio_nuevo;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getTamanio()
    {
        return $this->tamanio;
    }

    //método para imprimir
    public function imprimir()
    {
        echo "<h2>Informacion de mi fruta</h2>";
        echo "<p><strong>Color: </strong>" . $this->color . "<br>";

        echo "<strong>Tamaño: </strong>" . $this->tamanio . "</p>";
    }
}
