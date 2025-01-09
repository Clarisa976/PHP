<?php
//conexión a la base de datos con PDO
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");



$app = new \Slim\App;

function obtener_productos()
{
    //primero se conecta a la base de datos
    try {
        @$conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //no puede haber un die por lo que devuelve un mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    //hace la consulta
    try {
        $consulta = "select * from producto";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    //si la consulta ha sido exitosa
    $respuesta["productos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
function obtener_producto($cod)
{
    //primero se conecta a la base de datos
    try {
        @$conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //no puede haber un die por lo que devuelve un mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    //hace la consulta
    try {
        $consulta = "select * from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    //si la consulta ha sido exitosa
    if ($sentencia->rowCount() <= 0) {
        $respuesta["mensaje"] = "No hay productos con ese código en la BD";
    } else {
        $respuesta["producto"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
