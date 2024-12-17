<?php
session_name("p8_pdo");
session_start();
require "src/funciones_ctes.php";

try {
    $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (Exception $e) {
    session_destroy();
    die(error_page("Práctica 8 PDO", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

// A partir de aquí tengo conexión con mi BD

if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta = "DELETE FROM usuarios WHERE id_usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$_POST["btnContBorrar"]]);
        
        if ($_POST["foto_bd"] != NOMBRE_IMAGEN_DEFECTO_BD) {
            unlink("Img/" . $_POST["foto_bd"]);
        }

        $_SESSION["mensaje_accion"] = "Usuario borrado con éxito";
        header("Location:index.php");
        exit;
    } catch (Exception $e) {
        $sentencia = null;
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


if (isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"])) {
    if (isset($_POST["btnDetalles"]))
        $id_usuario = $_POST["btnDetalles"];
    else
        $id_usuario = $_POST["id_usuario"];

    try {
        $consulta = "SELECT * FROM usuarios WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
        $detalles_usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
        $sentencia = null;
    } catch (Exception $e) {
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnContBorrarFoto"])) {
    try {
        $consulta = "UPDATE usuarios SET foto=? WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([NOMBRE_IMAGEN_DEFECTO_BD, $_POST["btnContBorrarFoto"]]);
        
        unlink("Img/" . $_POST["foto_bd"]);
        $_SESSION["mensaje_accion"] = "Foto de perfil borrada con éxito";
        header("Location:index.php");
        exit;
    } catch (Exception $e) {
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnContEditar"])) {
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["btnContEditar"]);

        if (is_string($error_usuario)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>" . $error_usuario . "</p>"));
        }
    }

    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($_POST["dni"]) || !dni_valido($_POST["dni"]);
    if (!$error_dni) {
        $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]), "id_usuario", $_POST["btnContEditar"]);
        if (is_string($error_dni)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>" . $error_dni . "</p>"));
        }
    }

    $error_foto = ($_FILES["foto"]["name"] != "") && (
                    $_FILES["foto"]["error"] ||
                    !tiene_extension($_FILES["foto"]["name"]) ||
                    !getimagesize($_FILES["foto"]["tmp_name"]) ||
                    $_FILES["foto"]["size"] > 500 * 1024
                  );

    $error_form_editar = $error_nombre || $error_usuario || $error_dni || $error_foto;

    if (!$error_form_editar) {
        // Si no hay errores, actualizamos los datos del usuario
        try {
            if ($_POST["clave"] == "") {
                $consulta = "UPDATE usuarios 
                             SET nombre = :nombre, usuario = :usuario, dni = :dni, sexo = :sexo 
                             WHERE id_usuario = :id_usuario";
                $parametros = [
                    ':nombre' => $_POST["nombre"],
                    ':usuario' => $_POST["usuario"],
                    ':dni' => strtoupper($_POST["dni"]),
                    ':sexo' => $_POST["sexo"],
                    ':id_usuario' => $_POST["btnContEditar"]
                ];
            } else {
                $consulta = "UPDATE usuarios 
                             SET nombre = :nombre, usuario = :usuario, clave = :clave, dni = :dni, sexo = :sexo
                             WHERE id_usuario = :id_usuario";
                $parametros = [
                    ':nombre' => $_POST["nombre"],
                    ':usuario' => $_POST["usuario"],
                    ':clave' => md5($_POST["clave"]),
                    ':dni' => strtoupper($_POST["dni"]),
                    ':sexo' => $_POST["sexo"],
                    ':id_usuario' => $_POST["btnContEditar"]
                ];
            }

            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute($parametros);

        } catch (Exception $e) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }

        $_SESSION["mensaje_accion"] = "Usuario editado con éxito";

        // Si se sube una nueva foto
        if ($_FILES["foto"]["name"] != "") {
            $array_nombre = explode(".", $_FILES["foto"]["name"]);
            $ext = end($array_nombre);
            $nombre_nuevo = "img_" . $_POST["btnContEditar"] . "." . $ext;

            if (@move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_nuevo)) {
                if ($nombre_nuevo != $_POST["foto_bd"]) {
                    try {
                        $consulta = "UPDATE usuarios SET foto = :foto WHERE id_usuario = :id_usuario";
                        $sentencia = $conexion->prepare($consulta);
                        $sentencia->execute([
                            ':foto' => $nombre_nuevo,
                            ':id_usuario' => $_POST["btnContEditar"]
                        ]);

                        if ($_POST["foto_bd"] != NOMBRE_IMAGEN_DEFECTO_BD) {
                            unlink("Img/" . $_POST["foto_bd"]);
                        }

                    } catch (Exception $e) {
                        unlink("Img/" . $nombre_nuevo);
                        $_SESSION["mensaje_accion"] = "Usuario editado con éxito, pero con la imagen por defecto.";
                    }
                }
            } else {
                $_SESSION["mensaje_accion"] = "Usuario editado con éxito, pero con la imagen por defecto.";
            }
        }

        header("Location:index.php");
        exit;
    }
}


