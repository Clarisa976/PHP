<?php
if(isset($_POST['btnEquipo'])||isset(($_POST['btnProfe']))){
    if ($_POST['hora']>3) {
        $hora=$_POST['hora']-1;
    }else{
        $hora=$_POST['hora'];
    }

    $datos_env['dia']=$_POST['dia'];
    $datos_env['hora']=$_POST['hora'];
    $datos_env['usuario']=$datos_usuario_log['id_usuario'];

    $respuesta=consumir_servicios_REST(DIR_SERV."/deGuardia","GET",$datos_env);
    $json=json_decode($respuesta,true);

    if(!$json){
        session_destroy();
        die(error_page("Examen3_PHP_24-25","<h1>Examen Guardias</h1><p>Sin respuesta oportuna de la API deGuardia</p>"));
    }
    if (isset($json['error'])) {
        session_destroy();
        die(error_page("Examen3_PHP_24-25","<h1>Examen Guardias</h1><p>Sin respuesta oportuna de la API deGuardia</p>"));
    }

    $guardia=$json['de_guardia'];
    $respuesta=consumir_servicios_REST(DIR_SERV."/usuariosGuardia/".$_POST['dia']."/".$_POST['hora']."","GET",$datos_env);
    $json2=json_decode($respuesta,true);
    if(!$json2){
        session_destroy();
        die(error_page("Examen3_PHP_24-25","<h1>Examen Guardias</h1><p>Sin respuesta oportuna de la API deGuardia</p>"));
    }
    if (isset($json2['error'])) {
        session_destroy();
        die(error_page("Examen3_PHP_24-25","<h1>Examen Guardias</h1><p>Sin respuesta oportuna de la API deGuardia</p>"));
    }
    $profesores_guardia=$json2['profesores'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen3_PHP_24-25</title>
    <style>
        .en_linea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25em;
            color: blue
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: gray;
        }
    </style>
</head>

<body>
    <h1>Gestión de guardias</h1>
    <form action="index.php" method="post">
        <div>Bienvenido <?php echo $datos_usuario_log["usuario"] ?> - <button class="enlace" type="submit" name="btnSalir">Salir</button></div>
    </form>
    <?php
    $dias[0] = '';
    $dias[1] = 'Lunes';
    $dias[] = "Martes";
    $dias[] = "Miércoles";
    $dias[] = "Jueves";
    $dias[] = "Viernes";

    $horas[1] = "1ºHora";
    $horas[] = "2ºHora";
    $horas[] = "3ºHora";
    $horas[] = "";
    $horas[] = "4ºHora";
    $horas[] = "5ºHora";
    $horas[] = "6ºHora";

    $contador = 1;
    echo '<h2>Equipos de guardia del IES Mar de Alborán</h2>';
    echo '<table>';
    echo '<tr>';
    for ($dia = 0; $dia <= 5; $dia++) {

        echo '<th>' . $dias[$dia] . '</th>';
    }
    echo '<tr>';
    for ($hora = 1; $hora <= 7; $hora++) {
        echo '<tr>';
        echo '<td>' . $horas[$hora] . '</td>';
        if ($hora == 4) {
            echo '<td colspan="5">RECREO</td>';
        } else {
            for ($dia = 1; $dia <= 5; $dia++) {
                echo '<td>';
                echo "<form action='index.php' method='post'><button class='enlace' type='submit' name='btnEquipo' >Equipo " . $contador . "</button>";
                echo "<input type='hidden' name='dia' value='" . $dia . "'/>";
                echo "<input type='hidden' name='hora' value='" . $hora . "'/>";
                echo "<input type='hidden' name='contador' value='" . $contador . "'/>";
                echo "</form>";
                echo '</td>';
                $contador++;
            }
            echo '<tr>';
        }
    }
    echo '</table>';
    if(isset($_POST["btnEquipo"])||isset($_POST["btnProfe"])){
        echo "<h2>EQUIPO DE GUARDIA ". $_POST["contador"] ."</h2>";
        //si no esta en la guardia sale un mensaje si esta sale otra tabla
        if($guardia==false){
            echo "<h3>¡¡Atención, usted no se encuentra en la guardia del ".$dias[$_POST["dia"]]." a ".$horas[$_POST["hora"]]." !!</h3>";
        }else{
            echo "<h3>".$dias[$_POST["dia"]]." a ".$horas[$_POST["hora"]]." !!</h3>";
            echo '<table>';
            echo '<tr><th>Profesores de guardia</th><th>Información del profesor con id_usuario: </th></tr>';
            foreach($profesores_guardia as $profesor){
                echo '<tr>';
                echo '<td>'.$profesor["nombre"].'</td>';
                echo '<td>';
                echo "<form action='index.php' method='post'><button class='enlace' type='submit' name='btnProfe'>Profesor ".$profesor["id_usuario"]."</button>";
                echo "<input type='hidden' name='dia' value='" . $_POST["dia"] . "'/>";
                echo "<input type='hidden' name='hora' value='" . $_POST["hora"] . "'/>";
                echo "<input type='hidden' name='numero' value='" . $_POST["numero"] . "'/>";
                echo "<input type='hidden' name='id_usuario' value='".$profesor["id_usuario"]."'/>";
                echo '</form>';
                echo '</td>';

                if (isset($_POST["btnProfe"])) {
                    echo "<td rowspan=".count($profesores).">";
                    echo "<p><strong>Nombre: </strong></p>";
                    echo "<p><strong>Usuario: </strong></p>";
                    echo "<p><strong>Contraseña: </strong></p>";
                    echo "<p><strong>Email : </strong></p>";
                    echo "</td>";
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }
    
    ?>
</body>

</html>