<?php
//conexión a la base de datos con PDO
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");



$app = new \Slim\App;
//método para obtener todos los productos
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

//función para obtener un producto mediante su código
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

//función para insertar un producto con un array de datos
function insertar_producto($datos)
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
        $consulta = "insert into producto(cod,nombre,nombre_corto,descripcion,PVP,familia) values (?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["mensaje"] = "El producto con código: ".$datos[0]." se ha insertado correctamente";
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

//función para actualizar un producto con un array de datos
function actualizar_producto($datos)
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
        $consulta = "update producto set nombre=?, nombre_corto=?, descripcion=?, PVP=?, familia=? where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    if ($sentencia->rowCount() > 0) {
        $respuesta["mensaje"] = "El producto con código: ".end($datos)." se ha insertado correctamente";
    } else {
        $respuesta["mensaje"] = "El producto no se encontraba en la BD";
    }
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

//método para borrar un producto mediante su código
function borrar_producto($cod){
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
        $consulta = "delete from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    if ($sentencia->rowCount() > 0) {
        $respuesta["mensaje"] = "El producto se ha borrado correctamente";
    } else {
        $respuesta["mensaje"] = "El producto no se encontraba en la BD";
    }
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

//método para obtener las familias
function obtener_familias() {
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
        $consulta = "select * from familia";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["familias"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

//método para comprobar los repetidos a la hora de insertar
function repetidos_insertar($tabla,$columna,$valor) {
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
        $consulta = "select * from " . $tabla . " where " . $columna . "=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["repetido"] = ($sentencia->rowCount()) > 0;
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

//método para comprobar los repetidos a la hora de actualizar
function repetidos_actualizar($tabla,$columna,$valor, $columna_id, $valor_id) {
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
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . "=? AND " . $columna_id . "<>?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor, $valor_id]);
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["repetido"] = ($sentencia->rowCount()) > 0;
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

