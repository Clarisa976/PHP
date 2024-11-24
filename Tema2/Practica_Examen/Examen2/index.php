<?php
session_name("ex2");
session_start();
require "src/funciones_ctes.php";
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
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php
    //conexión con la bd
    if (!isset($conexion)) {
        try {
            $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
        die("Examen2,<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>");
    }
}
    //consulta a la tabla 
    try {
        $consulta = "select * from usuarios";
        $datos = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        //cerramos la sesión
        mysqli_close($conexion);
        session_destroy();
        die("Examen2,<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>");
    }
    if (mysqli_num_rows($datos) == 0) {
        echo "<p>No hay profesores en la BD.</p>";
    } else {


    ?>
        <form action="index.php" method="post">
            <label for="horario_profe">Horario del Profesor: </label>

            <select name='horario_profe' id='horario_profe'>;
                <?php
                while ($tupla = mysqli_fetch_assoc($datos)) {
                    if ((isset($_POST["horario_profe"]) && $_POST["horario_profe"] == $tupla["id_usuario"])) {
                        echo "<option selected value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                        $nombre_prof = $tupla["nombre"];
                    } else
                        echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                }

                ?>

                </select>
                <button type="submit" name="btnVerHorario">Ver Horario</button>
                <?php
                if (isset($_POST["btnVerHorario"])) {
                    echo "<h2>Horario del profesor: ".$nombre_prof."</h2>";
                    require "vistas/vista_tabla.php";
                   
                }

                ?>
            <?php
        }
            ?>
        </form>
</body>

</html>