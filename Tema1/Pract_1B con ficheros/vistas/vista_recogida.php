<?php
echo "<h1>Recogida de datos</h1>";
//de esta forma se mostrará solamente lo que estamos pidiendo
echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
echo "<p><strong>Contraseña: </strong>" . $_POST["pass"] . "</p>";
echo "<p><strong>Sexo: </strong>";
if (isset($_POST["sexo"])) {
    echo $_POST["sexo"];
}
echo "</p>";
echo "<p><strong>Nacido en: </strong>" . $_POST["nacido"] . "</p>";
echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
echo "<p><strong>Suscrito: </strong>";

if (isset($_POST["suscribirse"])) {
    //echo "<p><strong>Suscrito:</strong>".$_POST["suscribirse"]."</p>";
    echo "Sí";
} else {
    echo "No";
}
echo "</p>";

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