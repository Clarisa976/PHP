<form action="index.php" method="post" enctype="multipart/form-data">
    <h1>Rellena tu CV</h1>
    <p>
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>" maxlength="19" placeholder="Ponga su nombre">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_nombre)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    </p>
    <p>
        <label for="apellidos">Apellidos</label><br>
        <input type="text" name="apellidos" id="apellidos" value="<?php if (isset($_POST["apellidos"])) echo $_POST["apellidos"]; ?>">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_apellidos)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    </p>
    <p>
        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="password">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_pass)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    </p>
    <p>
        <label for="DNI">DNI</label><br>
        <input type="text" name="DNI" id="DNI" value="<?php if (isset($_POST["DNI"])) echo $_POST["DNI"]; ?>">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_DNI){
            if ($_POST["DNI"] == "") {
            echo "<span class='error'>*Campo vacío*</span>";
        }else {
                echo "<span class='error'>DNI incorrecto</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="sexo">Sexo</label><br>
        <!--así dejaremos marcada la opción deseada -->
        <input type="radio" name="sexo" value="Hombre" id="Hombre"
            <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Hombre") echo "checked"; ?>>
        <label for="Hombre">Hombre</label><br>
        <input type="radio" name="sexo" value="Mujer" id="Mujer"
            <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Mujer") echo "checked"; ?>>
        <label for="Mujer">Mujer</label><br>
        <?php
        if (isset($_POST["btnEnviar"]) && $error_sexo)
            echo "<span class='error'>*Debe seleccionar una opción*</span>";
        ?>
    </p>
    <p>
        <label for="foto">Incluir mi foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*">
        <?php
                if (isset($_POST["btnEnviar"])&& $_FILES["foto"]["name"]!="" && !$error_foto) {
                    
                    if ($_FILES["foto"]["error"]) {
                        echo " <span class='error'>No se ha subido el archivo seleccionado al servidor</span>";
                    }elseif (!tiene_extension($_FILES["foto"]["name"])) {
                        echo " <span class='error'>Has elegido un fichero sin extensión</span>";
                    }elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {
                        echo " <span class='error'>No has seleccionado un fichero de tipo imagen</span>";
                    }else{
                        echo " <span class='error'>El fichero seleccionado es mayor que 500kb</span>";
                    }
                }
            ?>
    </p>
    <p>
        <label for="nacido">Nacido en: </label>
        <select name="nacido" id="nacido">
            <!--así dejaremos marcada la opción deseada -->
            <option value="Malaga" <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "Malaga") echo "selected"; ?>>Málaga</option>
            <option value="Marbella" <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "Marbella") echo "selected"; ?>>Marbella</option>
            <option value="Estepona" <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "Estepona") echo "selected"; ?>>Estepona</option>
        </select>

    </p>
    <p>
        <label for="comentarios">Comentarios:</label>
        <textarea name="comentarios" id="comentarios" cols="40" rows="5">
         <?php if (isset($_POST["comentarios"])) echo $_POST["comentarios"]; ?>
         </textarea>
        <?php
        if (isset($_POST["btnEnviar"]) && $error_comentarios)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    </p>
    <p>
        <input type="checkbox" name="suscribirse" id="suscribirse"  <?php if(isset($_POST["suscribirse"])) echo "checked";?> >
        <label for="suscribirse">Subscribirse al boletín de Novedades</label>
    </p>
    <p>
        <input name="btnEnviar" type="submit" value="Guardar Cambios" id="btnGuardar">
        <input name="btnBorrar" type="submit" value="Borrar los datos introducidos" id="btnBorrar">
    </p>


</form>