if (isset($_POST["btnContAgregar"])) {
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
        if (is_string($error_usuario)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>" . $error_usuario . "</p>"));
        }
    }
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($_POST["dni"]) || ! dni_valido($_POST["dni"]);
    if (!$error_dni) {
        $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]));
        if (is_string($error_dni)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>" . $error_dni . "</p>"));
        }
    }

    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024);
    $error_form_agregar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_foto;
    if (!$error_form_agregar) {
        try {
            $consulta = "INSERT INTO usuarios (nombre, usuario, clave, dni, sexo) 
                         VALUES (:nombre, :usuario, :clave, :dni, :sexo)";
            
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([
                ':nombre' => $_POST["nombre"],
                ':usuario' => $_POST["usuario"],
                ':clave'   => md5($_POST["clave"]),
                ':dni'     => strtoupper($_POST["dni"]),
                ':sexo'    => $_POST["sexo"]
            ]);
            
            $ultm_id = $conexion->lastInsertId();
        
        } catch (Exception $e) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }

        $_SESSION["mensaje_accion"] = "Usuario insertado con éxito.";
        if (!empty($_FILES["foto"]["name"])) {
            $array_nombre = explode(".", $_FILES["foto"]["name"]);
            $ext = end($array_nombre);
            $nombre_nuevo = "img_" . $ultm_id . "." . $ext;
        
            if (@move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_nuevo)) {
                try {
                    $consulta = "UPDATE usuarios SET foto = :foto WHERE id_usuario = :id_usuario";
                    $sentencia = $conexion->prepare($consulta);
                    $sentencia->execute([
                        ':foto' => $nombre_nuevo,
                        ':id_usuario' => $ultm_id
                    ]);
                } catch (Exception $e) {
                    unlink("Img/" . $nombre_nuevo);
                    $_SESSION["mensaje_accion"] = "Usuario insertado con éxito, pero con la imagen por defecto.";
                }
            } else {
                $_SESSION["mensaje_accion"] = "Usuario insertado con éxito, pero con la imagen por defecto.";
            }
        }

        header("Location:index.php");
        exit();
    }
}

/// Por último hago la consulta para listar los usuarios de la tabla principal
try {
    $consulta = "SELECT * FROM usuarios";
    $result_datos_usuarios = $conexion->prepare($consulta);
    $result_datos_usuarios->execute();
    $usuarios = $result_datos_usuarios->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $conexion = null;
    $result_datos_usuarios = null;
    session_destroy();
    die(error_page("Práctica 8 PDO", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

$conexion = null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8 PDO</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center
        }

        img {
            height: 100px
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Práctica 8 PDO</h1>
    <?php
    if (isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if (isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if (isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form_agregar))
        require "vistas/vista_agregar.php";

    if (isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form_editar))
        require "vistas/vista_editar.php";

    if (isset($_POST["btnBorrarFoto"]))
        require "vistas/vista_borrar_foto.php";

    if (isset($_SESSION["mensaje_accion"])) {
        echo "<p class='mensaje'>¡¡ " . $_SESSION["mensaje_accion"] . " !!</p>";
        session_destroy();
    }

    require "vistas/vista_tabla_principal.php";
    ?>
</body>

</html>
