<?php

if(isset($_POST["btnAgregar"]))
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
    <style>
        .error{color:red}
        textarea{width:50%;height:200px}
    </style>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fichero">Seleccione un fichero de texto plano para agregar al fichero aulas.txt (Máx. 500KB)</label>
            <input type="file" name="archivo" accept=".txt"/>
            <?php
                if(isset($_POST["btnAgregar"])&& $error_form)
                {
                    if($_FILES["archivo"]["name"]=="")
                        echo "<span class='error'> No has seleccionado un archivo </span>";
                    elseif($_FILES["archivo"]["error"] )
                        echo "<span class='error'> Error en la subida del fichero al servidor </span>";
                    elseif($_FILES["archivo"]["type"]!="text/plain")
                        echo "<span class='error'> No has seleccionado un archivo de texto plano </span>"; 
                    else
                        echo "<span class='error'> El archivo seleccionado es mayor de 500KB </span>"; 
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnAgregar">Agregar</button> <button type="submit" name="btnVaciar">Crear/Vaciar</button>
        </p>
    </form>
    <?php
    if(isset($_POST["btnVaciar"]))
    {
        @$fd=fopen("Aulas/aulas.txt","w");
        if(!$fd)
            echo "<h3>No tienes permisos en el servidor para crear el fichero <em>'aulas.txt'</em></h3>";
        else
            echo "<h3>Fichero <em>'aulas.txt'</em> creado/vaciado con éxito</h3>";
    }

    if(isset($_POST["btnAgregar"])&& !$error_form)
    {
        @$fd1=fopen("Aulas/aulas.txt","r");
        if(!$fd1)
            echo "<h3>No se puede abrir el fichero <em>'aulas.txt'</em></h3>";
        else
        {
            $fd2=fopen($_FILES["archivo"]["tmp_name"],"r");
            $linea2=fgets($fd2);
            fclose($fd2);

            $respuesta="";
            $insertado=false; 

            while($linea1=fgets($fd1))
            {
                if($linea2[6]<=$linea1[6] && !$insertado)
                {
                    if($linea2[6]<$linea1[6])
                        $respuesta.=file_get_contents($_FILES["archivo"]["tmp_name"]).PHP_EOL;
                    
                    $insertado=true;
                }
                $respuesta.=$linea1;
                for($k=1;$k<=5;$k++)
                    $respuesta.=fgets($fd1);
            }

            if(!$insertado)
                $respuesta.=file_get_contents($_FILES["archivo"]["tmp_name"]).PHP_EOL;

            fclose($fd1);
            file_put_contents("Aulas/aulas.txt",$respuesta);

            echo "<h2>El fichero <em>'Aulas/aulas.txt'</em> tras esta operación tiene el siguiente contenido</h2>";
            echo "<textarea>".$respuesta."</textarea>";

        }
    }

    ?>
</body>
</html>
