<h2>Añadir nuevo usuario</h2>
<form action="index.php" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_nombre)
        if ($_POST["nombre"] == "") {
            echo "<span class='error'> * Campo vacío * </span>";
        } else if (strlen($_POST["nombre"]) > 30) {
            echo "<span class='error'> * El tamaño máximo del nombre es de 30 carácteres * </span>";
        } else {
            echo "<span class='error'> * Ese nombre ya está en uso * </span>";
        }
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_usuario)
        if ($_POST["usuario"] == "") {
            echo "<span class='error'> * Campo vacío * </span>";
        } else if (strlen($_POST["usuario"]) > 20) {
            echo "<span class='error'> * El tamaño máximo del nombre de usuario es de 20 carácteres * </span>";
        } else {
            echo "<span class='error'> * Ese usuario ya está en uso * </span>";
        }
        ?>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" value="<?php if (isset($_POST["clave"])) echo $_POST["clave"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_clave)
        if ($_POST["clave"] == "") {
            echo "<span class='error'> * Campo vacío * </span>";
        } else if (strlen($_POST["clave"]) > 50) {
            echo "<span class='error'> * El tamaño máximo de la clave es de 50 carácteres * </span>";
        }
        ?>
    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>" />
        <?php
        if (isset($_POST["btnContAgregar"]) && $error_email) {
            if ($_POST["email"] == "") {
                echo "<span class='error'> * Campo vacío * </span>";
            } else if (strlen($_POST["email"]) > 50) {
                echo "<span class='error'> * El tamaño máximo del email es de 50 carácteres * </span>";
            } else {
                echo "<span class='error'> * Ese email ya está en uso * </span>";
            }
        }

        ?>
    <p>
        <button type="submit" name="btnContAgregar">Continuar</button>
        <button type="submit">Atrás</button>
    </p>
</form>