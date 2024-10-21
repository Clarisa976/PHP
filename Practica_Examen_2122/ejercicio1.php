<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form action="ejercicio1.php" method="post">
        <p>
            <label for="texto">Introduce un texto</label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST['texto'])) echo $_POST['texto'] ?>">

        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnEnviar"])) {

        function mi_strlen($texto)
        {
            $contador = 0;
            while (isset($texto[$contador])) {
                $contador++;
            }
            return $contador;
        }

        echo "<p> Has introducido " . mi_strlen($_POST["texto"]) . " caracteres</p>";
    }
    ?>


</body>

</html>