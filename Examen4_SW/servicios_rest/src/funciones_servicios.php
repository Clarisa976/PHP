<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

require "config_bd.php";

function validateToken()
{

    $headers = apache_request_headers();
    if (!isset($headers["Authorization"]))
        return false; //Sin autorizacion
    else {
        $authorization = $headers["Authorization"];
        $authorizationArray = explode(" ", $authorization);
        $token = $authorizationArray[1];
        try {
            $info = JWT::decode($token, new Key(PASSWORD_API, 'HS256'));
        } catch (\Throwable $th) {
            return false; //Expirado
        }

        try {
            $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {

            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            return $respuesta;
        }

        try {
            $consulta = "select * from usuarios where cod_usu=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        } catch (PDOException $e) {
            $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
            $sentencia = null;
            $conexion = null;
            return $respuesta;
        }
        if ($sentencia->rowCount() > 0) {
            $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);

            $payload['exp'] = time() + 3600;
            $payload['data'] = $respuesta["usuario"]["cod_usu"];
            $jwt = JWT::encode($payload, PASSWORD_API, 'HS256');
            $respuesta["token"] = $jwt;
        } else
            $respuesta["mensaje_baneo"] = "El usuario no se encuentra registrado en la BD";

        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function login($usario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario=? and clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usario, $clave]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);


        $payload = ['exp' => time() + 3600, 'data' => $respuesta["usuario"]["cod_usu"]];
        $jwt = JWT::encode($payload, PASSWORD_API, 'HS256');
        $respuesta["token"] = $jwt;
    } else
        $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";


    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function obtener_alumnos() {
    //probamos la conexión a la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    //hacemos la consulta
    try {
        //obtener todos los alumnos que sea de tipo alumno
        $consulta = "select * from usuarios where tipo='alumno'";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
    //si hay alumnos
    if ($sentencia->rowCount() > 0) {
        $respuesta["alumnos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $respuesta["mensaje"] = "No hay alumnos en la BD";
    }
        //cerramos la conexión
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    
    
}
function obtener_notas_alumnos($cod_alu) {
    //probamos la conexión a la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    //obtener las notas de todas las asignaturas de un alumno
    try {
        //obtener todos los alumnos que sea de tipo alumno
        $consulta = "select * from usuarios where tipo='alumno'";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }

}
function conexion_pdo()
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        
        $respuesta["mensaje"]="Conexi&oacute;n a la BD realizada con &eacute;xito";
        
        $conexion=null;
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
    }
    return $respuesta;
}


function conexion_mysqli()
{
  
    try
    {
        $conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion,"utf8");
        $respuesta["mensaje"]="Conexi&oacute;n a la BD realizada con &eacute;xito";
        mysqli_close($conexion);
    }
    catch(Exception $e)
    {
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
    }
    return $respuesta;
}
?>
