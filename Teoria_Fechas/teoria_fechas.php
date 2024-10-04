<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de fechas en PHP</title>
</head>
<body>

<h1>Teoría de fechas</h1>
    <?php
        //la función fundamental para trabajar con fechas en PHP se llama time()
        //te da los segundos que han pasado desde 1970
        echo "<p>".time()."</p>";
        //y  -> es año corto mientras que Y son los cuatro dígitos
        //da lo mismo poner / que -
        //para poner la fecha actual ponemos la funcion time
        $fecha = date("d/m/Y H:i:s",time());
        echo $fecha;
        //el date si no le pasamos segundo argumento coge por defecto el time
        $fecha2 = date("d/m/Y H:i:s");
        echo "<p>". $fecha2. "</p>";


        //hay una función que te indica si una fecha es válida o no
        //la función se llama checkdate(mes,dia,año)
        if (checkdate(2,29,2005)) {
            echo "<p>la fecha existe</p>";
        }else{
            echo "<p>la fecha no existe</p>";
        }

        //otra función que usaremos es mktime(hora, minuto,segundo,mes,dia,año)
        //para saber cuantos segundos pasan desde una fecha 
        echo "<p>".mktime(0,0,0,4,21,2011)."</p>";
        $fecha3 = date("d/m/Y",1303336800);
        echo $fecha3;
        //otra funcion que hace lo mismo pero se usa más es
        //strtotime("m/d/a") o strtotime("a/m/d")
        echo "<p>".strtotime("2011/04/21")."</p>";
        echo "<p>".date("d/m/Y",1303336800)."</p>";
        
        //funciones para calcular fechas
        echo "<p>".abs(-8)."</p>";//valor absoluto
        echo "<p>".floor(9.67)."</p>";//redondea hacia abajo
        echo "<p>".ceil(9.67)."</p>";//redondea hacia abajo
    ?>
</body>
</html>