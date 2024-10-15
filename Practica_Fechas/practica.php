<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de aulas</title>
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
        table{
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <form action="practica.php" method="post" class="principal">

        <h1 class="centro">Reserva de aulas</h1>
        <p>

            <label for="primera" id="fechaCambiar">
                <?php
                if (isset($_POST['fecha'])) {
                    $fecha = $_POST['fecha'];
                    $fechaSeleccionada = strtotime($fecha);

                    //cambiamos las fechas para que se muestren en español
                    switch (date('l', $fechaSeleccionada)) {
                        case 'Monday':
                            echo "Lunes";
                            break;
                        case 'Tuesday':
                            echo "Martes";
                            break;
                        case 'Wednesday':
                            echo "Miércoles";
                            break;
                        case 'Thursday':
                            echo "Jueves";
                            break;
                        case 'Friday':
                            echo "Viernes";
                            break;
                        case 'Saturday':
                            echo "Sábado";
                            break;
                        case 'Sunday':
                            echo "Domingo";
                            break;
                    }
                } else {
                    $hoy = date('Y-m-d');
                    $fechaSeleccionada = strtotime($hoy);

                    switch (date('l', $fechaSeleccionada)) {
                        case 'Monday':
                            echo "Lunes";
                            break;
                        case 'Tuesday':
                            echo "Martes";
                            break;
                        case 'Wednesday':
                            echo "Miércoles";
                            break;
                        case 'Thursday':
                            echo "Jueves";
                            break;
                        case 'Friday':
                            echo "Viernes";
                            break;
                        case 'Saturday':
                            echo "Sábado";
                            break;
                        case 'Sunday':
                            echo "Domingo";
                            break;
                    }
                }
                ?>
            </label>

            <input type="date" name="fecha" id="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'); ?>">

            <button type="submit" name="cambiar">Cambiar</button>

            <?php
            if (isset($_POST['fecha'])) {
                $fecha = $_POST['fecha'];
                $fechaSeleccionada = strtotime($fecha);

                $inicioSemana = strtotime('monday this week', $fechaSeleccionada);
                $finSemana = strtotime('sunday this week', $fechaSeleccionada);


                $formatoFecha = 'd/m';

                echo "<h2 class='centro'>Semana del " . date($formatoFecha, $inicioSemana) . " al " . date($formatoFecha, $finSemana) . "</h2>";
            }
            ?>

        </p>
    </form>
    <?php
    if (isset($_POST["cambiar"])) {

        $diaSemana = date('N', $fechaSeleccionada); //pillamos el número del día de la semana que es con N 1->Lunes 7->Doming

        //si es sábado o domingo pasamos del tema
        if ($diaSemana == 6 || $diaSemana == 7) {
            echo "<p class='centro'>No hay clases :D</p>";
        } elseif ($diaSemana >= 1 && $diaSemana <= 5) {
            echo "<div class='respuesta'>";
            echo "<h2 class='centro'>Horario</h2>";

            //creamos la tabla
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Horas</th>";

            //días de la semana
            $diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
            for ($i = 0; $i < 5; $i++) {
                echo "<th>{$diasSemana[$i]}</th>";
            }
            echo "</tr>";

            //horas
            $horarios = [
                "08:15 - 09:15",
                "09:15 - 10:15",
                "10:15 - 11:15",
                "11:15 - 12:45",
                "12:45 - 13:45",
                "13:45 - 14:45"
            ];
            

        //usamos un foreach para generar el horario
        foreach ($horarios as $horario) {
            echo "<tr>";
            echo "<td>$horario</td>";

            if ($horario == "11:15 - 12:45") {
                //recreo
                echo "<td colspan='5'>RECREO</td>";
            } else {
                
                for ($i = 0; $i < 5; $i++) {
                    echo "<td></td>";  //a rellenar con cosas
                }
            }

            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}
?>
</body>

</html>