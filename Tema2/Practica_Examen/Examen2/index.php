<?php
require "src/funciones_ctes.php";
require "src/seguridad.php";
function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <form action="index.php" method="post">
        <label for="horario_profe">Horario del Profesor: </label>

        <select name='horario_profe' id='horario_profe'>;
            <?php
            while ($tupla = mysqli_fetch_assoc($datos)) {
                echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>
            </select>";
            }

            ?>
            <select name="horario_profe" id="horario_profe">
                <option value="">a</option>
            </select>
            <button type="submit" name="btnVerHorario">Ver Horario</button>
            <?php
            if (isset($_POST["btnVerHorario"])) {
                require "vistas/vista_tabla.php";
                echo "<h2>Horario del profesor: </h2>";
            }

            ?>
    </form>
</body>

</html>