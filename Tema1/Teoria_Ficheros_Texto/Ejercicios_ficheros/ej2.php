<?php
if (isset($_POST["btnEnviar"])) {
    //control de errores
    $error_campo_vacio = $_POST["numero"] == " ";
    $error_numero_valido = !is_numeric($_POST["numero"]);
    $error_rango_numerico =  $_POST["numero"] < 1 || $_POST["numero"] > 10;

    $error_numero = $error_campo_vacio || $error_numero_valido || $error_rango_numerico;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
    <style>
        .error{color: red;}
    </style>
</head>

<body>
    <form action="ej2.php" method="post">
        <h1>Ejercicio 2</h1>
        <p>
            <label for="numero">Introduce un número del 1 al 10</label>
            <input type="text" name="numero" id="numero">
            <?php
                /*controlamos los errores que pueda producirse al introducir un número*/
                if (isset($_POST["btnEnviar"]) && $error_campo_vacio) {
                    echo "<span class='error'>Campo vacío</span>";
                } elseif (isset($_POST["btnEnviar"]) && $error_numero_valido) {
                    echo "<span class='error'>No has introducido un número</span>";
                } elseif (isset($_POST["btnEnviar"]) && $error_rango_numerico) {
                    echo  "<span class='error'>Número fuera de rango</span>";
                }
            ?>
        </p>
        <button type="submit" name="btnEnviar">Mostrar tabla</button>
        <?php
            if (isset($_POST["btnEnviar"]) && !$error_numero){
                $fichero_tablas = "./Tablas/tabla_".$_POST["numero"].".txt";
                if (!file_exists($fichero_tablas)) {
                    die("<p>No hay ningún fichero para esa tabla</p>");                    
                    }else{
                    @$file=fopen($fichero_tablas,"r");
                    echo "<h2>Tabla del " .$_POST["numero"]."</h2>";
                    $contenido_mostrar = file_get_contents($fichero_tablas);
                    echo nl2br($contenido_mostrar);
                    }
                    fclose($file);
                    echo "<p> Fichero leido con éxito </p>";
                }
            
        ?>
    </form>
</body>

</html>