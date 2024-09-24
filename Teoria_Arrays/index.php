<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de arrays</title>
</head>

<body>
    <?php
    /*
            Hay dos tipos de array:
                Escalar: se accede a la posición por un número
                Asociativo: se accede a la posición por una key
            Ambos se usan muchísimo.

            Formas de declarar un array escalar
        */
    $nota[0] = 5;
    $nota[1] = 9;
    $nota[2] = 8;
    $nota[3] = 5;
    $nota[4] = 6;
    $nota[5] = 7;

    var_dump($nota);
    echo "<br>";
    //con print_r
    print_r($nota);

    //otra forma de crear el array
    $nota[] = 5;
    $nota[] = 9;
    $nota[] = 8;
    $nota[] = 5;
    $nota[] = 6;
    $nota[] = 7;
    //estos valores se irán añadiendo en orden
    //al primer índice escalar que está libre

    echo "<br>";
    print_r($nota);
    //si hubiesemos empezado con esto
    //$nota [13] = 5;
    //el resto de posiciones se quedan sin utilizar reservadas
    //y las siguientes seguirian el orden


    //el array se podrá recorrer con un bucle for
    //pero para ello necesitamos saber el tamaño del array
    //para ello usaríamos .count
    echo "<p>El número de elementos que tiene el array de notas es: " . count($nota) . "</p>";
    echo "<h2>Elementos del array notas</h2>";
    echo "<ol>";
    for ($i = 0; $i < count($nota); $i++) {
        echo "<li>" . $nota[$i] . "</li>";
    }
    echo "</ol>";

    //otra forma de hacer lo mismo sería:
    $nota1 = array(5, 9, 8, 5, 6, 7);

    echo "<p>El número de elementos que tiene el array de notas1 es: " . count($nota1) . "</p>";
    echo "<h2>Elementos del array notas2</h2>";
    echo "<ol>";
    //el bucle for solo sería posible si el array es escalar
    //y va seguido sino hay que usar si o si un foreach
    for ($i = 0; $i < count($nota1); $i++) {
        echo "<li>" . $nota1[$i] . "</li>";
    }
    echo "</ol>";

    //¿cómo recorremos entonces uno que no tiene las posiciones en orden?
    $nota3[] = 5;
    $nota3["Juan"] = 9;
    $nota3[25] = 8;
    $nota3[16] = 5;
    $nota3[13] = 6;
    $nota3[33] = 7;

    //cuando tengamos un array asociativo es mejor usar un bucle foreach
    echo "<h2>Elementos del array notas3</h2>";
    echo "<ul>";
    //para mostrar el índice usamos $key =>$valor
    foreach ($nota3 as $key => $valor) {
        echo "<li>Clave: " . $key . " - Valor: " . $valor . "</li>";
    }
    echo "</ul>";
    $nota3 = array(0 => 5, "Juan" => 9, 25 => 8, 16 => 5, 13 => 6, 33 => 7);
    echo "<h2>Elementos del array notas3</h2>";
    echo "<ul>";
    //para mostrar el índice usamos $key =>$valor
    foreach ($nota3 as $key => $valor) {
        echo "<li>Clave: " . $key . " - Valor: " . $valor . "</li>";
    }
    echo "</ul>";

    //arrays multidimensionales
    $notas4["Dani"]["DWESE"] = 7;
    $notas4["Dani"]["DWECL"] = 6;
    $notas4["Tomas"]["DWESE"] = 3;
    $notas4["Tomas"]["DWECL"] = 9;
    $notas4["Clara"]["DWESE"] = 5.5;
    $notas4["Clara"]["DWECL"] = 6.5;

    echo "<h2>Notas de los alumnos de 2ºDAW</h2>";
    echo "<ol>";
    foreach ($notas4 as $alumno => $asignaturas) {
        echo "<li>".$alumno;
        echo "<ul>";
        foreach ($asignaturas as $asignatura => $nota) {
            echo "<li>".$asignatura." : ".$nota."</li>";;
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ol>";



    ?>
</body>

</html>