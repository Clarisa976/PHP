<?php
    //control de errores 
    if (isset($_POST["btnEnviar"])) {
        //comprobar errores
        //si hay algún error
        //si no es txt
        //si es mayor que 1mb
        //si ha subido algo
        $error_formulario = $_FILES["fichero"]["name"] == ""|| 
        $_FILES["fichero"]["error"] || 
        $_FILES["fichero"]["type"] !="text/plain" ||  
        $_FILES["fichero"]["size"]>1000*1024;  
        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fichero">Seleccione un fichero .txt de máximo 1MB</label>
            <input type="file" name="fichero" id="fichero">
            <?php 
                //controlamos los errores a mostrar
                if (isset($_POST["btnEnviar"])&&$error_formulario) {
                    if ( $_FILES["fichero"]["name"]=="") {
                       echo "<span class='error'>Campo vacío</span>";
                    }elseif ($_FILES["fichero"]["type"]!="text/plain") {
                        echo "<span class='error'>La extensión del fichero no es la adecuada</span>";
                    }else{
                        echo "<span class='error'>El tamaño del fichero es superior a 1MB</span>";
                    }

                }
            ?>
        </p>
        <button type="submit" name="btnEnviar">Subir fichero</button>
    </form>
    <?php
        if (isset($_POST["btnEnviar"])&& !$error_formulario) {
            //movemos el fichero
            $aux = move_uploaded_file($_FILES["fichero"]["tmp_name"],"Ficheros/archivo.txt");

            if ($aux) {//si existe aux
                echo "<p>Fichero movido con éxito</p>";
            }else{
                echo "<p class='error'>El fichero no se ha movido con éxito</p>";
            }
        }
    ?>
</body>
</html>