<?php
if (isset($_POST["btnEnviar"])) {
    //control de errores
    $error_campo_vacio_primero = $_POST["primer_numero"] == " ";
    $error_numero_valido_primero = !is_numeric($_POST["primer_numero"]);
    $error_rango_numerico_primero =  $_POST["primer_numero"] < 1 || $_POST["primer_numero"] > 10;

    $error_campo_vacio_segundo = $_POST["segundo_numero"] == " ";
    $error_numero_valido_segundo = !is_numeric($_POST["segundo_numero"]);
    $error_rango_numerico_segundo =  $_POST["segundo_numero"] < 1 || $_POST["segundo_numero"] > 10;

    $error_numero_primero = $error_campo_vacio_primero || $error_numero_valido_primero || $error_rango_numerico_primero;
    $error_numero_segundo = $error_campo_vacio_segundo || $error_numero_valido_segundo || $error_rango_numerico_segundo;

    $error_formulario = $error_numero_primero || $error_numero_segundo;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de ficheros - Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ej3.php" method="post">
        <h1>Ejercicio 3</h1>
        <p>
            <label for="primer_numero">Introduce un número del 1 al 10</label>
            <input type="text" name="primer_numero" id="primer_numero" value="<?php if(isset($_POST['primer_numero'])) echo ($_POST['primer_numero']); ?>">
            <?php
            /*controlamos los errores que pueda producirse al introducir un número*/
            if (isset($_POST["btnEnviar"]) && $error_campo_vacio_primero) {
                echo "<span class='error'>Campo vacío</span>";
            } elseif (isset($_POST["btnEnviar"]) && $error_numero_valido_primero) {
                echo "<span class='error'>No has introducido un número</span>";
            } elseif (isset($_POST["btnEnviar"]) && $error_rango_numerico_primero) {
                echo  "<span class='error'>Número fuera de rango</span>";
            }
            ?>
        </p>
        <p>
            <label for="segundo_numero">Introduce un número del 1 al 10</label>
            <input type="text" name="segundo_numero" id="segundo_numero" value="<?php if(isset($_POST['segundo_numero'])) echo ($_POST['segundo_numero']); ?>">
            <?php
            /*controlamos los errores que pueda producirse al introducir un número*/
            if (isset($_POST["btnEnviar"]) && $error_campo_vacio_segundo) {
                echo "<span class='error'>Campo vacío</span>";
            } elseif (isset($_POST["btnEnviar"]) && $error_numero_valido_segundo) {
                echo "<span class='error'>No has introducido un número</span>";
            } elseif (isset($_POST["btnEnviar"]) && $error_rango_numerico_segundo) {
                echo  "<span class='error'>Número fuera de rango</span>";
            }
            ?>
        </p>

        <button type="submit" name="btnEnviar">Mostrar tabla</button>
        <?php
        if (isset($_POST["btnEnviar"]) && !$error_formulario) {
            $fichero_tablas = "./Tablas/tabla_" . $_POST["primer_numero"] . ".txt";
            if (!file_exists($fichero_tablas)) {
                die("<p>No hay ningún fichero para esa tabla</p>");
            } else {
                @$file = fopen($fichero_tablas, "r");
                if (!$file) {
                    die("<p>Error al abrir el fichero</p>");
                }
                $linea_mostrar = $_POST["segundo_numero"]-0;
                for ($i = 0; $i <= $linea_mostrar; $i++) {
                    $linea = fgets($file);
                    if ($linea === false) {
                        echo "<p>No existe esa línea</p>";
                        break;
                    }
                    if ($i === $linea_mostrar) {
                        echo "<p> " . $linea . "</p>";
                        break;
                    }
                }
            }
            fclose($file);
            echo "<p> Fichero leido con éxito </p>";
        }

        ?>
    </form>
</body>

</html>