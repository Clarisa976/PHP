<?php

    $primera_palabra = strtoupper($primera); //quitamos mayúsculas
    $segunda_palabra = strtoupper($segunda);

    //por defecto siempre estará mal
    $respuesta = "no riman";
    $clase = "rojito"; //cambiamos a la clase rojito

   
    if ( $primera_palabra[$letra_primera_palabra - 1] == $segunda_palabra[$letra_segunda_palabra - 1] &&
        $primera_palabra[$letra_primera_palabra - 2] == $segunda_palabra[$letra_segunda_palabra - 2]) {
        $respuesta = "riman un poco";
        $clase = "verde"; //cambiamos a la clase a verde
    }
    if ($primera_palabra[$letra_primera_palabra - 3] == $segunda_palabra[$letra_segunda_palabra - 3]) {
            $respuesta = "riman";
        }
   


    echo "<div class='formulario respuesta $clase' >";
    echo "<h2 class='centro'>Ripios - Respuesta</h2>";
    echo "<p>Las palabras <strong>$primera </strong> y <strong>$segunda </strong>$respuesta</p>";
    echo "</div>";

?>

