<?php
if (isset($_POST['btnEntrar'])) {

    //errores formulario
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST['clave'] == "";
    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {
        //llamamos a la api
        $url = DIR_SERV . "/login";
        $datos_env['usuario'] = $_POST['usuario'];
        $datos_env['clave'] = md5($_POST['clave']);
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $json = json_decode($respuesta, true);

        if (!$json) {
            session_destroy();
            die(error_page("Examen", "<p>Error consumiendo: " . $url . "</p>"));
        }

        if (isset($json['error'])) {
            session_destroy();
            die(error_page("Examen", "<p>" . $json['error'] . "</p>"));
        }

        if (isset($json['usuario'])) {
            $_SESSION['ult_accion'] = time();
            $_SESSION['token'] = $json['token'];
            header("Location:index.php");
            exit;
        } else {
            $error_usuario = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }

        .mensaje {
            color: cadetblue;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <h1>Gestión de guardias</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
            <?php
            if (isset($_POST['btnEntrar']) && $error_usuario) {
                if ($_POST['usuario'] == '') {
                    echo "<span class='error'>Campo vacío</span>";
                } else {
                    echo "<span class='error'>Usuario y/o contraseña incorrectos</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave" value="<?php if (isset($_POST['clave'])) echo $_POST['clave'] ?>">
            <?php
            if (isset($_POST['btnEntrar']) && $error_clave) {
                echo "<span class='error'>Usuario y/o contraseña incorrectos</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEntrar">Entrar</button>
        </p>
    </form>
    <?php
    if (isset($_SESSION['seguridad'])) {
        echo "<p class='mensaje'>" . $_SESSION['seguridad'] . "</p>";
        unset($_SESSION['seguridad']);
    }
    ?>
</body>

</html>