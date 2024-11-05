<?php
//constantes de la BD
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_foro";

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
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_pagina("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}
//si existe la consulta y el botón borrar
if (isset($_POST["btnDetalle"])||isset($_POST["btnBorrar"])) {
    if (isset($_POST["btnDetalle"])) $id_usuario=$_POST["btnDetalles"];
    else $id_usuario=$_POST["btnBorrar"];

    
    try {
        $consulta="select * from usuarios where id_usuario='".$id_usuario."'";
        $detalle_usuario=mysqli_query($conexion,$consulta);
    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

//consulta para poder borrar un usuario
if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta="delete from usuarios where id_usuario='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
        $mensaje_accion="Usuario borrado con éxito";
    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}
//consulta
try {
    $consulta="select * from usuarios";
    $datos_usuarios=mysqli_query($conexion,$consulta);

} catch (Exception $e) {
    mysqli_close($conexion); //lo cerramos si no hace la consulta
    die(error_pagina("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

mysqli_commit($conexion);



if (isset($_POST["btnContAgregar"])) {
    //comprobamos errores en el formulario
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_email = $_POST["email"] == "";
    
    $errores_form = $error_nombre|| $error_usuario || $error_clave|| $error_email;
}
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

        .mensaje {
            font-size: 1.25rem;
            color: aquamarine
        }
        .error{
            color: crimson;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <h1>Lista de los usuarios</h1>

    <?php
    require "vistas/vista_tabla_principal.php";

    if(isset($mensaje_accion))
        echo "<p class='mensaje'>".$mensaje_accion."</p>";

    if(isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if(isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if(isset($_POST["btnAgregar"])&& !$errores_form){
        require "vistas/vista_agregar.php";

    }else{
        require "vistas/vista_agregar.php";

    }
        
    ?>
</body>

</html>