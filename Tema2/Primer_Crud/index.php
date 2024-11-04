<?php
//constantes de la BD
const SERVIDOR_BD = 'localhost';
const USUARIO_BD = 'jose';
const CLAVE_BD = 'josefa';
const NOMBRE_BD = 'bd_foro';

function error_pagina($title, $body)
{
    return '<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . '</title>
</head>

<body>' . $body . '</body>

</html>';
}

//probamos la conexión
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    //hay que indicar que los datos sean utf8
    mysqli_set_charset($conexion, 'utf8');
} catch (Exception $e) {
    die(error_pagina("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}
//si existe la consulta
if (isset($_POST["btnDetalle"])) {
    try {
        $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
        //la función que hace la consulta es   
        $detalle_usuario = mysqli_query($conexion, $consulta);
        //esto nos devolverá un recurso

    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


//consulta para poder seleccionar un usuario a borrar
if (isset($_POST["btnBorrar"])) {
    try {
        $consulta = "select * from usuarios where id_usuario='" . $_POST["btnBorrar"] . "'";
        //la función que hace la consulta es   
        $usuario_borrar = mysqli_query($conexion, $consulta);
        //esto nos devolverá un recurso

    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}
//consulta para poder borrar un usuario
if (isset($_POST["btnBorrar_Continuar"])) {
    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnBorrar_Continuar"] . "'";
        //la función que hace la consulta es   
        $usuario_borrar_definitivo = mysqli_query($conexion, $consulta);
        //esto nos devolverá un recurso

    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}
//consulta
try {
    $consulta = "select * from usuarios";
    //la función que hace la consulta es   
    $datos_usuarios = mysqli_query($conexion, $consulta);
    //esto nos devolverá un recurso

} catch (Exception $e) {
    mysqli_close($conexion); //lo cerramos si no hace la consulta
    die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

mysqli_commit($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .btn_img {
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Lista de los usuarios</h1>

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
    echo "</table>";
    mysqli_free_result($datos_usuarios);


    if (isset($_POST["btnDetalle"])) {
        echo "<h2>Detalles del usuario " . $_POST["btnDetalle"] . " </h2>";
        //si hay tuplas
        if (mysqli_num_rows($detalle_usuario) > 0) {
            $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);

            echo "<div>";
            echo "<strong>Nombre: </strong>" . $tupla_detalles["nombre"] . "<br>";
            echo "<strong>Usuario: </strong>" . $tupla_detalles["usuario"] . "<br>";
            echo "<strong>Clave: </strong><br>";
            echo "<strong>Email: </strong>" . $tupla_detalles["email"] . "<br>";
            echo "</div>";
        } else {
            echo "<p>El usuario seleccionado ya no se encuentra registrado</p>";
        }
        mysqli_free_result($detalle_usuario);
    }


    //si pulsamos borrar
    if (isset($_POST["btnBorrar"])) {
        if (mysqli_num_rows($usuario_borrar) > 0) {
            $tupla_detalles = mysqli_fetch_assoc($usuario_borrar);


            echo "<p>Se dispone a borrar a <strong>" . $tupla_detalles["nombre"] . "</strong></p>";
            echo "<p>";
            echo "<form action='index.php' method='post'><button type='submit' name='btnBorrar_Continuar' value'".$_POST["btnBorrar"]."'>Continuar</button>";
            if (isset($_POST["btnBorrar_Continuar"])) {
               echo "<p>Borrado con éxito</p>";
               
            }
            echo "<button type='submit' name='btnAtras'>Atras</button></form>";
            echo "</p>";
        } else {
            echo "<p>El usuario seleccionado ya no se encuentra registrado</p>";
        }
        mysqli_free_result($usuario_borrar);
    }
    ?>
</body>

</html>