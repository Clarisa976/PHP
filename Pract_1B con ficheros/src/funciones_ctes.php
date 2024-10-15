<?php
    function LetraNIF($dni){
        return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
    }
    function dni_bien_escrito($texto){
        $dni=strtoupper($texto);
        return strlen($dni)==9 
        && is_numeric(substr($dni,0,8))&& substr($dni,-1)>="A"&& substr($dni,-1)<="Z";
    }
    
    function dni_valido($texto){
        $dni=strtoupper($texto);
        //si lo que devuelve es igual a lo último esta bién
        return LetraNIF(substr($dni,0,8))==substr($dni,-1);
     /*   $valido = true;
        $numeroDNI = "";
        if (strlen($dni) != 9) { //comprobamos que solo sea de tamaño 9
            $valido = false;
        } else {
            //comprobamos que sean solo números
            for ($i = 0; $i < strlen($dni) - 1; $i++) {
                if (!is_numeric($dni[$i])) {
                    $valido = false;
                    break;
                }
                $numeroDNI .= $dni[$i];
            }
            //comprobamos la letra con la función anterior
            if (LetraNIF($numeroDNI) != strtoupper($dni[strlen($dni) - 1])) {
                $valido = false;
            }
        }
        return $valido;*/
    }
    
    
    function tiene_extension($texto)
    {
        $array_nombre = explode(".", $texto);
        if (count($array_nombre) <= 1) { //si no tiene extensión devuelve falso
            $respuesta = false;
        } else {
            $respuesta = end($array_nombre);
        }
        return $respuesta;
    }
    
?>