<?php
//variable de sesión
session_start();

require "src/funciones_ctes.php";

//establecer la conexión con la base de datos
try {
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    //indicar que la conexión es uft8
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_pagina("Práctica 8", "<p>Error al intentar conectar con la base de datos: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"]) || isset($_POST["btnDetalle"])) {
    if (isset($_POST["btnBorrar"])) {
        $id_usuario = $_POST["btnBorrar"];
    } else if (isset($_POST["btnEditar"])) {
        $id_usuario = $_POST["btnEditar"];
    } else {
        $id_usuario = $_POST["btnDetalle"];
    }


    try {
        $consulta = "select * from usuarios where  id_usuario = '" . $id_usuario . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

//consulta de borrar un usuario
if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
        //mensaje de confirmación
        $_SESSION["mensaje_accion"] = "Usuario borrado con éxito";
        header("Location:index.php");
        exit;

    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


//consulta agregar
if (isset($_POST["btnContAgregar"])) {
    //errores del formulario
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 50;

    //si el usuario ya existe
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
        if (is_string($error_usuario)) {
            mysqli_close($conexion);
            die(error_pagina("Práctica 8", "<p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    }

    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 50;
    $dni_numero = substr($_POST["dni"], 0, -1);
    $dni_letra = strtoupper(substr($_POST["dni"], -1));
    $error_dni = $_POST["dni"] == "" || LetraNIF($dni_numero) != substr($dni_letra, -1);

    //si el DNI ya existe
    /* if (!$error_dni) {
         $error_dni = repetido($conexion, "usuarios", "dni", $dni_may);
         if (is_string($error_dni)) {
             mysqli_close($conexion);
             die(error_pagina("Práctica 8", "<p>No se ha podido realizar la consulta: ".$error_dni."</p>"));
         }
     }*/

    $error_sexo = !isset($_POST["sexo"]);
    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024);


    //errores
    $error_formulario_agregar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_foto;

    // Si no hay errores, proceder con la inserción en la base de datos
    if (!$error_formulario_agregar) {
        try {
            // Establecer 'no_imagen.jpg' como valor por defecto
            $nombre_foto = 'no_imagen.jpg';

            // Si se ha subido una foto, procesarla
            if ($_FILES["foto"]["name"] != "") {
                $extension = tiene_extension($_FILES["foto"]["name"]);
                // Generar un nombre único para la imagen
                $nombre_foto = "img_" . time() . "." . $extension;

                if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_foto)) {
                    // Si no se pudo mover la imagen, establecer 'no_imagen.jpg'
                    $nombre_foto = 'no_imagen.jpg';
                }
            }

            // Insertar el nuevo usuario en la base de datos
            $consulta = "INSERT INTO usuarios (nombre, usuario, clave, dni, sexo, foto) VALUES ('" . $_POST["nombre"] . "', '" . $_POST["usuario"] . "', '" . md5($_POST["clave"]) . "', '" . $_POST["dni"] . "', '" . $_POST["sexo"] . "', '" . $nombre_foto . "')";
            mysqli_query($conexion, $consulta);

            $_SESSION["mensaje_accion"] = "Usuario insertado con éxito";
            header("Location:index.php");
            exit;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }


}

//NO FUNCIONA :D
//consulta editar
if (isset($_POST["btnContEditar"])) {
    //Compruebo errores
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
        if (is_string($error_usuario)) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>" . $error_usuario . "</p>"));
        }

    }
    $error_clave = $_POST["clave"] == "";
    $numeroDNI = substr($_POST["dni"], 0, -1); // Extraer los números 
    $letraDNI = strtoupper(substr($_POST["dni"], -1));     // Extraer la letra 
    $error_dni = $_POST["dni"] == "" || LetraNIF($numeroDNI) != substr($letraDNI, -1);
    $error_sexo = !isset($_POST["sexo"]);
    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024);

    $error_formulario_editar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_foto;

    //Si no hay errores inserto en la tabla e informo de la acción
    if (!$error_formulario_editar) {
        try {
            // Actualizar datos del usuario sin la foto inicialmente
            if ($_POST["clave"] == "") {
                $consulta = "UPDATE usuarios SET 
                    nombre='" . $_POST["nombre"] . "',
                    usuario='" . $_POST["usuario"] . "',
                    dni='" . $_POST["dni"] . "',
                    sexo='" . $_POST["sexo"] . "'
                    WHERE id_usuario='" . $_POST["id_usuario"] . "'";
            } else {
                $consulta = "UPDATE usuarios SET 
                    nombre='" . $_POST["nombre"] . "',
                    usuario='" . $_POST["usuario"] . "',
                    clave='" . md5($_POST["clave"]) . "',
                    dni='" . $_POST["dni"] . "',
                    sexo='" . $_POST["sexo"] . "'
                    WHERE id_usuario='" . $_POST["id_usuario"] . "'";
            }
            mysqli_query($conexion, $consulta);

            // Procesar la imagen si se ha subido una nueva
            if ($_FILES["foto"]["name"] != "") {
                // Obtener la extensión del archivo
                $extension = tiene_extension($_FILES["foto"]["name"]);

                // Generar un nombre único para la imagen usando el id_usuario
                $nombre_foto = "img_" . $_POST["id_usuario"] . "." . $extension;

                // Mover la imagen al directorio Img/
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_foto)) {
                    // Actualizar el campo foto en la base de datos
                    $consulta = "UPDATE usuarios SET foto='" . $nombre_foto . "' WHERE id_usuario='" . $_POST["id_usuario"] . "'";
                    mysqli_query($conexion, $consulta);

                    // Eliminar la imagen antigua si no es 'no_imagen.jpg'
                    if ($_POST["foto_bd"] != 'no_imagen.jpg') {
                        unlink("Img/" . $_POST["foto_bd"]);
                    }
                } else {
                    echo "<p>No se pudo mover la imagen al directorio destino.</p>";
                }
            }

            $_SESSION["mensaje_accion"] = "Usuario editado con éxito";
            header("Location:index.php");
            exit;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
}
/*if (isset($_POST["btnContEditar"])) {

    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 30;
    //comprobar si está repetido
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["btnContEditar"]);
        if (is_string($error_usuario)) {
            mysqli_close($conexion);
            die(error_pagina("Primer CRUD", "<p>" . $error_usuario . "</p>"));
        }
    }
    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 50;
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $dni_metido = strtoupper($_POST["dni"]);
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($dni_metido) || !dni_valido($dni_metido);
    //comprobar si está repetido
    if (!$error_dni) {
        $error_dni = repetido($conexion, "usuarios", "dni", $_POST["dni"], "id_usuario", $_POST["btnContEditar"]);
        if (is_string($error_dni)) {
            mysqli_close($conexion);
            die(error_pagina("Primer CRUD", "<p>" . $error_dni . "</p>"));
        }
    }
    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !getimagesize($_FILES["foto"]["tmp_name"]) || !tiene_extension($_FILES["foto"]["name"]) || $_FILES["foto"]["size"] > 500 * 1024);

    $error_formulario_editar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_foto;

    //si el formulario editar no tiene errores
    if (!$error_formulario_editar) {
        try {
            //si cambia o no la contraseña
            if ($_POST["clave"] == "")
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', dni='" . $dni_may . "' where  id_usuario='" . $_POST["btnContEditar"] . "'";
            else
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', clave='" . md5($_POST["clave"]) . "', dni='" . $dni_may . "' where  id_usuario='" . $_POST["btnContEditar"] . "'";

            $resultado_editar = mysqli_query($conexion, $consulta);
            $_SESSION["mensaje_accion"] = "Usuario editado con éxito";
            header("Location:index.php");
            exit;
        } catch (Exception $e) {
            mysqli_close($conexion); //lo cerramos si no hace la consulta
            die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }

        //si cambia o no la foto
        //try {
        if ($_FILES["foto"]["name"] != "") {
            $array_nombre = explode(".", $_FILES["foto"]["name"]);
            $nombre_foto = "img_" . $_POST["id_usuario"] . "." . end($array_nombre);

            @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_foto);
            if ($var) {
                if ($_POST["foto_bd"] != $nombre_foto) {
                    //Actualizo en BD
                    try {
                        $consulta = "update usuarios set foto='" . $nombre_foto . "' where id_usuario='" . $_POST["id_usuario"] . "'";
                        mysqli_query($conexion, $consulta);
                    } catch (Exception $e) {
                        //Al no poder actualizar borro la nueva que acabo de mover
                        unlink("Img/" . $nombre_foto);
                        mysqli_close($conexion);
                        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
                    }
                    //Borro la antigua que había con otra extensión
                    unlink("Img/" . $_POST["foto_bd"]);
                }
            }
        }


        mysqli_close($conexion);
        header("Location:index.php");
        exit;

    }

}*/
//pedimos los datos de usuario
try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_pagina("Práctica 8", "<p>Error al intentar conectar con la base de datos: " . $e->getMessage() . "</p>"));
}

//cerrar la conexión con la base de datos
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica </title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
            width: 100%;

        }

        th {
            background-color: lightgray;
            padding: 0.5rem;
        }

        .error {
            color: crimson;
            font-weight: bolder;
        }

        img {
            width: 20%;
            height: auto;
        }


        table th:nth-child(1),
        table td:nth-child(1) {
            width: 20px;
        }

        table th:nth-child(2),
        table td:nth-child(2) {
            width: 30%;
        }


        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .mensaje {
            font-size: 1.25rem;
            color: cornflowerblue;
        }
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <?php

    if (isset($_SESSION["mensaje_accion"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje_accion"] . "</p>";
        session_destroy();
    }
    require "vistas/vista_tabla_usuarios.php";


    if (isset($_POST["btnDetalle"]))
        require "vistas/vista_detalles.php";

    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }


    if (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"]) && $error_formulario_editar) {
        require "vistas/vista_editar.php";
    }

    if (isset($_POST["btnAgregar"]) || isset($_POST["btnContAgregar"]) && $error_formulario_agregar) {
        require "vistas/vista_agregar.php";
    }

    ?>
</body>

</html>