<?php
//control de errores
if (isset($_POST["calcular"])) {
    //errores
    $error_primera = $_POST['primera'] == "";
    $error_segunda =  $_POST['segunda'] == "";
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 3</title>
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
    <form action="fechas3.php" method="post" class="principal">

        <h1 class="centro">Fechas - Formulario</h1>
        <p>
            <label for="primera">Introduzca una fecha:</label>
            <input type="date" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) {
                                                                        echo $_POST["primera"];
                                                                    } ?>">
            <?php
            if (isset($_POST["calcular"]) && $error_primera) {

                echo "<span class='error'> No dejes el campo vacío </span>";
            }
            ?>
        </p>
        <p>
            <label for="segunda">Introduzca otra fecha:</label>
            <input type="date" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) {
                                                                        echo $_POST["segunda"];
                                                                    } ?>">
            <?php
            if (isset($_POST["calcular"]) && $error_segunda) {

                echo "<span class='error'> No dejes el campo vacío </span>";
            }
            ?>
        </p>
        <button type="submit" name="calcular">Calcular</button>
    </form>
    <?php
    if (isset($_POST["calcular"]) && !$error_form) {

        //obtenemos las dos fechas en segundos
        $fecha1 = strtotime($_POST['primera']);
        $fecha2 = strtotime($_POST['segunda']);


        //restamos la diferencia con abs para que no haya decimales
        $diferencia_segundos = abs($fecha1 - $fecha2);
        //pasanis los segundos a días
        $dias_pasados = $diferencia_segundos / (60 * 60 * 24);

        echo "<div class='respuesta'>";
        echo "<h1 class='centro'>Fechas - Resultado</h1>";
        //echo "<p>" . $fecha1 . "</p>";
        //echo "<p>" . $fecha2 . "</p>";
        echo "<p>La diferencia en días entre las dos fechas es de: " .floor($dias_pasados). "</p>";
        echo "</div>";
    }

    ?>
</body>

</html>