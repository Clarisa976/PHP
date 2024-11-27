<?php
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Práctica 10", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}
if (!isset($_POST["profesor"])) {
    $_POST["profesor"] = $datos_usuario_log["id_usuario"];
}


if (isset($_SESSION["profesor"])) {
    $_POST["dia"] = $_SESSION["dia"];
    $_POST["hora"] = $_SESSION["hora"];
    $_POST["profesor"] = $_SESSION["profesor"];
    $mensaje_accion = $_SESSION["mensaje_accion"];
    session_destroy();
}



try {
    $consulta = "select id_usuario, nombre from usuarios";
    $result_profesores = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Práctica 10", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["profesor"])) {
    try {
        $consulta = "select dia,hora,nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.usuario='" . $_POST["profesor"] . "'";
        $result_horario_profe = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Práctica 10", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }


    while ($tupla = mysqli_fetch_assoc($result_horario_profe)) {
        if (isset($horario[$tupla["dia"]][$tupla["hora"]]))
            $horario[$tupla["dia"]][$tupla["hora"]] .= "/" . $tupla["nombre"];
        else
            $horario[$tupla["dia"]][$tupla["hora"]] = $tupla["nombre"];
    }
    mysqli_free_result($result_horario_profe);
}

if (isset($_POST["dia"])) {
    try {
        $consulta = "select id_horario, nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.dia='" . $_POST["dia"] . "' AND horario_lectivo.hora='" . $_POST["hora"] . "' AND horario_lectivo.usuario='" . $_POST["profesor"] . "'";
        $result_horario_profe_dia_hora = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Práctica 10", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "select * from grupos where id_grupo not in (select grupo from horario_lectivo where dia='" . $_POST["dia"] . "' AND hora='" . $_POST["hora"] . "' AND usuario='" . $_POST["profesor"] . "')";
        $result_grupos_libres_profesor_dia_hora = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Práctica 10", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 10</title>
    <style>
        .centrado {
            text-align: center
        }

        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 90%
        }

        th {
            background-color: #CCC
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }
    </style>
</head>
<body>
    <h1>Práctica 10</h1>
    <?php
        if(isset($_SESSION["mensaje_accion"])){
            echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        }
    ?>
    <div>
        <form class="enlinea" action="index.php" method="post">Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - <button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
    </div>
    <?php
    if (isset($_POST["profesor"])) {
        echo "<h3 class='centrado'>Horario del Profesor:" . $datos_usuario_log["usuario"] . "</h3>";
        echo "<table class='centrado'>";
        echo "<tr>";
        echo "<th></th>";
        for ($i = 1; $i <= count(DIAS); $i++)
            echo "<th>" . DIAS[$i] . "</th>";
        echo "</tr>";

        for ($hora = 1; $hora <= count(HORAS); $hora++) {
            echo "<tr>";
            echo "<th>" . HORAS[$hora] . "</th>";
            if ($hora == 4) {
                echo "<td colspan='5'>RECREO</td>";
            } else {
                for ($dia = 1; $dia <= count(DIAS); $dia++) {
                    echo "<td>";
                    if (isset($horario[$dia][$hora])) {
                        echo $horario[$dia][$hora];
                    }
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='dia' value='" . $dia . "'/>";
                    echo "<input type='hidden' name='hora' value='" . $hora . "'/>";
                    echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                    //echo "<button class='enlace' name='btnEditar' type='submit'>Editar</button>";
                    echo "</form>";
                    echo "</td>";
                }
            }

            echo "</tr>";
        }
        echo "</table>";

        if (isset($_POST["dia"])) {
            if ($_POST["hora"] <= 3)
                echo "<h2>Editando la " . $_POST["hora"] . "º hora (" . HORAS[$_POST["hora"]] . ") del " . DIAS[$_POST["dia"]] . "</h2>";
            else
                echo "<h2>Editando la " . ($_POST["hora"] - 1) . "º hora (" . HORAS[$_POST["hora"]] . ") del " . DIAS[$_POST["dia"]] . "</h2>";

            if (isset($mensaje_accion))
                echo "<p class='mensaje'>" . $mensaje_accion . "</p>";


            echo "<table class='centrado'>";
            echo "<tr><th>Grupo</th><th>Acción</th></tr>";
            while ($tupla = mysqli_fetch_assoc($result_horario_profe_dia_hora)) {
                echo "<tr>";
                echo "<td>" . $tupla["nombre"] . "</td>";
                echo "<td>";
                echo "<form action='index.php' method='post'>";
                echo "<input type='hidden' name='dia' value='" . $_POST["dia"] . "'/>";
                echo "<input type='hidden' name='hora' value='" . $_POST["hora"] . "'/>";
                echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                //echo "<button name='btnQuitar' class='enlace' value='" . $tupla["id_horario"] . "' type='submit'>Quitar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result_horario_profe_dia_hora);

            echo "<form action='index.php' method='post'>";
            echo "<input type='hidden' name='dia' value='" . $_POST["dia"] . "'/>";
            echo "<input type='hidden' name='hora' value='" . $_POST["hora"] . "'/>";
            echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
            echo "<p>";
            echo "<select name='grupo'>";
            while ($tupla = mysqli_fetch_assoc($result_grupos_libres_profesor_dia_hora)) {
                echo "<option value='" . $tupla["id_grupo"] . "'>" . $tupla["nombre"] . "</option>";
            }
            echo "</select>";
            //echo "<button type='submit' name='btnAgregar'>Añadir</button>";
            echo "</p>";
            echo "</form>";
        }
    }
    ?>

</body>
</html>