<?php
//control de errores
if (isset($_POST["calcular"])) {
    //errores
    //quitamos posibles espacios
    $primera  = trim($_POST['primera']);
    $segunda  = trim($_POST['segunda']);
    //comprobamos que los esparadores son los adecuados y que se han introducido números
    $buenos_separadores1 = substr($primera, 2, 1) == "/" && substr($primera, 5, 1) == "/";
    $primera_fecha = explode('/', $primera);
    $numeros_buenos1 = is_numeric($primera_fecha[0]) && is_numeric($primera_fecha[1]) && is_numeric($primera_fecha[2]);

    $buenos_separadores2 = substr($segunda, 2, 1) == "/" && substr($segunda, 5, 1) == "/";
    $segunda_fecha = explode('/', $segunda);
    $numeros_buenos2 = is_numeric($segunda_fecha[0]) && is_numeric($segunda_fecha[1]) && is_numeric($segunda_fecha[2]);

    $error_primera_fecha = $primera == "" || strlen($primera) != 10 || !$buenos_separadores1 || !$numeros_buenos1 || !checkdate($primera_fecha[1], $primera_fecha[0], $primera_fecha[2]);
    $error_segunda_fecha = $segunda == "" || strlen($segunda) != 10 || !$buenos_separadores2 || !$numeros_buenos2 || !checkdate($segunda_fecha[1], $segunda_fecha[0], $segunda_fecha[2]);
    $error_form = $error_primera_fecha || $error_segunda_fecha;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 1</title>
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
    <form action="fechas1.php" method="post" class="principal">

        <h1 class="centro">Fechas - Formulario</h1>
        <p>
            <label for="primera">Introduzca una fecha (DD/MM/YYYY): </label>
            <input type="text" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $_POST['primera']; ?>">
            <?php
            if (isset($_POST["calcular"]) && $error_primera_fecha) {
                if ($primera == "") {
                    echo "<span class = 'error'> Campo vacío </span>";
                } else {
                    echo "<span class = 'error'> Debes teclear una fecha válida </span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="segunda">Introduzca una fecha (DD/MM/YYYY): </label>
            <input type="text" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $_POST['segunda']; ?>">
            <?php
            if (isset($_POST["calcular"]) && $error_segunda_fecha) {
                if ($segunda == '') {
                    echo "<span class = 'error'> Campo vacío </span>";
                } else {
                    echo "<span class = 'error'> Debes teclear una fecha válida </span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="calcular">Calcular</button>
    </form>
    <?php
    if (isset($_POST["calcular"]) && !$error_form) {

        //obtenemos las dos fechas
        $fecha1=explode("/",$_POST["primera"]);
        $fecha2=explode("/",$_POST["segunda"]);

        //las pasamos en segundos usando mktime
        $tiempo1 = mktime(0,0,0,$fecha1[1],$fecha1[0],$fecha1[2]);
        $tiempo2 = mktime(0,0,0,$fecha2[1],$fecha2[0],$fecha2[2]);
        
        //calculamos la diferencia de segundos y lo pasamos a días
        $dif_segundos = abs($tiempo1 - $tiempo2);
        $dias_pasados = floor($dif_segundos/(60*60*24));

        echo "<div class='respuesta'>";
        echo "<h1 class='centro'>Fechas - Resultado</h1>";
        //echo "<p>" . $fecha1 . "</p>";
        //echo "<p>" . $fecha2 . "</p>";
        echo "<p>La diferencia en días entre las dos fechas es de " . floor($dias_pasados) . "</p>";
        echo "</div>";
    }

    ?>
</body>

</html>