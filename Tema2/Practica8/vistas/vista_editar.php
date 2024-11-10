<?php
if (isset($_POST["btnEditar"])) {
    if (mysqli_num_rows($resultado) > 0) {
        $tupla_detalles = mysqli_fetch_assoc($resultado);
        $id_usuario = $tupla_detalles["id_usuario"];
        $nombre = $tupla_detalles["nombre"];
        $usuario = $tupla_detalles["usuario"];
        $clave = ''; // La contraseña no se muestra por seguridad
        $sexo = $tupla_detalles["sexo"];
        $dni = $tupla_detalles["dni"];
        $foto_bd = $tupla_detalles["foto"]; // Obtenemos el nombre de la foto actual
        mysqli_free_result($resultado);
    } else {
        mysqli_free_result($resultado);
        die("<p>El usuario ya no se encuentra registrado en la BD</p></body></html>");
    }
} else {
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $sexo = $_POST["sexo"];
    $dni = $_POST["dni"];
    $foto_bd = $_POST["foto_bd"];
}

?>
<h2> Editar Usuario <?php echo $id_usuario; ?></h2>
<form action='index.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
    <input type="hidden" name="foto_bd" value="<?php echo $foto_bd; ?>">
    <label for="nombre">Nombre:</label><br />
    <input type="text" placeholder="Nombre..." name="nombre" id="nombre" value="<?php echo $nombre; ?>">
    <?php
    if (isset($_POST["btnContEditar"]) && $error_nombre) {
        echo "<span class='error'> *Campo vacio*</span>";
    }
    ?>
    <br />
    <label for="usuario">Usuario:</label><br />
    <input type="text" placeholder="Usuario..." name="usuario" id="usuario" value="<?php echo $usuario; ?>">
    <?php
    if (isset($_POST["btnContEditar"]) && $error_usuario) {
        if ($_POST["usuario"] == "") {
            echo "<span class='error'> *Campo vacio*</span>";
        } else {
            echo "<span class='error'>*Este usuario ya existe*</span>";
        }
    }
    ?>
    <br />
    <label for="clave">Contraseña:</label><br />
    <input type="password" placeholder="Contraseña..." name="clave" id="clave" value="<?php echo $clave; ?>">
    <?php
    if (isset($_POST["btnContEditar"]) && $error_clave) {
        echo "<span class='error'> *Campo vacio*</span>";
    }
    ?>
    <br />
    <label for="dni">DNI:</label><br />
    <input type="text" name="dni" id="dni" placeholder="DNI: 123456789A" value="<?php echo $dni; ?>">
    <?php
    if (isset($_POST["btnContEditar"]) && $error_dni) {
        if ($_POST["dni"] == "") {
            echo "<span class='error'> *Campo vacio*</span>";
        } else {
            echo "<span class='error'>*Formato erroneo*</span>";
        }
    }
    ?>
    <br />
    <label for="sexo">Sexo:</label>
    <?php
    if (isset($_POST["btnContEditar"]) && $error_sexo) {
        echo "<span class='error'> *Campo vacio*</span>";
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

    <p><label for="foto">Incluir mi foto (500KB)</label><input type="file" name="foto" id="foto">
        <?php
        if (isset($_POST["btnContEditar"]) && $error_foto) {

            if ($_FILES["foto"]["error"]) {
                echo "<span class='error'> * No se ha subido el archivo seleccionado al servidor * </span>";
            } elseif (!tiene_extension($_FILES["foto"]["name"])) {
                echo "<span class='error'> * Has seleccinado un fichero sin extensión * </span>";
            } elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {
                echo "<span class='error'> * No has seleccionado un archivo imagen * </span>";
            } else {
                echo "<span class='error'> * El fichero seleccionado es mayor a 500 KB * </span>";
            }

        }
        ?>
    </p>
    <p><button type="submit" name="btnContEditar">Guardar Cambios</button><button type="submit">Atras</button></p>
</form>