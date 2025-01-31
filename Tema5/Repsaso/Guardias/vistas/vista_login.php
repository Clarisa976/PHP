<?php
if (isset($_POST['btnEntrar'])) {
    $error_usuario=$_POST['usuario']=="";
    $error_clave=$_POST['clave']=="";
    $error_form=$error_usuario||$error_clave;
    
    if (!$error_form) {
        $url=DIR_SERV.'/login';
        $datos_env['usuario']=$_POST['usuario'];
        $datos_env['clave']=md5($_POST['clave']);
        $respuesta=consumir_servicios_REST($url,'POST',$datos_env);
        $json_respuesta=json_decode($respuesta,true);
        if (!$json_respuesta){
            session_destroy();
            die(error_page("Examen3_PHP_24-25","<p>Error consumiendo el servicio Rest: <strong>".$url."</strong></p>"));
        }
        if(isset($json_respuesta["error"]))
       {
            session_destroy();
            die(error_page("Examen3_PHP_24-25","<p>".$json_respuesta["error"]."</p>"));
       }
       if(isset($json_respuesta["mensaje"]))
       {
            $error_usuario=true;
       }
       else
       {
            $_SESSION["token"]=$json_respuesta["token"];
            $_SESSION["ultm_accion"]=time();
            header("Location:index.php");
            exit;
       }
    }
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen3_PHP_24-25</title>
    <style>
        
        .error{
            color:red
        }
        .mensaje{
            color:blue;
            font-size:1.25em;
        }
    </style>
</head>
<body>
    <h1>Gestión de guardias</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario']?>">
            <?php
            if(isset($_POST['btnEntrar'])&&$error_usuario){
                if($_POST['usuario']==''){
                    echo '<span class="error">*Campo vacío</span>';
                }else{
                    echo '<span class="error">El usuario y/o la calve introduccidos son incorrectos</span>';
                }
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave">
            <?php
            if(isset($_POST['btnEntrar'])&&$error_clave){
                if($_POST['clave']==''){
                    echo '<span class="error">*Campo vacío</span>';
                }else{
                    echo '<span class="error">El usuario y/o la calve introduccidos son incorrectos</span>';
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEntrar">Entrar</button>
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