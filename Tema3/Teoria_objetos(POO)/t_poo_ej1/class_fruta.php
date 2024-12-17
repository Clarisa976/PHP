<?php

//para crear una clase usaremos la palabra class más el nombre en mayúscula
class Fruta{
    private $color;
    private $tamanio;
    //se podría poner también: private $color,$tamanio;

    //setters y getters
    public function setColor($color_nuevo){
        $this->color=$color_nuevo;
    }
    public function setTamanio($tamanio_nuevo){
        $this->tamanio=$tamanio_nuevo;
    }
    public function getColor(){
        return $this->color;
    }
    public function getTamanio(){
        return $this->tamanio;
    }

}

?>