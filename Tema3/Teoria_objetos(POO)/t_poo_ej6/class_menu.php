<?php

//para crear una clase usaremos la palabra class más el nombre en mayúscula
class Menu
{
    private $enlaces = array();

    public function cargar($url,$nombre){
        $this->enlaces[$nombre]=$url;
    }
    public function vertical(){
        echo "<p>";
        foreach ($this->enlaces as $nombre => $url) {
           echo "<a href='.$url.'>".$nombre."</a><br>";
        }
        echo "</p>";
    }
    public function horizontal(){
        $imprimir="";
        
        foreach ($this->enlaces as $nombre => $url) {
           $imprimir.= "<a href='.$url.'>".$nombre."</a> - ";
        }
        
        echo "<p>".substr($imprimir,0,-2)."</p>";
    }
}
