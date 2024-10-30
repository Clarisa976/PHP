<?php
    function tiene_extension($texto){
        $array_nombre=explode(".",$texto);
        if (count($array_nombre)<=1) {//si no tiene extensión devuelve falso
            $respuesta = false;
        }else{
            $respuesta=end($array_nombre);
        }
        return $respuesta;
    }

    if (isset($_POST["btnEnviar"])) {
        $error_foto=$_FILES["foto"]["name"]!=""//si hay imagen y se cumple todo lo demás, si no hay imagen pasando
        &&($_FILES["foto"]["error"]
        || !tiene_extension($_FILES["foto"]["name"])
        || !getimagesize($_FILES["foto"]["tmp_name"])
        || $_FILES["foto"]["size"]>500*1024);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría sobre subir ficheros</title>
    <style>
        .error{
            color: red;
        }
        p img{
            height: 200px;
        }
    </style>
</head>
<body>
    <h1>Teoría subir ficheros</h1>
    <form action="teoria_ficheros_optativo.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen con extensión (Máx. 500kb)</label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <?php
                if (isset($_POST["btnEnviar"])&& $_FILES["foto"]["name"]!="" && !$error_foto) {
                    
                    if ($_FILES["foto"]["error"]) {
                        echo " <span class='error'>No se ha subido el archivo seleccionado al servidor</span>";
                    }elseif (!tiene_extension($_FILES["foto"]["name"])) {
                        echo " <span class='error'>Has elegido un fichero sin extensión</span>";
                    }elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {
                        echo " <span class='error'>No has seleccionado un fichero de tipo imagen</span>";
                    }else{
                        echo " <span class='error'>El fichero seleccionado es mayor que 500kb</span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>

    </form>
                <?php
                    if (isset($_POST["btnEnviar"])&& !$error_foto) {
                        if ($_FILES["foto"]["name"]!="" ) {                        
                            echo "<h1>Información de la imagen subida</h1>";
                            # función para añadir un numero único para la foto
                            $numero_unico=md5(uniqid(uniqid(),true));
                            $extension=tiene_extension($_FILES["foto"]["name"]);
                            $nombre_imagen="img_".$numero_unico.".".$extension;
                            //ahora lo movemos a images con el nuevo nombre
                            //con la sentencia move_uploade_file()
                            //con $_FILES["foto"]["tmp_name"] obtenemos la ruta temporal donde está la foto
                            @$var=move_uploaded_file($_FILES["foto"]["tmp_name"],"images/".$nombre_imagen);
                            //en windows no da error al mover
                            //en linux si porque hay que darle permisos a la carpeta
                            //el @ al comienzo de la variable hace que no salgan los avisos cuando falla
                            if (!$var) {
                                echo " <p class='error'>No se ha podido mover la imagen a la carpeta destino en el servidor</p>";
                            }else{
                                //usamos sudo chmod 777 -R y la ruta para darle los permisos a la carpeta
                                echo "<p><strong>Nombre Original: </strong>".$_FILES["foto"]["name"]."</p>";
                                echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
                                echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
                                echo "<p><strong>Archivo subido tempralmente en: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
                                echo "<p><img src='images/$nombre_imagen' alt='Imagen subida' title='Imagen subida'</p>";
                                echo "<p>La imagen ha sido subida correctamente.</p>";
                            }
                        }
                    }
                
                ?>

</body>
</html>