<?php
        if(isset($_POST["comparar"]) && !$error_form){
            $numeros_romanos = array(
                "I"=>1,
                "VI"=>4,
                "V"=>5,
                "IX"=>9,
                "X"=>10,
                "XL"=>40,
                "L"=>50,
                "XC"=>90,
                "C"=>100,
                "CD"=>400,
                "D"=>500,
                "CM"=>900,
                "M"=>1000

            );
        

        echo "<div class='respuesta' >";
        echo "<h2 class='centro'>Romanos a árabes - Resultados</h2>";
        echo "<p> el número $tetxo_introducido se escribe en cifras árabes como $resultado . </p>";
        echo "</div>";
    

       
        }
    ?>
