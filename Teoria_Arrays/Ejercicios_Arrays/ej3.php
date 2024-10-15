<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <?php

    $peliculasVistas["Enero"]=9;
    $peliculasVistas["Febrero"]=12;
    $peliculasVistas["Marzo"]=0;
    $peliculasVistas["Abril"]=17;


    echo"<h1>Número de películas vista en cada mes</h1>";
    echo"<ul>";
    
    foreach ($peliculasVistas as $mes => $n_peliculas) {
        if($n_peliculas>0){
            echo"<li>".$mes.":".$n_peliculas."</li>";
        }
    }
    
    echo"</ul>"
    ?>
</body>
</html>