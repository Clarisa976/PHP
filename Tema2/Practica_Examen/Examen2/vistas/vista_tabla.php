<?php
if (isset($_SESSION["horario_profe"])) {
    $profe = $_SESSION["horario_profe"];
} else {
    $profe = $_POST["horario_profe"];
}

//consulta para seleccionar las horas, el dia, los grupos del profe seleccionado
try {
    $consulta = "select usuario, dia, hora, grupo, nombre from grupos, horario_lectivo where id_grupo=grupo and usuario='".$profe."'";
    $resultado = mysqli_query($conexion,$consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die("Examen2,<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>");
}
while($tupla = mysqli_fetch_assoc($resultado)){
    if (isset($horario_profe[$tupla["hora"]][$tupla["dia"]])) {
        //si hay más de un grupo 
        $horario_profe[$tupla["hora"]][$tupla["dia"]] .= " / " . $tupla["nombre"];
    } else {
        $horario_profe[$tupla["hora"]][$tupla["dia"]] = $tupla["nombre"];
    }
}
//tabla

$horas[1] = "8:15-9:15";
$horas[] = "9:15-10:15";
$horas[] = "10:15-11:15";
$horas[] = "11:15-11:45";//recreo
$horas[] = "11:45-12:45";
$horas[] = "12:45-13:45";
$horas[] = "13:45-14:45";

echo "<table id='horario'>";
$semana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
echo "<tr><th></th>";
foreach ($semana as $dia) {
    echo "<th>$dia</th>";
}
echo "</tr>";
for ($hora = 1; $hora <= 7; $hora++) {
    echo "<tr>";
    echo "<th>" . $horas[$hora] . "</th>";
    //si es la cuarta hora le ponemos recreo
    if ($hora == 4) {
        echo "<td colspan='5'>RECREO</td>";
    } else {
        for ($dia = 1; $dia <= 5; $dia++) {
            if (isset($horario_profe[$dia][$hora])) {
                echo "<td>" . $horario_profe[$dia][$hora] . "</td>";
            } else {
                echo "<td></td>";
            }
        }
    }
    echo "</tr>";
}
echo"</table>";
