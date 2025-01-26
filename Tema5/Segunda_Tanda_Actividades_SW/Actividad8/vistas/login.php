<?php
    ob_clean();

    if(isset($_POST["btnLogin"])){

        $error_usuario = $_POST["usuario"]==="";
        $error_clave = $_POST["clave"]==="";
        $error_form = $error_usuario || $error_clave;

        if(!$error_form){
            $url=DIR_SERV.'/login';
            $datos_env["usuario"]=$_POST["usuario"];
            $datos_env["clave"]=md5($_POST["clave"]);
            $respuesta = consumir_servicios_REST($url,'POST',$datos_env);
            $json_login=json_decode($respuesta,true);

            if(!$json_login){
                session_destroy();
                die(error_page("Actividad_8", "<p> Error Consumiendo el servicio: ".$url." </p>"));
            }
            
            if(isset($json_login["error"])){
                session_destroy();
                die(error_page("Actividad_8", "<p> Error: ".$json_login["error"]." </p>"));
            }
            if(isset($json_login["usuario"])){
                $_SESSION["ultm_accion"]=time();
                $_SESSION["token"]=$json_login["token"];
                header("Location:index.php");
                exit;
            }else{
                $error_usuario=true;
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Actividad_8</title>
</head>
<body>
    <h2>Login - Actividad 8</h2>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
                if(isset($_POST["btnLogin"])&& $error_usuario){
                    if($_POST["usuario"]===""){
                        echo "<span> *Campo Vacío*</span>";
                    }else{
                        echo "<span> *Error usuario/contraseña incorrectos*</span>";
                    }
                }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave">
            <?php
                if(isset($_POST["btnLogin"]) && $error_clave){
                    echo "<span> *Campo Vacío* </span>";
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Entrar</button>
        </p>
    </form>
    <?php
    if(isset($_SESSION["mensaje_seguridad"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_seguridad"]."</p>";
        unset($_SESSION["mensaje_seguridad"]);
    }
    ?>
</body>
</html>