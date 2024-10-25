<?php
//control de errores
if (isset($_POST["btnAgregar"])) {
    $errores_formulario = $_FILES["fichero"]["name"] == "" || $_FILES["fichero"]["error"]
        || $_FILES["fichero"]["type"] != "text/plain"
        || $_FILES["fichero"]["size"] > 500 * 1024;
}
function comparar_contenido($datos, $datos_nuevo)
{
    $son_distintos = false;
    $primero = mi_explode(";",$datos);
    $segundo = mi_explode(";",$datos_nuevo);
    /* for ($i = 0; $i < $primero; $i++) {
        for ($j = 0; $j < $segundo; $j++) {*/
            if ($primero != $segundo) {
                $son_distintos = true;
            /*    break;
            } else{
                $i++;
                $j++;
            }
        }*/
    }
    return $son_distintos;
}
function mi_explode($separador,$texto) {
    $resultado = [];
    $i=0;
    $longitud = strlen($texto);
    
    while($i<$longitud && $texto[$i]==$separador){
        $i++;
    }
    if ($i<$longitud) {
        $j=0;
        $resultado[$j]= $texto[$i];
        if ($texto[$i]!=$separador) {
            $resultado[$j].=$texto[$i];
        }else{
            while($i<$longitud && $texto[$i]==$separador){
                $i++;
            }
            if ($i<$longitud) {
                $j++;
                $resultado[$j]= $texto[$i];
            }
        }
    }
    return $resultado;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1 PHP - Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 2</h1>
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
    $ruta="Aulas/aulas.txt";
    @$fd = fopen("Aulas/aulas.txt", "a");
    if (!$fd) {
        echo "<p><strong>No se puede abrir el fichero <em>'aulas.txt'</em></strong></p>";
    } else {
        $datos = file_get_contents($_FILES["fichero"]["tmp_name"]);
        $datos_nuevos = file_get_contents($_FILES["fichero"]["tmp_name"]);
        //no se puede repetir
        $datos_linea=mi_explode(";",$datos);
        $datos_nuevos_linea=mi_explode(";",$datos_nuevos);
        if ($datos_linea!=$datos_nuevos_linea) {
            echo "<p><strong>No se puede agregar a <em>'aulas.txt'</em> porque ya está en el fichero</strong></p>";
         } else {
            fwrite($fd, $datos . PHP_EOL);
            echo "<p><strong>El fichero <em>'aulas.txt'</em> tras esta operación tiene el siguiente contenido:</strong></p>";
            echo "<textarea name='txt' id='txt' rows='25' cols='40'>" . file_get_contents("Aulas/aulas.txt") . "</textarea>";

            }


        fclose($fd);
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