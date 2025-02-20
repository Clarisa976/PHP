<?php
    echo "<table class='centrado'>";
        echo "<tr><th>Código</th><th>Nombre</th><th>PVP</th><th><form action='index.php' method='post'><button type='submit' name='btnAgregar' class='enlace'>Usuario+</button></form></th></tr>";
        foreach ($json_productos["productos"] as $tupla) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button title='Pulse para ver detalles' class='enlace' name='btnDetalles' value='" . $tupla["cod"] . "' type='submit' >" . $tupla["cod"] . "</button></form></td>";
            echo "<td>" . $tupla["nombre_corto"] . "</td>";
            echo "<td>" . $tupla["PVP"] . "</td>";
            echo "<td><form action='index.php' method='post'><input name='id_usuario' type='hidden' value='" . $tupla["cod"] . "'/><button class='enlace' type='submit' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar'>Editar</button></form></td>";
            echo "</tr>";
        }
    echo "</table>";
?>