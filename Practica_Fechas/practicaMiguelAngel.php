<?php

const DIAS_SEMANA = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
const SEGUNDOS_DIA = 60 * 60 * 24;

//cambiar la fecha al pulsar el botón cambiar
if (isset($_POST["fecha"]) && $_POST["fecha"] != "") {
    $fecha = $_POST["fecha"];
    //$dia_semana = date("w",strtotime($fecha));

} else {
    $fecha = date("Y-m-d");
    //$dia_semana = date("w");

}

//segundos del día
$segundos_fecha = strtotime($fecha);

//formateo de la fecha dada para que te diga el día que es
$dia_semana = date("w", $segundos_fecha);

//calcular el primer y último día de la semana
$dias_pasados = $dia_semana - 1;
if ($dias_pasados == -1) { //al ser -1 quiere decir que sería domingo
    $dias_pasados = 6;
}

$primer_dia = $segundos_fecha - ($dias_pasados * SEGUNDOS_DIA);
//para calcular el lunes se suman 6
$ultimo_dia = $primer_dia + (6 * SEGUNDOS_DIA);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de aulas de Miguel Ángel</title>
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

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            text-align: center;
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 2px;
        }

        th {
            background-color: #CCC;
        }
    </style>
</head>

<body>
    <div class="principal">
        <form action="practicaMiguelAngel.php" method="post" id="form_fecha">

            <h1 class="centro">Reserva de aulas</h1>
            <p class="centro">

                <label for="fecha"><?php echo "<strong>" . DIAS_SEMANA[$dia_semana] . "</strong>"; ?> </label>

                <!-- le añadimos el evento onchange para poder quitar el botón -->
                <input type="date" name="fecha" id="fecha" onchange="document.getElementById('form_fecha').submit();" value="<?php echo $fecha; ?>">

                <!-- <button type="submit" name="cambiar">Cambiar</button> -->
            </p>
            <p class="centro">
                Semana del <?php echo date("d/m/Y", $primer_dia); ?> al <?php echo date("d/m/Y", $ultimo_dia); ?>
            </p>
        </form>
    </div>

    <?php
    $horas[1] =  "08:15 - 09:15";
    $horas[] =  "09:15 - 10:15";
    $horas[] =  "10:15 - 11:15";
    $horas[] =  "11:15 - 11:45";
    $horas[] =  "11:15 - 12:45";
    $horas[] =  "12:45 - 13:45";
    $horas[] =   "13:45 - 14:45";
    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    //código para que te escriba las columnas
    for ($i = 1; $i <= 5; $i++) {
        echo "<th>" . DIAS_SEMANA[$i] . "</th>";
    }
    echo "</tr>";
    for ($fila = 1; $fila <= 7; $fila++) {
        echo "<tr>";
        echo "<th>" . $horas[$fila] . "</th>";
        if ($fila == 4) {
            echo "<td colspan='5'>RECREO</td>";
        } else {
            for ($columna = 1; $columna <= 5; $columna++) {
                echo "<td></td>";
            }
        }

        echo "</tr>";
    }
    echo " </table>";

    ?>
</body>

</html>