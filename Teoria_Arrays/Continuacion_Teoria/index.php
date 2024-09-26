<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continuación de la teoría de arrays</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php


    $notas["Dani"] = 7;

    $notas["Tomas"] = 3;

    $notas["Clara"] = 5.5;


    echo "<h1>Notas de los alumnos de 2ºDAW en la asignatura DWESE</h1>";

    //forma normal de recorrer un array y rellenarlo
    echo "<table>";
        echo "<tr>";
            echo "<th>Alumno</th>";
            echo "<th>Nota</th>";
        echo "</tr>";

  /*  foreach ($notas as $nombre => $valor_nota) {
        echo "<tr>";
        echo "<td>".$nombre."</td>";
        echo "<td>".$valor_nota."</td>";
        echo "</tr>";
    }*/

    //con funciones
    while (current($notas)) {
        echo "<tr>";
        echo "<td>".key($notas)."</td>";
        echo "<td>".current($notas)."</td>";
        echo "</tr>";
        next($notas);
    }
    echo "</table>";

 
    ?>
</body>

</html>