<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen DWESE Curso 23-24</title>
    <style>
        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        .enlinea{
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log['usuario']; ?> - <form class="enlinea" action="../admin/index.php" method="post">
                <button type="submit" name="btnSalir" class="enlace">Salir</button>
            </form></strong>
    </div>
    <?php
    //si tiene notas se muestra en una tabla y sino se dice que no tiene
    ?>
</body>

</html>