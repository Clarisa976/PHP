<?php
//control de errores
if (isset($_POST["calcular"])) {
    //errores
    $error_primera  = !checkdate($_POST['mes1'], $_POST['dia1'], $_POST['anio1']);
    $error_segunda = !checkdate($_POST['mes2'], $_POST['dia2'], $_POST['anio2']);
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 2</title>
    <style>
        body {
            background-color: beige;
            padding: 10px;
        }

        .principal {
            border: 1px solid;
            background-color: lightblue;
            margin-bottom: 5px;
            padding: 5px;
        }

        .centro {
            text-align: center;
        }

        .error {
            color: red;
        }

        .respuesta {
            border: 2px solid;
            padding: 5px;
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <form action="fechas2.php" method="post" class="principal">

        <h1 class="centro">Fechas - Formulario</h1>
        <p>Introduzca una fecha:</p>
        <p>
            <label for="dia1">Día: </label>
            <select name="dia1" id="dia1">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    $dia1 = str_pad($i, 2, "0", STR_PAD_LEFT);
                    echo "<option value='$dia1'" . (isset($_POST["dia1"]) && $_POST["dia1"] == $dia1 ? " selected" : "") . ">$dia1</option>";
                }
                ?>
            </select>
            <label for="mes1">Mes: </label>
            <select name="mes1" id="mes1">
                <?php
                $array_mes[1] = 'Enero';
                $array_mes[] = 'Febrero';
                $array_mes[] = 'Marzo';
                $array_mes[] = 'Abril';
                $array_mes[] = 'Mayo';
                $array_mes[] = 'Junio';
                $array_mes[] = 'Julio';
                $array_mes[] = 'Agosto';
                $array_mes[] = 'Septiembre';
                $array_mes[] = 'Octubre';
                $array_mes[] = 'Noviembre';
                $array_mes[] = 'Diciembre';

                for ($i = 1; $i <= 12; $i++) {
                    if (isset($_POST['calcular']) && $_POST['mes1'] == $i) {
                        echo '<option selected value=' . $i . '>' . $array_mes[$i] . '</option>';
                    } else {
                        echo '<option value=' . $i . '>' . $array_mes[$i] . '</option>';
                    }
                }
                ?>
            </select>
            <label for="anio">Año: </label>
            <select name="anio1" id="anio1">
                <?php
                $anio1Actual = date("Y"); //año actual
                $anioInicio = $anio1Actual - 25; //25 años antes
                $anioFin = $anio1Actual + 25; //25 años después

                for ($i = $anioInicio; $i <= $anioFin; $i++) {
                    echo "<option value='$i'" . (isset($_POST["anio1"]) && $_POST["anio1"] == $i ? " selected" : "") . ">$i</option>";
                }
                ?>
            </select>
            <?php
            if (isset($_POST["calcular"]) && $error_primera) {
                echo "<span class='error'> Fecha no válida</span>";
            }
            ?>
        </p>
        <p>Introduzca otra fecha:</p>
        <p>
            <label for="dia2">Día: </label>
            <select name="dia2" id="dia2">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    $dia2 = str_pad($i, 2, "0", STR_PAD_LEFT);
                    echo "<option value='$dia2'" . (isset($_POST["dia2"]) && $_POST["dia2"] == $dia2 ? " selected" : "") . ">$dia2</option>";
                }
                ?>
            </select>
            <label for="mes2">Mes: </label>
            <select name="mes2" id="mes2">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    if (isset($_POST['calcular']) && $_POST['mes2'] == $i) {
                        echo '<option selected value=' . $i . '>' . $array_mes[$i] . '</option>';
                    } else {
                        echo '<option value=' . $i . '>' . $array_mes[$i] . '</option>';
                    }
                }
                ?>
            </select>
            <label for="anio2">Año: </label>
            <select name="anio2" id="anio2">
                <?php
                $anio2Actual = date("Y"); //año actual
                $anioInicio = $anio2Actual - 25; //25 años antes
                $anioFin = $anio2Actual + 25; //25 años después

                for ($i = $anioInicio; $i <= $anioFin; $i++) {
                    echo "<option value='$i'" . (isset($_POST["anio2"]) && $_POST["anio2"] == $i ? " selected" : "") . ">$i</option>";
                }
                ?>
            </select>
            <?php
            if (isset($_POST["calcular"]) && $error_segunda) {
                echo "<span class='error'> Fecha no válida</span>";
            }
            ?>
        </p>
        <button type="submit" name="calcular">Calcular</button>
    </form>
    <?php
    if (isset($_POST["calcular"]) && !$error_form) {

        //obtenemos las dos fechas en segundos
        $fecha1 = strtotime($_POST['anio1'] . '/' . $_POST['mes1'] . '/' . $_POST['dia1']);
        $fecha2 = strtotime($_POST['anio2'] . '/' . $_POST['mes2'] . '/' . $_POST['dia2']);

        //restamos la diferencia con abs para que no haya decimales
        $diferencia_segundos = abs($fecha1 - $fecha2);
        //pasanis los segundos a días
        $dias_pasados = $diferencia_segundos / (60 * 60 * 24);

        echo "<div class='respuesta'>";
        echo "<h1 class='centro'>Fechas - Resultado</h1>";
        //echo "<p>" . $fecha1 . "</p>";
        //echo "<p>" . $fecha2 . "</p>";
        echo "<p>La diferencia en días entre las dos fechas es de: " . floor($dias_pasados) . "</p>";
        echo "</div>";
    }

    ?>
</body>

</html>