<?php

if (isset($_POST["comparar"]) && !$error_form)
    $array = array(
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u',
        'à' => 'a',
        'è' => 'e',
        'ì' => 'i',
        'ò' => 'o',
        'ù' => 'u',
        'ä' => 'a',
        'ë' => 'e',
        'ï' => 'i',
        'ö' => 'o',
        'ü' => 'u',
        'Á' => 'A',
        'É' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ú' => 'U',
        'À' => 'A',
        'È' => 'E',
        'Ì' => 'I',
        'Ò' => 'O',
        'Ù' => 'U',
        'Ä' => 'A',
        'Ë' => 'E',
        'Ï' => 'I',
        'Ö' => 'O',
        'Ü' => 'U'
    );
$respuesta = strtr($texto, $array);
$clase = "verde"; //cambiamos a la clase a verde




echo "<div class='formulario respuesta $clase' >";
echo "<h2 class='centro'>Quita acentos - Resultado</h2>";
echo "<p>Texto original <br>$texto </p>";
echo "<p>Texto sin acentos <br>$respuesta</p>";
echo "</div>";
