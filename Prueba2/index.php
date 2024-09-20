<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba con elementos php</title>
</head>

<body>
    <!-- A continuación agregamos donde irá el código php que se tiene que indicar
 con la etiqueta < ?php ?> y seguido de la sentencia echo "" terminado con ;-->
    <?php
    $texto1 = "Juan";
    $texto2 = "María";
    $a = 8;
    $b = 10;
    echo "<h1>Mi primera web PHP</h1>";
    echo "<p>" . $texto1 . " y " . $texto2 . "</p>";
    echo "<p>El resultado de sumar " . $a . " + " . $b . " es: " . ($a + $b) . "</p>";
    /*Se puede usar una variable aunque no esté inicializada
        como resultado saldría un warning al cargar la web */
    //isset($p); usamos isset como condición
    /*ejemplo de if */
    /*    if(isset($p) && 5==5 || 7>=8){
                $c=$p+$a;
            }else{
                $c=$a;
            }*/
    /* ejemplo de switch */
    /* switch($a){
                case $a>1:

                    break;
                case $a<2:
                    break;
                default:;
            }
            
            echo"<p>".$c."</p>";*/
    //cuando solo ponemos una sentencia no es necesario poner llaves
    if ($a + $b > 10) {
        echo "<p>La suma de a + b es mayor que 10</p>";
    } else
        echo "<p>La suma de a + b no es mayor que 10</p>";

    //sentencias repetitivas
    for ($i = 0; $i < 5; $i++) {
        echo "<p>" . $i . "</p>";
    }
    //podemos usar la variable después del bucle, cosa que con java no se podía
    echo "<p>Después del bucle for la i vale: " . $i . "</p>";
    //ejemplo de repetición con un bucle while
    //tenemos inicializar primero la variable
    $i = 0;
    while ($i < 5) {
        echo "<p>" . $i . "</p>";
        $i++;
    }



    ?>
    <!-- En PHP no hace falta declarar una variable, para ponerla hay que usar siempre $
     para concatenar se usa el operador punto(.)-->
</body>

</html>