<?php

    // Actualizar
    if(isset($_POST["btnContActualizar"])){
        $error_nombre = $_POST["nombre"]==="";
        $error_usuario = $_POST["usuario"]==="";
        $error_email = $_POST["email"]==="";
        $error_clave = $_POST["clave"]==="";

        $error_form_actualizar = $error_nombre || $error_usuario || $error_clave || $error_email;

        if(!$error_form_actualizar){
            $headers[] = 'Authorization: Bearer '.$_SESSION["token"];
            $url=DIR_SERV."/actualizarUsuario/".$_POST["btnContActualizar"];
            $datos_env["nombre"]=$_POST["nombre"];
            $datos_env["usuario"]=$_POST["usuario"];
            $datos_env["clave"]=md5($_POST["clave"]);
            $datos_env["email"]=$_POST["email"];
            $respuesta = consumir_servicios_JWT_REST($url,'PUT',$headers,$datos_env);
            $json_agregar = json_decode($respuesta,true);

            if(!$json_actualizar){
                session_destroy();
                die(error_page("Actividad 8", "<p>Error consumiendo el servicio: ".$url."</p>"));
            }
        
            if(isset($json_actualizar["no_auth"]))
            {
                session_unset();
                $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
                header("Location:index.php");
                exit;
            }
            
            if(isset($json_actualizar["error"]))
            {
                session_destroy();
                die(error_page("Actividad 8","<p>".$json_actualizar["error"]."</p>"));
            }

            if(isset($json_actualizar["mensaje_baneo"]))
        {
            session_unset();//Me deslogueo
            $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
            header("Location:index.php");
            exit;
        }
            
            $_SESSION["mensaje_accion"]=$json_actualizar["mensaje"];
            header("Location:index.php");
            exit;
        }
    }

    // Agregar
    if(isset($_POST["btnContAgregar"])){
        $error_nombre = $_POST["nombre"]==="";
        $error_usuario = $_POST["usuario"]==="";
        $error_email = $_POST["email"]==="";
        $error_clave = $_POST["clave"]==="";

        $error_form_agregar = $error_nombre || $error_usuario || $error_clave || $error_email;

        if(!$error_form_agregar){
            $headers[] = 'Authorization: Bearer '.$_SESSION["token"];
            $url=DIR_SERV."/crearUsuario";
            $datos_env["nombre"]=$_POST["nombre"];
            $datos_env["usuario"]=$_POST["usuario"];
            $datos_env["clave"]=md5($_POST["clave"]);
            $datos_env["email"]=$_POST["email"];
            $respuesta = consumir_servicios_JWT_REST($url,'POST',$headers,$datos_env);
            $json_agregar = json_decode($respuesta,true);

            if(!$json_agregar){
                session_destroy();
                die(error_page("Actividad 8", "<p>Error consumiendo el servicio: ".$url."</p>"));
            }
        
            if(isset($json_agregar["no_auth"]))
            {
                session_unset();
                $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
                header("Location:index.php");
                exit;
            }
            
            if(isset($json_agregar["error"]))
            {
                session_destroy();
                die(error_page("Actividad 8","<p>".$json_agregar["error"]."</p>"));
            }

            if(isset($json_agregar["mensaje_baneo"]))
        {
            session_unset();//Me deslogueo
            $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
            header("Location:index.php");
            exit;
        }
            
            $_SESSION["mensaje_accion"]="Usuario ".$json_agregar["ult_id"]." insertado con éxito";
            header("Location:index.php");
            exit;
        }
    }

    // si existe boton detalles
    if(isset($_POST["btnDetalles"]) || isset($_POST["btnEditar"])){

        if(isset($_POST["btnDetalles"])){
            $id_usuario = $_POST["btnDetalles"];
        }else{
            $id_usuario = $_POST["btnEditar"];
        }

        $headers[] = 'Authorization: Bearer '.$_SESSION["token"];
        $url=DIR_SERV."/usuario/".urlencode($id_usuario);
        $respuesta = consumir_servicios_JWT_REST($url,'GET',$headers);
        $json_usuario = json_decode($respuesta,true);

        if(!$json_usuario){
            session_destroy();
            die(error_page("Actividad 8", "<p>Error consumiendo el servicio: ".$url."</p>"));
        }
    
        if(isset($json_usuario["no_auth"]))
        {
            session_unset();
            $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
            header("Location:index.php");
            exit;
        }
        
        if(isset($json_usuario["error"]))
        {
            session_destroy();
            die(error_page("Actividad 8","<p>".$json_usuario["error"]."</p>"));
        }
    }

    // Eliminar
    if(isset($_POST["btnContBorrar"])){
        $headers[] = 'Authorization: Bearer '.$_SESSION["token"];
        $url=DIR_SERV."/borrarUsuario/".urlencode($_POST["btnContBorrar"]);
        $respuesta = consumir_servicios_JWT_REST($url,'DELETE',$headers);
        $json_borrar = json_decode($respuesta,true);

        if(!$json_borrar){
            session_destroy();
            die(error_page("Actividad 8", "<p>Error consumiendo el servicio: ".$url."</p>"));
        }
    
        if(isset($json_borrar["no_auth"]))
        {
            session_unset();
            $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
            header("Location:index.php");
            exit;
        }
        
        if(isset($json_borrar["error"]))
        {
            session_destroy();
            die(error_page("Actividad 8","<p>".$json_borrar["error"]."</p>"));
        }

        $_SESSION["mensaje_accion"] = $json_borrar["mensaje"];
        header("Location:index.php");
        exit;
    }

    // Listar usuarios nada más empezar
    $headers[] = 'Authorization: Bearer '.$_SESSION["token"];
    $url=DIR_SERV.'/usuarios';
    $respuesta = consumir_servicios_JWT_REST($url,'GET',$headers);
    $json_usuarios = json_decode($respuesta,true);

    if(!$json_usuarios){
        session_destroy();
        die(error_page("Actividad 8", "<p>Error consumiendo el servicio: ".$url."</p>"));
    }

    if(isset($json_productos["no_auth"]))
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha caducado";
    header("Location:index.php");
    exit;
}

