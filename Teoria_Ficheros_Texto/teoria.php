<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de ficheros de texto</title>
</head>
<body>
    <!--
        La mayoría de las funciones de fichero de texto empiezan por f de file
    -->
    <?php
        //para abrir un fichero usamos la función fopen
        //le pasamos la ruta y el modo de escritura
        //r para leer w para escribir
        //usamos el @ para eviar warning
        /*@$file=fopen("prueba.txt","w");
       if ($file) {
            echo "<p>Fichero abierto con éxito</p>";
        }else{
            echo "<p>No se ha podido abir el fichero</p>";
        }
        //fclose para cerrar el fichero abierto
        fclose($file);*/
        //si existe un fichero con w lo borramos y sino lo crea
        @$file=fopen("prueba.txt","r");
        if (!$file) {
            die("<p>No se ha podido abir el fichero</p>");
        }
        while (!feof($file)) {//mientras no sea el final del fichero
            $linea=fgets($file);
            echo "<p>".$linea."</p>";
        }
        echo "<h2>Fin del fichero</h2>";
        /*//lee las líneas del fichero una a una 
        $linea=fgets($file);
        echo "<p>".$linea."</p>";
        $linea=fgets($file);
        echo "<p>".$linea."</p>";
        $linea=fgets($file);
        echo "<p>".$linea."</p>";*/

        //para ir al principio de un fichero que no hemos cerrado
        fseek($file,0);
        //otra forma de de recorrer el fichero sería usando:
            echo "<h2>Volvemos a recorrer el fichero</h2>";
            while ($linea=fgets($file)) {//mientras esta asignacion se haga
                echo "<p>".$linea."</p>";
            }
            echo "<h2>Fin del fichero</h2>";
        //fclose para cerrar el fichero abierto
        fclose($file);


        //añadimos una línea
        @$file=fopen("prueba.txt", "a");
        if (!$file) {
            die("<p>No se ha podido abir el fichero</p>");
        }
        //escribimos con:
        fputs($file,PHP_EOL."cuarta línea");//para añadirle salto de línea usamos PHP_EOL.
        fwrite($file,PHP_EOL."quinta línea");//también se puede usar fwrite para escribir

        fclose($file);

        /*para leer el fichero completo, no línea a línea usaremos file_get_contents*/
        echo "<h2>Lectura entera de un fichero</h2>";
        $todo=file_get_contents("prueba.txt");//esto para leer
        echo "<pre>".$todo."</pre>";//lo mostramos
        echo nl2br($todo);//nl2br le añade br

        //si le ponemos la ruta de una web en lugar del fichero funciona
        echo "<h3>Lectura de una web</h3>";
        $web=file_get_contents("https://www.google.es");
        echo $web;
        //para saber si un fichero existe usamos file_exists()

    ?>
</body>
</html>