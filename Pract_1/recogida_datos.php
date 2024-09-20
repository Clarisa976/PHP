<!--
    Cuando mandemos datos se generará un array asociativo con
    tantos índices como haya en el formulario
    sería $ _get si el método es get y $ _post si el método es post
-->
<?php
if (!isset($_POST["btnEnviar"])) {
    //un header:location tiene qe estar siempre antes del código html
    header(header: "Location:index.php"); //salta a index al meterse en la página
    exit; //se sale
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
</head>

<body>
    <h1>Recogida de datos</h1>
    <?php
    //así podremos guardar todos los datos introducidos en el formulario
    //var_dump($_POST);

    //de esta forma se mostrará solamente lo que estamos pidiendo
    echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["pass"] . "</p>";
    echo "<p><strong>Sexo: </strong>";
    if (isset($_POST["sexo"])) {
        echo $_POST["sexo"];
    }
    echo "</p>";
    echo "<p><strong>Nacido en: </strong>" . $_POST["nacido"] . "</p>";
    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
    echo "<p><strong>Suscrito: </strong>";

    if (isset($_POST["suscribirse"])) {
        //echo "<p><strong>Suscrito:</strong>".$_POST["suscribirse"]."</p>";
        echo "Sí";
    } else {
        echo "No";
    }
    echo "</p>";
    ?>
</body>

</html>