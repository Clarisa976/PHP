<?php
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
    <title>Examen1 PHP - Ejercicio 1</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 1</h1>
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
   @$fd=fopen("Aulas/aulas.txt","r+");
   if (!$fd) {
        echo "<p><strong>No se puede abrir el fichero <em>'aulas.txt'</em></strong></p>";
   }else{
        $datos = file_get_contents($_FILES["fichero"]["name"]);
        fwrite($fd,$datos.PHP_EOL);
        echo "<p><strong>El fichero <em>'aulas.txt'</em> tras esta operación tiene el siguiente contenido:</strong></p>";
        echo "<textarea name='txt' id='txt' rows='25' cols='40'>".file_get_contents("Aulas/aulas.txt")."</textarea>";
   
   fclose($fd);
}
}
//si se pulsa el botón crear/borrar se crea el fichero
if (isset($_POST["btnCrear"])) {
    @$fd=fopen("Aulas/aulas.txt","w");
    if (!$fd) {
        echo "<p><strong>El fichero <em>'aulas.txt'</em> no cuenta con los permisos adecuados</strong></p>";
    }else{
        echo "<p><strong>Fichero creado/vaciado con éxito</strong></p>";
    }
}
?>

</html>