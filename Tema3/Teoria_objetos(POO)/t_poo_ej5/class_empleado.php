<?php

//para crear una clase usaremos la palabra class más el nombre en mayúscula
class Empleado
{
    private $nombre, $sueldo;
    //constructor
    public function __construct($nombre_nuevo, $sueldo_nuevo)
    {
        $this->nombre = $nombre_nuevo;
        $this->sueldo = $sueldo_nuevo;
    }



    //setters y getters
    public function setNombre($nombre_nuevo)
    {
        $this->nombre = $nombre_nuevo;
    }
    public function setSueldo($sueldo_nuevo)
    {
        $this->sueldo = $sueldo_nuevo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getSueldo()
    {
        return $this->sueldo;
    }

    //método para imprimir
    public function imprimir()
    {
        echo "<h2>Información de mis empleados creados</h2>";
        echo "<p><strong>Nombre: </strong>" . $this->nombre . "<br>";

        echo "<strong>Sueldo: </strong>" . $this->sueldo . "</p>";
    }
    public function impuestos()
    {
        echo "<p>El empleado <strong>" . $this->nombre . "</strong>";
        if ($this->sueldo >= 3000) {
            echo " con sueldo <strong>" . $this->sueldo . "</strong> tiene que pagar impuestos</p>";
        } else {
            echo " con sueldo <strong>" . $this->sueldo . "</strong> no tiene que pagar impuestos</p>";
        }
    }
}
