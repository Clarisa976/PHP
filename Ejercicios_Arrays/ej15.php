<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
    <style>
        table, td, th{
            border: 1px, solid, black;
        }
        table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
        echo "<h1>Ordenar un array y colocarlo en una tabla</h1>";
        $numeros=array(3,2,8,123,5,1);
        asort($numeros);//ordenamos

        echo "<table>";
        echo "<tr>";
            echo "<td>Índice</td>";
            echo "<td>Valor</td>";
        echo "</tr>";
        foreach ($numeros as $indice => $valor) {
            echo "<tr>
                    <td>".$indice."</td>
                    <td>".$valor."</td>
                </tr>";
        }
        
        echo "</table>";


    ?>
</body>
</html>