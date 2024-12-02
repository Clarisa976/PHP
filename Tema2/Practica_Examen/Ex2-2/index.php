<?php
//creamos e iniciamos la sesión
session_name("ex22");
session_start();

//requerimos las funciones
require "src/funciones_ctes.php";

//probamos la conexión a la base de datos
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    //si la conexión funciona cambiamos el charset
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    //si no funciona destruimos la sesión y error_page
    session_destroy();
    die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
}

//si la conexión funciona traemos los datos con la primera consulta para el select
try {
    $consulta = "select * from alumnos";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    //si no funciona destruimos la sesión, cerramos la conexión y error_page
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["btnVerNotas"])) {
    //consulta para traer las cosas de la tabla
    try {
        $consulta = "select notas.cod_asig,denominacion,nota from notas,asignaturas where notas.cod_asig=asignaturas.cod_asig and cod_alu='" . $_POST["alumno"] . "'";
        $resultado_notas = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        //si no funciona destruimos la sesión, cerramos la conexión y error_page
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnBorrar"])) {
    try {
        $consulta = "delete from notas where cod_asig='" . $_POST["btnBorrar"] . "' and cod_alu='" . $_POST["alumno"] . "'";
        $resultado_borrar = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        //si no funciona destruimos la sesión, cerramos la conexión y error_page
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
    }
    $_SESSION["mensaje"] = "nota borrada con éxito";
    $_SESSION["alumno"]=$_POST["alumno"];
    header("Location:index.php");
    exit;
    /*try {
        $consulta = "select notas.cod_asig,denominacion,nota from notas,asignaturas where notas.cod_asig=asignaturas.cod_asig and cod_alu='" . $_POST["alumno"] . "'";
        $resultado_notas = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
    }*/
}


if (isset($_POST["btnCalificar"])) {
    try {
        $consulta = "INSERT INTO notas (cod_alu, cod_asig, nota) VALUES ('" . $_POST["alumno"] . "', '" . $_POST["asignaturas_calificar"] . "', 0)";
        $resultado_insert = mysqli_query($conexion, $consulta);
        //mensaje
        $_SESSION["mensaje"] = "Calificación de 0 registrada correctamente para la asignatura seleccionada.";
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
    }
}


//comprobamos que haya usuarios en la base de datos sino saldrá un mensaje
if (mysqli_num_rows($resultado) <= 0) {
    echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
} else {



?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Examen 2 PHP</title>
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
                color: powderblue;
            }
        </style>
    </head>

    <body>
        <form action="index.php" method="post">
            <h1>Notas de los alumnos</h1>
            <label for="alumno">Seleccione a un alumno: </label>
            <select name="alumno" id="alumno">
                <?php
                //recorremos el resultado
                while ($tupla = mysqli_fetch_assoc($resultado)) {
                    if (isset($_POST["alumno"]) && $_POST["alumno"] == $tupla["cod_alu"]) {
                        echo "<option selected value='" . $tupla["cod_alu"] . "'>" . $tupla["nombre"] . "</option>";
                        $nombre_alumno = $tupla["nombre"];
                    } else {
                        echo "<option value='" . $tupla["cod_alu"] . "'>" . $tupla["nombre"] . "</option>";
                    }
                }
                mysqli_free_result($resultado);
                ?>
            </select>

            <button type="submit" name="btnVerNotas">Ver notas</button>


        <?php
        //tabla de ver notas
        if (isset($_POST["btnVerNotas"]) || isset($_POST["btnBorrar"])) {
            echo "<h2>Notas del alumno " . $nombre_alumno . "</h2>";

            //tabla
            echo "<table>";
            echo "<tr>";
            echo "<th>Asignatura</th><th>Nota</th><th>Acción</th>";
            echo "</tr>";
            while ($tupla = mysqli_fetch_assoc($resultado_notas)) {
                echo "<tr>";
                echo "<td>" . $tupla["denominacion"] . "</td>";
                echo "<td>" . $tupla["nota"] . "</td>";
                echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar' value='" . $tupla["cod_asig"] . "'>Editar</button><button type='submit' name='btnBorrar' value='" . $tupla["cod_asig"] . "'>Borrar</button> <input type='hidden' name='alumno' value='" . $_POST["alumno"] . "'></form></td>";


                echo "</tr>";
            }
            echo "</table>";
            //si hay mensaje que lo muestre        
            if (isset($_SESSION["mensaje"])) {
                echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
                unset($_SESSION["mensaje"]);
            }
            try {
                $consulta = "select * from asignaturas where cod_asig not in (select asignaturas.cod_asig from asignaturas, notas where asignaturas.cod_asig=notas.cod_asig and notas.cod_alu='" . $_POST["alumno"] . "')";
                $resultado_calificar = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                //si no funciona destruimos la sesión, cerramos la conexión y error_page
                session_destroy();
                mysqli_close($conexion);
                die(error_page("Examen2 PHP", "<p>La conexión ha fallado: " . $e->getMessage() . "</p>"));
            }

            if (mysqli_num_rows($resultado_calificar) <= 0) {
                echo "<p>A <strong>$nombre_alumno</strong> no quedan asignaturas por calificar.</p>";
            } else {
                echo "<p>";
                echo "<label for='asignaturas_calificar'>Asignaturas que a <strong>$nombre_alumno</strong> aún quedan por calificar: </label>";
                echo "<select name='asignaturas_calificar' id='asignaturas_calificar'>";
                while ($tupla_calificar = mysqli_fetch_assoc($resultado_calificar)) {
                    echo "<option value='" . $tupla_calificar["cod_asig"] . "'>" . $tupla_calificar["denominacion"] . "</option>";
                }
                echo "</select>";
                echo "<button type='submit' name='btnCalificar' >Calificar</button> <input type='hidden' name='alumno' value='" . $_POST["alumno"] . "'>";
                echo "</p>";
            }



            mysqli_free_result($resultado_notas);
            mysqli_free_result($resultado_calificar);
        }
    }
        ?>
        </form>
    </body>

    </html>