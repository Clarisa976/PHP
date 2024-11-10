<h2>Agregar Nuevo Usuario </h2>
<form action='index.php' method='post' enctype='multipart/form-data'>
    <label for="nombre">Nombre:</label><br />
    <input type="text" placeholder="Nombre..." name="nombre" id="nombre"
        value="<?php if (isset($_POST["nombre"])) {
            echo $_POST["nombre"];
        } ?>">
    <?php
    if (isset($_POST["btnContAgregar"]) && $error_nombre) {
        echo "<span class='error'> *Campo vacio*</span>";
    }
    ?>
    <br />
    <label for="usuario">Usuario:</label><br />
    <input type="text" placeholder="Usuario..." name="usuario" id="usuario"
        value="<?php if (isset($_POST["usuario"])) {
            echo $_POST["usuario"];
        } ?>">
    <?php
    if (isset($_POST["btnContAgregar"]) && $error_usuario) {
        if ($_POST["usuario"] == "") {
            echo "<span class='error'> *Campo vacio*</span>";
        } else {
            echo "<span class='error'>*Este usuario ya existe*</span>";
        }
    }
    ?>
    <br />
    <label for="clave">Contraseña:</label><br />
    <input type="password" placeholder="Clave..." name="clave" id="clave"
        value="<?php if (isset($_POST["clave"])) {
            echo $_POST["clave"];
        } ?>">
    <?php
    if (isset($_POST["btnContAgregar"]) && $error_clave) {
        echo "<span class='error'> *Campo vacio*</span>";
    }
    ?>
    <br />
    <label for="dni">DNI:</label><br />
    <input type="text" name="dni" id="dni" placeholder="DNI: 12345678A"
        value="<?php if (isset($_POST["dni"])) {
            echo $_POST["dni"];
        } ?>">
    <?php
    if (isset($_POST["btnContAgregar"]) && $error_dni) {
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
    if (isset($_POST["btnContAgregar"]) && $error_sexo) {
        echo "<span class='error'> *Campo vacio*</span>";
    }
    ?>
    <br />
    <input type="radio" name="sexo" id="hombre" value="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") {
        echo "checked";
    } ?>><label for="hombre">Hombre</label></br>
    <input type="radio" name="sexo" id="mujer" value="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") {
        echo "checked";
    } ?>><label for="mujer">Mujer</label>

    <p><label for="foto">Incluir mi foto (500KB)</label><input type="file" name="foto" id="foto">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_foto) {

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
    <p><button type="submit" name="btnContAgregar">Guardar Cambios</button><button type="submit">Atras</button></p>
</form>