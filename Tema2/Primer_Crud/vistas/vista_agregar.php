<h2>Añadir nuevo usuario</h2>
<form action="index.php" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_nombre)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_usuario)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" value="<?php if (isset($_POST["clave"])) echo $_POST["clave"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_clave)
            echo "<span class='error'>*Campo vacío*</span>";
        ?>
    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_email) {
            if ($_POST["email"] = "") {
                echo "<span class='error'>*Campo vacío*</span>";
            } else if ($error_email_formato) {
            } else {
                echo "<span class='error'>*El email ya está en la base de datos*</span>";
            }
        }

        ?>
    <p>
        <button type="submit" name="btnContAgregar">Continuar</button>
        <button type="submit">Atrás</button>
    </p>
</form>