<?php
        if(isset($_POST["comparar"]) && !$error_form){

        $es_capicua = true;
        for ($i = 0; $i < $longitud_texto / 2; $i++) {
            if ($texto_introducido[$i] != $texto_introducido[$longitud_texto - $i - 1]) {
            $es_capicua = false;
            break;
            }
        }

        $resultado = "";
        if ($es_capicua) {
            $resultado = "<p>$texto es una frase palíndromo</p>";
        } else {
            $resultado = "<p>$texto NO es una frase palíndromo</p>";
        } 

        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Frases palíndromas - Resultados</h2>";
        echo "<p> . $resultado .</p>";
        echo "</div>";
    

       
        }
    ?>
