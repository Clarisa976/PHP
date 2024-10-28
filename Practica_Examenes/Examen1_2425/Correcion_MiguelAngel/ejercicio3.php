<?php
function esta_la_linea($texto_a_buscar, $fd)
{
    $respuesta = false;
    while ($linea = fgets($fd)) {
        if ($texto_a_buscar == $linea) {
            $respuesta = true;
            break;
        }
    }
    return $respuesta;
}
//control de errores
if (isset($_POST["btnAgregar"])) {
    $errores_formulario = $_FILES["fichero"]["name"] == "" || $_FILES["fichero"]["error"]
        || $_FILES["fichero"]["type"] != "text/plain"
        || $_FILES["fichero"]["size"] > 500 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correción del examen1 PHP - Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 3</h1>
        <p>
            <label for="fichero">Seleccione un fichero de texto plano para agregar al fichero aulas.txt(Máx.500Kb)</label>
            <input type="file" name="fichero" id="fichero">

            <?php
            if (isset($_POST["btnAgregar"]) && $errores_formulario) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } elseif ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<span class='error'>El formato seleccionado no es el adecuado</span>";
                } else {
                    echo "<span class='error'>El tamaño es mayor al permitido</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="btnAgregar">Agregar</button>

        <button type="submit" name="btnCrear">Crear/Vaciar</button>
    </form>
</body>
<?php
//si se pulsa el botón agregar se agrega al principio
if (isset($_POST["btnAgregar"]) && !$errores_formulario) {
    @$fd1 = fopen("Aulas/aulas.txt", "r");
    if (!$fd1) {
        echo "<p><strong>No se puede abrir el fichero <em>'aulas.txt'</em></strong></p>";
    } else {
        @$fd2 = fopen($_FILES["fichero"]["tmp_name"], "r");
        $linea2 = fgets($fd2);
        fclose($fd2);

        $respuesta ="";
        $insertado=false;
        while ($linea1=fgets($fd1)) {
            if ($linea2[6]<=$linea1[6]&& !$insertado) {
                //cuando es menor se inserta
                if ($linea2[6]<$linea1[6]&& !$insertado) {
                    $respuesta.=file_get_contents($_FILES["fichero"]["tmp_name"]).PHP_EOL;
                }
                    //sino se marca de que ya se ha insertado
                    $insertado=true;
                
            }
            $respuesta.=$linea1;
            for ($i=0; $i <=5 ; $i++) { 
                $respuesta.=fgets($fd1);
            }
            
        }
        if(!$insertado){
            $respuesta.=file_get_contents($_FILES["fichero"]["tmp_name"]).PHP_EOL;
        }
        fclose($fd1);
        file_put_contents("Aulas/aulas.txt",$respuesta);
        echo "<p><strong>El fichero <em>'aulas.txt'</em> tras esta operación tiene el siguiente contenido:</strong></p>";
        echo "<textarea name='txt' id='txt' rows='25' cols='40'>" . $respuesta . "</textarea>";
    }
}
//si se pulsa el botón crear/borrar se crea el fichero
if (isset($_POST["btnCrear"])) {
    @$fd = fopen("Aulas/aulas.txt", "w");
    if (!$fd) {
        echo "<p><strong>El fichero <em>'aulas.txt'</em> no cuenta con los permisos adecuados</strong></p>";
    } else {
        echo "<p><strong>Fichero creado/vaciado con éxito</strong></p>";
    }
}
?>

</html>