<form action="index.php" method="post" enctype="multipart/form-data">
    <h1>Esta es mi super página</h1>
    <p>
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>" maxlength="19">
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
        <label for="sexo">Sexo: </label>
        <!--así dejaremos marcada la opción deseada -->
        <label for="Hombre">Hombre</label>
        <input type="radio" name="sexo" value="Hombre" id="Hombre"
            <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Hombre") echo "checked"; ?>>

        <label for="Mujer">Mujer</label><input type="radio" name="sexo" value="Mujer" id="Mujer"
            <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Mujer") echo "checked"; ?>>
        
        <?php
        if (isset($_POST["btnEnviar"]) && $error_sexo)
            echo "<span class='error'>*Campo obligatorio*</span>";
        ?>
    </p>

    <p>
        <label for="aficiones">Aficiones:</label>

        <label for="deportes">Deportes</label>
        <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes" <?php if (isset($_POST["aficiones"]) && mi_in_array("Deportes",$_POST["aficiones"])) echo "checked"; ?>>
        <label for="lectura">Lectura</label>
        <input type="checkbox" name="aficiones[]" id="lectura" value="Lectura" <?php if (isset($_POST["aficiones"]) && mi_in_array("Lectura",$_POST["aficiones"])) echo "checked"; ?>>
        <label for="otros">Otros</label>
        <input type="checkbox" name="aficiones[]" id="otros" value="Otros" <?php if (isset($_POST["aficiones"]) && mi_in_array("Otros",$_POST["aficiones"])) echo "checked"; ?>>
    </p>

    <p>
        <label for="comentarios">Comentarios:</label>
        <textarea name="comentarios" id="comentarios" cols="25" rows="4"><?php if (isset($_POST["comentarios"])) echo $_POST["comentarios"]; ?></textarea>

    </p>

    <p>
        <button name="btnEnviar" type="submit" value="" id="btnGuardar">Enviar</button>
    </p>


</form>