<?php
function mi_strlen($texto)
{
    $contador = 0;
    while (isset($texto[$contador])) {
        $contador++;
    }
    return $contador;
}

function mi_explode($separador, $texto)
{
    //creamos un array para almacenar el texto
    $array_aux = [];
    $tamanio = mi_strlen($texto);
    $aux = ""; //para almacenar el texto antes de añadirlo al array
    //recorremos el texto
    for ($i = 0; $i < $tamanio; $i++) {
        if ($texto[$i] == $separador) {
            $array_aux[] = $aux; //lo agregamos al array
            $aux = ""; //borramos lo que haya
        } else {
            $aux .= $texto[$i];
        }
    }
    $array_aux[] = $aux; //añadimos el texto que pueda haber tras el último separador
    return $array_aux;
}




//control de errores
if (isset($_POST["btnEnviar"])) {
    //comprobar errores
    //si hay algún error
    //si no es txt
    //si es mayor que 1mb
    //si ha subido algo
    $error_formulario = $_FILES["fichero"]["name"] == "" ||
        $_FILES["fichero"]["error"] ||
        $_FILES["fichero"]["type"] != "text/plain" ||
        $_FILES["fichero"]["size"] > 1000 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .error {
            color: red;
        }

        table,
        th,
        td {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center
        }

        th {
            background-color: #CCC
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    //comprobamos que se pueda abrir el fichero
    if (isset($_POST["btnEnviar"]) && !$error_formulario) {
        @$aux = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");
        //si no está
        if (!$aux) {
            echo "<p>No se encuentra el archivo </p>";
        }
    }
    //sino se abre
    @$file = fopen("Horario/horarios.txt", "r");
    if ($file) {
        $opciones = "";
        while ($linea = fgets($file)) {
            $datos_linea = mi_explode("\t", $linea);
            if (isset($_POST["btnVerHorario"]) && $_POST["profesor"] == $datos_linea[0]) {
                $opciones .= "<option selected value='" . $datos_linea[0] . "'>" . $datos_linea[0] . "</option>";
                $nombre_prof = $datos_linea[0];
                for ($i = 1; $i < count($datos_linea); $i += 3) {
                    if (isset($horario_profe[$datos_linea[$i]][$datos_linea[$i + 1]]))
                        $horario_profe[$datos_linea[$i]][$datos_linea[$i + 1]] .= "/" . $datos_linea[$i + 2];
                    else
                        $horario_profe[$datos_linea[$i]][$datos_linea[$i + 1]] = $datos_linea[$i + 2];
                }
            } else
                $opciones .= "<option value='" . $datos_linea[0] . "'>" . $datos_linea[0] . "</option>";
        }
        fclose($file);

    ?>
        <h2>Horario de los Profesores</h2>
        <form action="ejercicio4.php" method="post">
            <p>
                <label for="profesor">Horario del profesor</label>
                <select name="profesor" id="profesor">
                    <?php
                    echo $opciones;
                    ?>
                </select>
            </p>
            <p>
                <button type="submit" name="btnVerHorario">Ver Horario</button>
            </p>
        </form>
        <?php
        if (isset($_POST["btnVerHorario"])) {
            echo "<h3 class='text_centrado'>Horario del Profesor: " . $nombre_prof . "</h3>";

            $horas[1] = "8:15-9:15";
            $horas[] = "9:15-10:15";
            $horas[] = "10:15-11:15";
            $horas[] = "11:15-11:45";//recreo
            $horas[] = "11:45-12:45";
            $horas[] = "12:45-13:45";
            $horas[] = "13:45-14:45";

            echo "<table>";
            $semana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
            echo "<tr><th></th>";
            foreach ($semana as $dia) {
                echo "<th>$dia</th>";
            }
            echo "</tr>";
            for ($hora = 1; $hora <= 7; $hora++) {
                echo "<tr>";
                echo "<th>" . $horas[$hora] . "</th>";
                //si es la cuarta hora le ponemos recreo
                if ($hora == 4) {
                    echo "<td colspan='5'>RECREO</td>";
                } else {
                    for ($dia = 1; $dia <= 5; $dia++) {
                        if (isset($horario_profe[$dia][$hora])) {
                            echo "<td>" . $horario_profe[$dia][$hora] . "</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        ?>
        <h2>No se encuentra el archivo <em>Horario/horarios.txt</em></h2>
        <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Seleccione un archivo (Máx. 1MB)</label>
                <input type="file" name="fichero" id="fichero">
                <?php
                if (isset($_POST["btnEnviar"]) && $error_formulario) {
                    if ($_FILES["fichero"]["name"] == "") {
                        echo "<span class='error'>Campo vacío</span>";
                    } elseif ($_FILES["fichero"]["type"] != "text/plain") {
                        echo "<span class='error'>La extensión del fichero no es la adecuada</span>";
                    } else {
                        echo "<span class='error'>El tamaño del fichero es superior a 1MB</span>";
                    }
                }
                ?>
            </p>
            <p>
                <button type="submit" name="btnEnviar">Subir</button>
            </p>
        </form>
    <?php
    }
    ?>
</body>

</html>