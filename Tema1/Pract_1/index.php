<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
</head>

<body>
    <h1>Rellena tu CV</h1>
    <form action="recogida_datos.php" method="post" enctype="multipart/form-data">

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="" required maxlength="19" placeholder="Ponga su nombre">
        </p>
        <p>
            <label for="apellidos">Apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos">
        </p>
        <p>
            <label for="pass">Contraseña</label><br>
            <input type="password" name="pass" id="password">
        </p>
        <p>
            <label for="DNI">DNI</label><br>
            <input type="text" name="DNI" id="DNI">
        </p>
        <p>
            <label for="sexo">Sexo</label><br>
            <input type="radio" name="sexo" value="Hombre" id="Hombre">
            <label for="Hombre">Hombre</label><br>
            <input type="radio" name="sexo" value="Mujer" id="Mujer">
            <label for="Mujer">Mujer</label><br>
        </p>
        <p>
            <label for="addFoto">Incluir mi foto:</label>
            <input type="file" name="addFoto" id="foto" accept="image/*">
        </p>
        <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
                <option value="Malaga" selected>Málaga</option>
                <option value="Marbella">Marbella</option>
                <option value="Estepona">Estepona</option>
            </select>
        </p>
        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" cols="40" rows="5"></textarea>
        </p>
        <p>
            <input type="checkbox" name="suscribirse" id="suscribirse" checked>
            <label for="suscribirse">Subscribirse al boletín de Novedades</label>
        </p>
        <p>
            <input name="btnEnviar" type="submit" value="Guardar Cambios" id="btnGuardar">
            <input type="reset" value="Borrar los datos introducidos" id="btnBorrar">
        </p>


    </form>

</body>

</html>