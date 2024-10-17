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
    <title>Ejercicios de ficheros - Ejercicio 1</title>
    <style>
        .error{color: red;}
    </style>
</head>

<body>
    <form action="ej1.php" method="post">
        <h1>Ejercicio 1</h1>
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
        <button type="submit" name="btnEnviar">Multiplicar</button>
        <?php
            if (isset($_POST["btnEnviar"]) && !$error_numero){
                $fichero_tablas = "./Tablas/tabla_".$_POST["numero"].".txt";
                if (file_exists($fichero_tablas)) {
                    die("<p>No se ha podido crear el fichero '".$fichero_tablas."' porque ya existe</p>");                    
                    }else{
                    @$file=fopen($fichero_tablas,"w");
                    for ($i = 1; $i <= 10; $i++) {
                        $tablas_multiplicar = $i. " x ".$_POST["numero"]." = ".$i*$_POST["numero"];
                        fwrite($file,PHP_EOL.$tablas_multiplicar);
                    }
                    fclose($file);
                    echo "<p> Fichero generado con éxito </p>";
                }
            }
        ?>
    </form>
</body>

</html>