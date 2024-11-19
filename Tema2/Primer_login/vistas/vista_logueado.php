<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .enlinea {
            display: inline;
        }

        .enlace {
            background: none;
        }
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"] ?></strong>
        <form class="enlinea" action="index.php" method="post">
            <button class="enlace" type="submit" name="btnCerrarSession">Salir</button>
        </form>
    </div>
</body>

</html>