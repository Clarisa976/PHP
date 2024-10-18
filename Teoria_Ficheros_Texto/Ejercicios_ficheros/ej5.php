<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de fichero - Ejercicio 5</title>
    <style>
        .error {
            color: red;
        }

        th {
            font-weight: bolder;
        }

        table,
        td,
        th {
            border: 1px solid black;            
        }
        td{padding: 3px;}
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>
    
        <h1>Ejercicio 5</h1>

        <?php
        echo "<table>";
        echo "<caption>PIB de los países de la UE</caption>";
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

        if (!$file) {
            die("<p> No se ha podido abrir el fichero</p>");
        } else {

            $linea = fgets($file);
            $datos_linea_fichero = explode("\t", $linea);
            $columnas = count($datos_linea_fichero);
            echo "<tr>";
            for ($i = 0; $i < $columnas; $i++) {
                echo "<th>$datos_linea_fichero[$i]</th>";
            }
            echo "</tr>";

            //while (!feof($file)) {
            //$linea = fgets($file);
            while ($linea = fgets($file)) {    
                $datos_linea_fichero = explode("\t", $linea);
                echo "<tr>";
                echo "<th>".$datos_linea_fichero[0]."</th>";
                for ($i = 1; $i < $columnas; $i++) {
                    if (isset($datos_linea_fichero[$i])) {
                        echo "<td>".$datos_linea_fichero[$i]."</td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
        }
        fclose($file);

        echo "</table>";
        ?>

</body>

</html>