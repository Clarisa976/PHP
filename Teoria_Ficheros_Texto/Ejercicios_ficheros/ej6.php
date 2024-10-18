<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de fichero - Ejercicio 6</title>
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

        td {
            padding: 3px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Ejercicio 6</h1>

    <?php
    //primero se abre el fichero para cargar los datos del fichero antes
    @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
    if (!$file) {
        die("<p> No se ha podido abrir el fichero</p>");
    } else {
        $linea = fgets($file);
        $datos_primera_linea = explode("\t", $linea);
        /*while ($linea = fgets($file)) {
            $datos_primera_linea = explode("\t", $linea);
            $datos_primera_columna = explode(",", $datos_primera_linea[0]);
            $paises[] = $datos_primera_columna[2];
            if (isset($_POST["pais"]) && $_POST["pais"] == $datos_primera_columna[2]) {
                $datos_pais_seleccionado = $datos_primera_linea;
            }
        }*/
    }

    ?>

    <form action="ej6.php" method="post">

        <p>
            <label for="pais">Seleccione un país</label>
            <select name="pais" id="pais">
                <?php
                //versión de miguel ángel

                while ($linea = fgets($file)) {
                    $datos_primera_linea = explode("\t", $linea);
                    $datos_primera_columna = explode(",", $datos_primera_linea[0]);

                    if (isset($_POST["pais"]) && $_POST["pais"] == end($datos_primera_columna)) {
                        echo "<option value=" . end($datos_primera_columna) . "selected>" . end($datos_primera_columna) . "</option>";
                        $datos_mostrar = $datos_primera_linea;
                        $pais_seleccionado = end($datos_primera_columna);
                    }
                    echo "<option value=" . end($datos_primera_columna) . ">" . end($datos_primera_columna) . "</option>";
                }
                /*for ($i = 0; $i < count($paises); $i++) {
                    if (isset($_POST["pais"]) && $_POST["pais"] == $paises[$i]) {
                        echo "<option selected value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                    } else {
                        echo "<option value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                    }
                }*/
                fclose($file);
                ?>
            </select>
        </p>
        <p>
            <button name="btnBuscar" type="submit">Buscar</button>
        </p>

    </form>
    <?php
    if (isset($_POST["btnBuscar"])) {


        $numero_columna = count($datos_primera_linea);
        echo "<h2>PIB per cápita de " . $_POST["pais"] . "</h2>";

        echo "<table>";
        echo "<tr>";
        for ($i = 1; $i < $numero_columna; $i++) {
            echo "<th>$datos_primera_linea[$i]</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 1; $i < $numero_columna; $i++) {
            if (isset($datos_mostrar[$i])) {
                echo "<td>" . $datos_mostrar[$i] . "</td>";
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
    }
    /*echo "<h2>PIB per cápita de " . $_POST["pais"] . "</h2>";
        $datos_primera_linea = explode("\t", $linea);

        $numero_anios = count($datos_primera_linea) - 1;
        echo "<table>";
        echo "<tr>";
        for ($i = 1; $i < $numero_anios; $i++) {
            echo "<th>$datos_primera_linea[$i]</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 1; $i < $numero_anios; $i++) {
            if (isset($datos_pais_seleccionado[$i])) {
                echo "<td>" . $datos_pais_seleccionado[$i] . "</td>";
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
    }*/
    ?>

</body>

</html>