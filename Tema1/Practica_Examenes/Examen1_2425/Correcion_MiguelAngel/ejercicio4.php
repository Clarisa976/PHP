<?php
if(isset($_POST["btnSubir"]))
{
    $error_form=$_FILES["archivo"]["error"] || $_FILES["archivo"]["type"]!="text/plain" || $_FILES["archivo"]["size"]>500*1024;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1 PHP</title>
   
</head>
<body>
   
    <?php

    if(isset($_POST["btnSubir"]) && !$error_form)
    {
        @$var=move_uploaded_file($_FILES["archivo"]["tmp_name"],"Aulas/aulas.txt");
        if(!$var)
            echo "<p>El fichero seleccionado no ha podido moverse a la carpeta destino</p>";
    }


    @$fd=fopen("Aulas/aulas.txt","r");
    if($fd)
    {
        require "vistas/vista_horario.php";

        fclose($fd);
    }
    else
    {
        require "vistas/vista_formulario_fichero.php";
    }
    ?>
</body>
</html>