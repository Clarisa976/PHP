<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría PDO</title>
</head>
<body>
    <h1>Teoría PDO</h1>
    <?php
    define("SERVIDOR_BD","localhost");
    define("USUARIO_BD","jose");
    define("CLAVE_BD","josefa");
    define("NOMBRE_BD","bd_foro");

    //nueva forma de conectarse con PDO
    try {
        @$conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        die("<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p></body></html>");
    }
    
    echo "<h2>Conectado</h2>";



    $usuario="masantos76";
    $clave=md5("123456");
    

    try {
        $consulta="select * from usuarios where usuari=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        //ese objeto es el que prepara la consula
        $sentencia->execute([$usuario,$clave]);//hay que pasarle un array escalar, tantos como interrogaciones tenga la consulta
    } catch (PDOException $e) {
        //si falla tenemos que liberar la sentencia y la conexión
        $sentencia=null;
        $conexion=null;
        die("<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p></body></html>");
    }
    if ($sentencia->rowCount()<=0) {
        echo "<p>No hay usuarios con esas credenciales en la BD</p>";

    }else{
        //$tupla=$sentencia->fetch(PDO::FETCH_ASSOC);//PDO::FETCH_NUM, PDO::FETCH_OBJECT
        //si queremos obtener todas las tuplas de golpe podemos usar fetchAll
        $tupla=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        echo "<p>El usuario logueado es: <strong>".$tupla["nombre"] ."</strong></p>";
    }

    //liberamos la sentencia
    $sentencia=null;
    //cerramos la conexión
    $conexion=null;
    ?>
</body>
</html>