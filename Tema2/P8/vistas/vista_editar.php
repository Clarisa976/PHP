<?php
 if (isset($detalles_usuario)) {
    // Obtenemos los datos del usuario a editar
    $id_usuario = $_POST["btnEditar"];

    $nombre = $detalles_usuario['nombre'];
    $usuario = $detalles_usuario['usuario'];
    $dni = $detalles_usuario['dni'];
    $sexo = $detalles_usuario['sexo'];
    $foto_bd = $detalles_usuario['foto'];
    $clave = ""; // No se muestra la clave
} else if (isset($_POST["btnContEditar"])) {
    // Recuperamos los datos enviados en el formulario en caso de error
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $dni = $_POST["dni"];
    $sexo = $_POST["sexo"];
    $foto_bd = $_POST["foto_bd"];
    $clave = $_POST["clave"];
}

?>
<h2> Editar Usuario <?php echo $id_usuario; ?></h2>
<form action='index.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
    <input type="hidden" name="foto_bd" value="<?php echo $foto_bd; ?>">
    <label for="nombre">Nombre:</label><br />
    <input type="text" placeholder="Nombre..." name="nombre" id="nombre" value="<?php echo $nombre; ?>">
    <?php
    if (isset($error_nombre) && $error_nombre) {
        echo "<span class='error'> *Campo vacío*</span>";
    }
    ?>
    <br />
    <label for="usuario">Usuario:</label><br />
    <input type="text" placeholder="Usuario..." name="usuario" id="usuario" value="<?php echo $usuario; ?>">
    <?php
    if (isset($error_usuario) && $error_usuario) {
        if ($_POST["usuario"] == "") {
            echo "<span class='error'> *Campo vacío*</span>";
        } else {
            echo "<span class='error'>*Este usuario ya existe*</span>";
        }
    }
    ?>
    <br />
    <label for="clave">Contraseña:</label><br />
    <input type="password" placeholder="Contraseña..." name="clave" id="clave" value="">
    <br />
    <label for="dni">DNI:</label><br />
    <input type="text" name="dni" id="dni" placeholder="DNI: 12345678A" value="<?php echo $dni; ?>">
    <?php
    if (isset($error_dni) && $error_dni) {
        if ($_POST["dni"] == "") {
            echo "<span class='error'> *Campo vacío*</span>";
        } elseif (repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]), $_POST["id_usuario"])) {
            echo "<span class='error'>*Este DNI ya está registrado*</span>";
        } else {
            echo "<span class='error'>*Formato erróneo*</span>";
        }
    }
    ?>
    <br />
    <label for="sexo">Sexo:</label>
    <?php
    if (isset($error_sexo) && $error_sexo) {
        echo "<span class='error'> *Debe seleccionar una opción*</span>";
    }
    ?>
    <br />
    <input type="radio" name="sexo" id="hombre" value="hombre" <?php if ($sexo == "hombre") {
        echo "checked";
    } ?>><label
        for="hombre">Hombre</label></br>
    <input type="radio" name="sexo" id="mujer" value="mujer" <?php if ($sexo == "mujer") {
        echo "checked";
    } ?>><label
        for="mujer">Mujer</label>

    <p><label for="foto">Incluir mi foto (máx 500KB):</label><input type="file" name="foto" id="foto">
        <?php
        if (isset($error_foto) && $error_foto) {
            if ($_FILES["foto"]["error"]) {
                echo "<span class='error'> * No se ha subido el archivo seleccionado al servidor * </span>";
            } elseif (!tiene_extension($_FILES["foto"]["name"])) {
                echo "<span class='error'> * El archivo no tiene una extensión válida * </span>";
            } elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {
                echo "<span class='error'> * No has seleccionado un archivo de imagen * </span>";
            } else {
                echo "<span class='error'> * El fichero seleccionado es mayor a 500 KB * </span>";
            }
        }
        ?>
    </p>
    <p><button type="submit" name="btnContEditar">Guardar Cambios</button><button type="submit">Atrás</button></p>
</form>
