<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
    <style>
        table,
        td,
        th {
            border: 1px, solid, black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
        $estadios_futbol = array(
            "Barcelona" => "Camp Nou",
            "Real Madrid" => "Santiago Bernabeu",
            "Valencia" => "Mestalla",
            "Real Sociedad" => "Anoeta"
        );
        echo"<h1>Estadios de futbol</h1>";
        echo "<table>";
        echo "<tr><th>Ciudad</th><th>Nombre del estadio</th></tr>";
        foreach ($estadios_futbol as $ciudad => $nombre_estadio) {
            echo "<tr><td>" . $ciudad . "</td><td>" . $nombre_estadio . "</td></tr>";
        }
        echo "</table>";
        unset($estadios_futbol["Real Madrid"]); //borramos el estadio del real madrid
        echo "<h2>Resultados después de borrar el estadio del real madrid</h2>";
        echo "<ol>";
        foreach ($estadios_futbol as $ciudad => $nombre_estadio) {
            echo "<li>" . $ciudad . ": " . $nombre_estadio . "</li>";
        }
        echo "</ol>";
    ?>
</body>

</html>