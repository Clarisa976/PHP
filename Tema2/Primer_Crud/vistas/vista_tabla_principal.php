<?php
    echo "<table>";
    echo "<tr>";
    echo "<th>Nombre usuario</th><th>Borrar</th><th>Editar</th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {

        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button type='submit' title='Ver detalles' class='enlace' name='btnDetalle' value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' class='btn_img' name='btnBorrar' value='" . $tupla["id_usuario"] . "'><img src='images/borrar.png' title='Borrar' alt='borrar'></button></form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' class='btn_img' name='btnEditar' value='" . $tupla["id_usuario"] . "' ><img src='images/editar.png' title='Editar' alt='Editar'></button></form></td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='3'><form action='index.php' method='post'><button type='submit' class='enlace' name='btnAgregar' value='' >Agregar usuario</button></form></td></tr>";
    echo "</table>";
    mysqli_free_result($datos_usuarios);
    
?>