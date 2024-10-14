
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría sobre subir ficheros</title>
</head>
<body>
    <h1>Teoría subir ficheros</h1>
    <form action="teoria_ficheros.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen (Máx. 500kb)</label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>

    </form>

    <?php
    /*
    cuando se envia una foto no se usa $_POST ya que lo que se
    genera es una variable nueva llamada $_FILE
    al igual que los $_POST de los textos o select, siempre existe
    dentro de las fotos hay un array asociativa

        $_FILE[""]  ["name"] =
                    ["full_path"] =
                    ["type"] =
                    ["tmp_name"] =
                    ["error"] =
                    ["size"] =

    */
    if (isset($_FILES["foto"])) {
        if(!$_FILES["foto"]["error"]){
            echo "se ha subido con éxito un archivo";
        }else{
            echo "no se ha subido con éxito un archivo";
        }
        
        
    }
?>
</body>
</html>