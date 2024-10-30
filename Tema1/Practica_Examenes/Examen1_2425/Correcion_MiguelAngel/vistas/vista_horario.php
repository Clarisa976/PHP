<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1 PHP</title>
    <style>
        .txt_centrado{text-align: center;}
        table,th,td{border:1px solid black}
        table{width:85%;margin: 0 auto;border-collapse:collapse}
        th{background-color:#CCC}
    </style>
</head>
<body>
<h1>Ejercicio 4</h1>
<h2>Reserva de aulas</h2>
<form action="ejercicio4.php" method="post">
    <p>
        <label for="semana">Elija la Semana: </label>
        <select name="semana" id="semana">
        <?php
        while($linea=fgets($fd))
        {
            $datos_linea=explode(";",$linea);
            if(isset($_POST["semana"])&& $_POST["semana"]==$datos_linea[0])
            {
                echo "<option selected value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";
                $semana_seleccionada=$datos_linea[1];
                for($k=1;$k<=5;$k++)
                {
                    $linea=fgets($fd);
                    $datos_linea=explode(";",$linea);
                    for($j=1;$j<count($datos_linea);$j+=2)
                    {
                        if(isset($datos_semana[$k][$datos_linea[$j]]))
                            $datos_semana[$k][$datos_linea[$j]].="<br>".$datos_linea[$j+1];
                        else
                            $datos_semana[$k][$datos_linea[$j]]=$datos_linea[$j+1];
                    }

                }
            } 
            else
            {
                echo "<option value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";

                for($k=1;$k<=5;$k++)
                {
                    $linea=fgets($fd);
                }
            }
               
        }
        ?>
        </select>
        <button type="submit" name="btnVerSemana">Ver Semana</button>
    </p>
</form>
<?php
const DIAS_SEMANA=array(1=>"Lunes","Martes","Miércoles","Jueves","Viernes");
const HORAS_CLASES=array(1=>"8:15 - 9:15","9:15 - 10:15","10:15 - 11:15","11:15 - 11:45","11:45 - 12:45","12:45 - 13:45","13:45 - 14:45");

if(isset($_POST["btnVerSemana"]))
{
    
    echo "<h2 class='txt_centrado'>".$semana_seleccionada."</h2>";

    echo "<table class='txt_centrado'>";
    echo "<tr>";
    echo "<th></th>";
    for($i=1;$i<=5;$i++)
        echo "<th>".DIAS_SEMANA[$i]."</th>";
    echo "</tr>";
    for($hora=1;$hora<=7;$hora++)
    {
        echo "<tr>";
        echo "<th>".HORAS_CLASES[$hora]."</th>";
        if($hora==4)
            echo "<td colspan='4'>RECREO</td>";
        else
        {
            for($dia=1;$dia<=5;$dia++)
            {
                if(isset($datos_semana[$dia][$hora]))
                    echo "<td>".$datos_semana[$dia][$hora]."</td>";
                else
                    echo "<td></td>";
            }
        }
        
        echo "</tr>";
    }
    echo "</table>";

}
?>
</body>
</html>