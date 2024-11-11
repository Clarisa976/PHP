<?php
    echo "<h3>Listado de usuarios</h3>";
    echo "<table>";
    echo "<tr>";
    echo "<th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'><button type='submit' class='enlace' name='btnAgregar' value=''>Usuario+</button></form></th>";
    echo "</tr>";
    //rellenamos la tabla
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        //echo "<td><img src='Img/" . $tupla["foto"] . "?" . time() . "' alt='foto usuario' title='foto usuario'></td>";
        echo "<td><img src='Img/" . $tupla["foto"] ."' alt='foto usuario' title='foto usuario'></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnDetalle' value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' name='btnBorrar' class='enlace' value='" . $tupla["id_usuario"] . "'>Borrar</button> <span> - </span><button type='submit' name='btnEditar' class='enlace' value='" . $tupla["id_usuario"] . "'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";
    //liberamos el recurso
    mysqli_free_result($datos_usuarios);
    ?>