if(isset($json_productos["error"]))
{
    session_destroy();
    die(error_page("Actividad 8","<p>".$json_productos["error"]."</p>"));
}

if(isset($json_productos["mensaje_baneo"]))
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 8</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
        table,th,td{border:1px black solid; padding:1rem;}
        table{border-collapse:collapse;}
    </style>
</head>
<body>
    <h1>Página Admin Actividad 8</h1>
    <div>
        Bienvenido <?php echo $datos_usuario_log["nombre"];?>
        <form action="index.php" method="post"><button type="submit" name='btnCerrarSesion'>Volver</button></form>
    </div>
    <?php

        if(isset($_SESSION["mensaje_accion"]))
        {
            echo "<p class='centrado txt_centrado mensaje'>".$_SESSION["mensaje_accion"]."</p>";
            unset($_SESSION["mensaje_accion"]);
        }

        if(isset($_POST["btnBorrar"])){
            ?>
            <form action="index.php" method="post">
                <h3>Esta seguro que usted desea eleminar a: <?php echo $_POST["btnBorrar"];?>?</h3>
                <button type="submit" >Volver</button>
                <button type="submit" name="btnContBorrar" value="<?php echo $_POST["btnBorrar"];?>">Continuar</button>
            </form>
            <?php
        }

        if(isset($_POST["btnDetalles"])){
            echo "<p>Id: ".$json_usuario["usuario"]["id_usuario"]."</p>";
            echo "<p>Nombre: ".$json_usuario["usuario"]["nombre"]."</p>";
            echo "<p>Usuario: ".$json_usuario["usuario"]["usuario"]."</p>";
            echo "<p>Email: ".$json_usuario["usuario"]["email"]."</p>";
            echo "<p>Clave: ".$json_usuario["usuario"]["clave"]."</p>";
            echo "<p>Tipo: ".$json_usuario["usuario"]["tipo"]."</p>";
        }

        if(isset($_POST["btnAgregar"]) || isset($_POST["btnContAgregar"]) && $error_form_agregar){
            ?>
            <form action="index.php" method="post">
                <p>
                    <label for="nombre" >Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
                    <?php
                        if(isset($_POST["btnContAgregar"]) && $error_nombre){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario"  value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>">
                    <?php
                        if(isset($_POST["btnContAgregar"]) && $error_usuario){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"];?>">
                    <?php
                        if(isset($_POST["btnContAgregar"]) && $error_email){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="clave">Clave:</label>
                    <input type="password" name="clave" id="clave" value="<?php if(isset($_POST["clave"])) echo $_POST["clave"];?>">
                    <?php
                        if(isset($_POST["btnContAgregar"]) && $error_clave){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <button type="submit">Volver</button>
                    <button type="submit" name="btnContAgregar" >Continuar</button>
                </p>
            </form>
            <?php
        }

        if(isset($_POST["btnEditar"]) || isset($_POST["btnContActualizar"]) && $error_form_actualizar){

            if(isset($json_usuario["usuario"])){
                if($json_usuario){
                    $nombre = $json_usuario["usuario"]["nombre"];
                    $usuario = $json_usuario["usuario"]["usuario"];
                    $clave = $json_usuario["usuario"]["clave"];
                    $email = $json_usuario["usuario"]["email"];
                }else{
                    session_destroy();
                    die("<p>El producto ya no se encuentra en la BD</p></body></html>");
                }
            }else{
                $nombre = $_POST["nombre"];
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];
                $email = $_POST["email"];
            }

            ?>
            <form action="index.php" method="post">
                <p>
                    <label for="nombre" >Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre;?>">
                    <?php
                        if(isset($_POST["btnContActualizar"]) && $error_nombre){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario"  value="<?php echo $usuario;?>">
                    <?php
                        if(isset($_POST["btnContActualizar"]) && $error_usuario){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $email;?>">
                    <?php
                        if(isset($_POST["btnContActualizar"]) && $error_email){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="clave">Clave:</label>
                    <input type="password" name="clave" id="clave" value="<?php echo $clave;?>">
                    <?php
                        if(isset($_POST["btnContActualizar"]) && $error_clave){
                            echo "<span> Error campo vacío * </span>";
                        }
                    ?>
                </p>
                <p>
                    <button type="submit">Volver</button>
                    <button type="submit" value="<?php echo $_POST["btnEditar"];?>" name="btnContActualizar" >Continuar</button>
                </p>
            </form>
            <?php
        }

        echo "<table>";
        echo "<tr><th>Código</th><th>Usuario</th><th><form action='index.php' method='post'><button name='btnAgregar' type='submit'>Agregar +</button></form></th></tr>";
        foreach($json_usuarios["usuarios"] as $tupla){
            echo "<tr>";
                echo "<td><form action='index.php' method='post'><button type='submit' name='btnDetalles' value='".$tupla["id_usuario"]."'>".$tupla["id_usuario"]."</button></form></td>";
                echo "<td>".$tupla["usuario"]."</td>";
                echo "<td> <form action='index.php' method='post'><button name='btnEditar' type='submit' value='".$tupla["id_usuario"]."'>Editar</button> - <button name='btnBorrar' type='submit' value='".$tupla["id_usuario"]."'>Borrar</button></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>

</body>
</html>