<?php
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
for ($hora = 1; $hora <= count($horas); $hora++) {
    echo "<tr>";
    echo "<th>" . $horas[$hora] . "</th>";
    //si es la cuarta hora le ponemos recreo
    if ($hora == 4) {
        echo "<td colspan='5'>RECREO</td>";
    } else {
        for ($dia = 1; $dia <= count($semana); $dia++) {
            echo "<td>";
            if (isset($horario_profe[$dia][$hora])) 
                echo $horario_profe[$dia][$hora];
           
                echo "<form action='index.php' method='post'>";
                echo "<input type='hidden' name='dia' value='".$dia."'>";
                echo "<input type='hidden' name='hora' value='".$hora."'>";
                echo "<input type='hidden' name='horario_profe' value='".$_POST["horario_profe"]."'>";
                echo "<button class='enlace' type='submit' name='btnEditar'>Editar</button>";
                echo "</form>";
            
            echo "</td>";
        }
    }
    echo "</tr>";
}
echo"</table>";
