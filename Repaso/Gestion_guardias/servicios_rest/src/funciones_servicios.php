<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

require "config_bd.php";

function validateToken()
{
    
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]))
        return false;//Sin autorizacion
    else
    {
        $authorization = $headers["Authorization"];
        $authorizationArray=explode(" ",$authorization);
        $token=$authorizationArray[1];
        try{
            $info=JWT::decode($token,new Key(PASSWORD_API,'HS256'));
        }
        catch(\Throwable $th){
            return false;//Expirado
        }

        try{
            $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        }
        catch(PDOException $e){
            
            $respuesta["error"]="Imposible conectar:".$e->getMessage();
            return $respuesta;
        }

        try{
            $consulta="select * from usuarios where id_usuario=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        }
        catch(PDOException $e){
            $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
            $sentencia=null;
            $conexion=null;
            return $respuesta;
        }
        if($sentencia->rowCount()>0)
        {
            $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
         
            $payload['exp']=time()+3600;
            $payload['data']= $respuesta["usuario"]["id_usuario"];
            $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
            $respuesta["token"]=$jwt;
        }
            
        else
            $respuesta["mensaje_baneo"]="El usuario no se encuentra registrado en la BD";

        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
}

function login($usario,$clave)
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usario,$clave]);
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    
    
        $payload=['exp'=>time()+3600,'data'=> $respuesta["usuario"]["id_usuario"]];
        $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
        $respuesta["token"]=$jwt;
    }
        
    else
        $respuesta["mensaje"]="El usuario no se encuentra registrado en la BD";


    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function obtenerUsuario($id) {
    //probamos la conexión a la bd
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    //consulta a la bd
    try{
        $consulta="select * from usuarios where id_usuario=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$id]);
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido realizar la consulta: ".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    $sentencia=null;
    $conexion=null;
    return $respuesta;


}
function usuariosGuardia($dia,$hora) {
    //probamos la conexión a la bd
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    //consulta a la bd
    try{
        $consulta="SELECT * FROM usuarios WHERE id_usuario IN (SELECT horario_guardias.usuario FROM horario_guardias WHERE dia=? AND hora=?)";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$dia,$hora]);
    }catch(PDOException $e)
    {
        $respuesta["error"]="No he podido realizar la consulta: ".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    //si hay usuarios
    if($sentencia->rowCount()>0)
    {
        $respuesta["usuarios"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        //$respuesta["usuarios"] = [];
        $respuesta["mensaje"]="No hay profesores de guardia";
    }
    $sentencia=null;
    $conexion=null;
    return $respuesta;

}

function deGuardia($dia, $hora, $id_usuario)  {
     //probamos la conexión a la bd
     try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    //consulta a la bd
    try {
        $consulta = "SELECT horario_guardias.id_hor_gua FROM horario_guardias WHERE dia=? and hora=? and usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$dia, $hora, $id_usuario]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $conexion = null;
        $sentencia = null;
    }
    //si está de_guardia true si no false
    if ($sentencia->rowCount() > 0) {
        $respuesta["de_guardia"] = true;
    } else {
        $respuesta["de_guardia"] = false;
    }
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


?>
