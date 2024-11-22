<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 9</title>
    <link rel="stylesheet" href="src/style.css">
</head>
<body>
    <h1>Práctica 9</h1>
    <?php
        if(isset($_SESSION["mensaje_accion"])){
            echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        }
    ?>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
    </div>
    <?php
        if(isset($_SESSION["mensaje_registro"])){
            echo"<p class='mensaje'>".$_SESSION["mensaje_registro"]."</p>";
            unset($_SESSION["mensaje_registro"]);
        }
    ?>
</body>
</html>