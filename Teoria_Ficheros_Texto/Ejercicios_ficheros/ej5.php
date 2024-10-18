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

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <form action="ej5.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 5</h1>

        <?php
        echo "<table>";
        echo "<caption>PIB de los países de la UE</caption>";
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

        if (!$file) {
            die("<p> No se ha podido abrir el fichero</p>");
        } else {

            $linea = fgets($file);
            $datos_fichero = explode("\t", $linea);
            $columnas = count($datos_fichero);
            echo "<tr>";
            for ($i = 0; $i < $columnas; $i++) {
                echo "<th>$datos_fichero[$i]</th>";
            }
            echo "</tr>";

            while (!feof($file)) {
                $linea = fgets($file);
                $datos_fichero = explode("\t", $linea);
                echo "<tr>";
                echo "<th>$datos_fichero[0]</th>";
                for ($i = 1; $i < $columnas; $i++) {
                    if (isset($datos_fichero[$i])) {
                        echo "<td>$datos_fichero[$i]</td>";
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
    </form>

</body>

</html>