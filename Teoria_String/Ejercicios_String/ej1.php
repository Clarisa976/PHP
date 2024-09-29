<?php
//control de errores
if (isset($_POST['comparar'])) {
    $primera = trim($_POST['primera']); //quitamos espacios
    $segunda = trim($_POST['segunda']);
    $letra_primera_palabra = strlen($primera); //tamaño
    $letra_segunda_palabra = strlen($segunda);
    $error_primera = $primera == "" || $letra_primera_palabra < 3; //controlamos que sean como mínimo tres caracteres
    $error_segunda = $segunda == "" || $letra_segunda_palabra < 3;
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        .contenedor {
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
        }

        .verde {
            background-color: lightgreen;
        }

        .rojito {
            background-color: #ff5942;
        }
    </style>
</head>

<body>

    <div class="contenedor">
        <form action="ej1.php" method="post">
            <div class="formulario principal">
                <h1 class="centro">Ripios - Formulario</h1>
                <p>
                <h2 clase="centro">Dime dos palabras y te diré si riman o no.</h2>
                <label for="primera">Primera palabra: </label>
                <input type="text" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $primera ?>">
                <?php
                if (isset($_POST["comparar"]) && $error_primera) {
                    if ($primera == "") {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                    }
                }
                ?>
                </p>
                <p>
                    <label for="segunda">Segunda palabra: </label>
                    <input type="text" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $segunda ?>">
                    <?php
                    if (isset($_POST["comparar"]) && $error_segunda) {
                        if ($segunda == '') {
                            echo "<span class = 'error'> Campo vacío </span>";
                        } else {
                            echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                        }
                    }
                    ?>
                </p>
                <p>
                    <input type="submit" value="Comparar" name="comparar">
                </p>
            </div>
        </form>
        <?php
        if (isset($_POST["comparar"]) && !$error_form) {
            $primera_palabra = strtoupper($primera); //quitamos mayúsculas
            $segunda_palabra = strtoupper($segunda);

            $respuesta = "no riman";
            $clase = "rojito"; //cambiamos a la clase rojito
            if (
                $primera_palabra[$letra_primera_palabra - 1] == $segunda_palabra[$letra_segunda_palabra - 1] &&
                $primera_palabra[$letra_primera_palabra - 2] == $segunda_palabra[$letra_segunda_palabra - 2]
            ) {
                $respuesta = "riman un poco";
                $clase = "verde"; //cambiamos a la clase a verde
                if ($primera_palabra[$letra_primera_palabra - 3] == $segunda_palabra[$letra_segunda_palabra - 3]) {
                    $respuesta = "riman";
                }
            }

        ?>
            <br>
            <div class="formulario respuesta  <?php echo $clase; ?>">
                <h2 class="centro">Ripios - Respuesta</h2>
                <p>Las palabras <strong><?php echo $primera ?></strong> y <strong><?php echo $segunda ?></strong> <?php echo $respuesta ?></p>
            </div>

        <?php //al poner esto aquí nos aseguramos de que la respuesta solo salga cuando se le da a comparar
        }
        ?>

    </div>
</body>

</html>