<?php
if (isset($_POST['btnSalir'])) {
    session_destroy();
    header()
}
?>
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
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log['usuario']; ?> - <form action="index.php" method="post">
                <button type="submit" name="btnSalir" class="enlace">Salir</button>
            </form></strong>
    </div>
    <?php
    //si tiene notas se muestra en una tabla y sino se dice que no tiene
    ?>
</body>

</html>