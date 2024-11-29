<?php
//iniciamos la sesión
session_name("examenBDCole");
session_start();

require "src/funcones_ctes.php";
//nos conectamos a la bd
try {
    @$conexion = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Examen BD Cole", "<p>No se ha podido conectar a la BD :( " . $e->getMessage() . "</p>"));
}

//consulta
try {
    $consulta = "select * from alumnos";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

if(isset($_POST["alumno"])) {
    try {
        $consulta = "SELECT notas.cod_asig,denominacion,notas FROM notas,asignaturas WHERE notas.cod_asig=asignaturas.cod_asig AND cod_alu='".$_POST["alumno"]."'";
        $resultado_notas_alumno = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
    }
}

if (mysqli_num_rows($resultado) <= 0) {
    echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";

   // mysqli_free_result($resultado);
    //mysqli_close($conexion);
}else{



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen bd cole</title>
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
            color: powderblue;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <form action="index.php" method="post">
        <p>
            <label for="alumno">Seleccione un alumno: </label>
            <select name="alumno" id="alumno">
                <?php
                while ($tupla = mysqli_fetch_assoc($resultado)) {
                    if (isset($_POST["alumno"]) && $_POST["alumno"] == $tupla["cod_alu"]) {
                        echo "<option selected value='" . $tupla["cod_alu"] . "'>" . $tupla["nombre"] . "</option>";
                        //guardamos el nombre
                        $nombre_alumno = $tupla["nombre"];
                    } else {
                        echo "<option value='" . $tupla["cod_alu"] . "'>" . $tupla["nombre"] . "</option>";
                    }
                }
                mysqli_free_result($resultado);
                ?>
            </select>
            <button type="submit" name="btnVerNotas">Ver notas</button>
        </p>
    </form>
    <?php
    if(isset($_POST["alumno"])){
        $cod_alu=$_POST["alumno"];
        echo "<h2>Notas del alumno ".$nombre_alumno."</h2>";

        //tabla de notas
        
    }


}
    ?>
</body>

</html>