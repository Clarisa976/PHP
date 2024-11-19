<?php
//errores del formulario
if (isset($_POST["btnLogin"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form_login = $error_usuario || $error_clave;

    //si no hay errores
    if (!$error_form_login) {
        //conexión
        try {
            @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            //cambiamos el charset
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
        }
        //consulta
        try {
            $consulta = "select usuario from usuarios where usuario='" . $_POST["usuario"] . "' AND clave='" . md5($_POST["clave"]) . "'";
            //si está el usuario se incia sesión y salta a index
            $resultado = mysqli_query($conexion, $consulta);
            $n_tuplas=mysqli_num_rows($resultado);
            mysqli_free_result($resultado);
            if ($n_tuplas > 0) {
                mysqli_close($conexion);
                
                $_SESSION["usuario"] = $_POST["usuario"];
                header("Location:index.php");
                exit;
            } else {

                $error_usuario = true;
            }
        } catch (Exception $e) {
            mysqli_close($conexion);

            die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
        //sino informa de los errores
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer login </title>
    <style>
        .error {
            color: crimson
        }
    </style>
</head>

<body>
    <h1>Primer login </h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario..." value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>">
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "") {
                    echo "<span class='error'> Campo vacio</span>";
                } else {
                    echo "<span class='error'> Usuario y/o contraseña no encontrado</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave">

            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'> Campo vacio</span>";
            }
            ?>
        </p>
        <p><button type="submit" name="btnLogin">Login</button></p>
    </form>
</body>

</html>