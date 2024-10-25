<?php
//control de errores
if (isset($_POST["btnSubir"])) {
    $errores_formulario = $_FILES["fichero"]["name"] == "" || $_FILES["fichero"]["error"]
        || $_FILES["fichero"]["type"] != "text/plain"
        || $_FILES["fichero"]["size"] > 500 * 1024;
}
function comparar_contenido($datos, $datos_nuevo)
{
    $son_distintos = false;
    $primero = mi_explode(";", $datos);
    $segundo = mi_explode(";", $datos_nuevo);
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
function mi_explode($separador, $texto)
{
    $resultado = [];
    $i = 0;
    $longitud = strlen($texto);

    while ($i < $longitud && $texto[$i] == $separador) {
        $i++;
    }
    if ($i < $longitud) {
        $j = 0;
        $resultado[$j] = $texto[$i];
        if ($texto[$i] != $separador) {
            $resultado[$j] .= $texto[$i];
        } else {
            while ($i < $longitud && $texto[$i] == $separador) {
                $i++;
            }
            if ($i < $longitud) {
                $j++;
                $resultado[$j] = $texto[$i];
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
    <title>Examen1 PHP - Ejercicio 4</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 4</h1>
        <?php
        $ruta = "Aulas/aulas.txt";
        @$fd = fopen($ruta, "r");
        if (!$fd) {
            echo "<h2>No se encuentra el fichero <em>'Aulas/aulas.txt'</em></h2>";
            echo "<p>";
            echo "<label for='fichero'>Seleccione un fichero de texto plano para agregar al fichero aulas.txt(Máx.500Kb)</label>";
            echo "<input type='file' name='fichero' id='fichero'>";


            if (isset($_POST["btnSubir"]) && $errores_formulario) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } elseif ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<span class='error'>El formato seleccionado no es el adecuado</span>";
                } else {
                    echo "<span class='error'>El tamaño es mayor al permitido</span>";
                }
            }
            echo "</p>";
            echo "<button type='submit' name='btnSubir'>Subir</button>";
        } else {
            echo "<h2>Aulas Libres</h2>";
            echo "<label for='semana'>Seleccione una semana: </label>";
            
            $linea = explode(";", file_get_contents($ruta));
            echo "<select name='semana' id='semana'>";
            for ($i=0; $i < strlen($linea[0]); $i++) { 
                echo  "<option value=''>" . $linea[$i] . "</option>";
            }
            

            echo "</select>";


            echo "<button type='submit' name='btnVer'>Ver Semana</button>";
        }
        //fclose($fd);
        ?>
    </form>
</body>
<?php

if (isset($_POST["btnSubir"]) && !$errores_formulario) {
    $ruta = "Aulas/aulas.txt";
    @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], $ruta);
    if ($var) {
        echo "<span>Archivo movido con éxito</span>";
    }else{
        echo "<span>Error al mover el archivo</span>";
    }
    }
   
if (isset($_POST["btnVer"])) {
    $ruta = "Aulas/aulas.txt";
    @$fd = fopen($ruta, "r");
    fclose($fd);
}

?>

</html>