<form action="index.php" method="post" enctype="multipart/form-data">
    <h1>Esta es mi super página</h1>
    <p>
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>" maxlength="19" placeholder="Ponga su nombre">
        <?php
        if (isset($_POST["btnEnviar"]) && $error_nombre)
            echo "<span class='error'>*Campo obligatorio*</span>";
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
            echo "<span class='error'>*Campo obligatorio*</span>";
        ?>
    </p>

    <p>
        <label for="aficiones">Aficiones:</label>
        
        <label for="deportes">Deportes</label>
        <input type="checkbox" name="aficiones[]" id="deportes" value="deporte" <?php if(isset($_POST["aficiones[]"])) echo "checked";?>>
        <label for="lectura">Lectura</label>
        <input type="checkbox" name="aficiones[]" id="lectura" value="lectura" <?php if(isset($_POST["aficiones[]"])) echo "checked";?>>
        <label for="otros">Otros</label>
        <input type="checkbox" name="aficiones[]" id="otros" value="otros" <?php if(isset($_POST["aficiones[]"])) echo "checked";?>>
    </p>

    <p>
        <label for="comentarios">Comentarios:</label>
        <textarea name="comentarios" id="comentarios" cols="40" rows="5"><?php if (isset($_POST["comentarios"])) echo $_POST["comentarios"]; ?></textarea>
        
    </p>

    <p>
        <input name="btnEnviar" type="submit" value="Guardar Cambios" id="btnGuardar">
        <input name="btnBorrar" type="submit" value="Borrar los datos introducidos" id="btnBorrar">
    </p>


</form>