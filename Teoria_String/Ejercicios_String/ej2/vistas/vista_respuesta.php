<?php
        if(isset($_POST["comparar"]) && !$error_form){
        $texto_introducido = strtoupper($texto);

        $es_capicua = true; 
            $i=0;
            $j=$longitud_texto-1;
            while ($i < $j) {
               if ($texto_introducido[$i]!=$texto_introducido[$j]) {
                $es_capicua = false;
                break;
               }
               $i++;
               $j--;
            }

        /*for ($i = 0; $i < $longitud_texto / 2; $i++) {
            if ($texto_introducido[$i] != $texto_introducido[$longitud_texto - $i - 1]) {
            $es_capicua = false;
            break;
            }*/
        

        $resultado = "";
        if (todo_letras($texto) && $es_capicua) {
            $resultado = "<p>$texto es un palíndromo</p>";
        } else if (todo_letras($texto) && !$es_capicua) {
            $resultado = "<p>$texto no es un palíndromo</p>";
        } else if (todo_numeros($texto) && $es_capicua) {
            $resultado = "<p>$texto es capicúa</p>";
        } else {
            $resultado = "<p>$texto no es capicúa</p>";
        }

        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Palíndromos / Capicúas - Resultados</h2>";
        echo "<p>  $resultado </p>";
        echo "</div>";
    

       
        }
    ?>
