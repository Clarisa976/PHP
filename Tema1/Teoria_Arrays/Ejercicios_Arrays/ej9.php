<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
    <style>
        table,
        td,
        tr {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
        /*crea un array lenguaje clientes y otra lenguajes servidor, 
        con los valores que quieras
        y poniendo un índice alfanumérico. 
        Junta ambas arrays en una sola tabla llamada lenguajes y muestrala*/
        $lenguajes_cliente["LC1"] = "HTML";
        $lenguajes_cliente["LC2"] = "JavaScript";
        $lenguajes_cliente["LC3"] = "CSS";

        $lenguajes_servidor["LD1"] = "PHP";
        $lenguajes_servidor["LD2"] = "JSP";
        $lenguajes_servidor["LD3"] = "ASP";

        echo "<h1>Lenguajes</h1>";
        //usamos array merge para unir dos arrays
        $lenguajes = array_merge($lenguajes_cliente, $lenguajes_servidor);
        echo "<table>";
        echo "<tr><th>Índice</th><th>Valor</th></tr>";
        foreach ($lenguajes as $indice => $valor) {
            echo "<tr>
                    <td>".$indice."</td>
                    <td>".$valor."</td>
                 </tr>";
        }
        echo "</table>";
    ?>

</body>

</html>