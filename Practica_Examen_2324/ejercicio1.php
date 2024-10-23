<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 </title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio1.php" method="post">
        <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
        <button type="submit" name="btnGenerar">Generar</button>
    </form>
    <?php
    if (isset($_POST["btnGenerar"])) {
        //abrimos el fichero
        @$fd = fopen("claves_cesar.txt", "w");
        if (!$fd) {
            die("Hubo problemas para generar el fichero");
        } else {
            //escribimos el fichero
            //la primera línea
            $linea = "Letra/Desplazamiento";
            for ($i = 1; $i <= 26; $i++) {
                $linea .= ";" . $i;
            }
            fwrite($fd, $linea . PHP_EOL);

            //siguientes líneas comenzando con la A(65)Z(90)
            for ($i = 65; $i <= 90; $i++) {
                $linea = chr($i);
                for ($j = 0; $j < 26; $j++) {
                    $linea .= ";" .chr(65 + (($i - 65 + $j + 1) % 26));//usamos %26  para que cuando llegue a la z volvamos a la a    
                }
                fwrite($fd, $linea . PHP_EOL);
            }
            
           $contenido = file_get_contents("claves_cesar.txt");

            echo "<h2>Respuesta</h2>";
            echo "<textarea name='txtGenerado' id='txtGenerado' rows='30' cols='100'>".$contenido."</textarea>"; 
            echo "<p>Fichero generado con éxito</p>";
            fclose($fd); //cerramos el fichero
        }
    }
    ?>
</body>

</html>