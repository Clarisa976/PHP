<h2>Editando el usuario <?php echo $id_usuario ?></h2>
<form action="index.php" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" />
        <?php
        if (isset($_POST["btnContEditar"]) && $error_nombre)
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
        <input type="text" name="usuario" id="usuario" value="<?php echo $usuario ?>" />
        <?php
        if (isset($_POST["btnContEditar"]) && $error_usuario)
            if ($_POST["usuario"] == "") {
                echo "<span class='error'> * Campo vacío * </span>";
            } else if (strlen($_POST["usuario"]) > 20) {
                echo "<span class='error'> * El tamaño máximo del nombre de usuario es de 20 carácteres * </span>";
            } else {
                echo "<span class='error'> * Usuario repe * </span>";
            }
        ?>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" paceholder="Editar clave" id="clave" value="" />

    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email ?>" />
        <?php
        if (isset($_POST["btnContEditar"]) && $error_email) {
            if ($_POST["email"] == "") {
                echo "<span class='error'> * Campo vacío * </span>";
            } else if (strlen($_POST["email"]) > 50) {
                echo "<span class='error'> * El tamaño máximo del email es de 50 carácteres * </span>";
            } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo "<span class='error'> * Email sintácticamente incorrecto * </span>";
            } else {
                echo "<span class='error'> * Email repe * </span>";
            }
        }

        ?>
    <p>
        <button type="submit" name="btnContEditar" value="<?php echo $id_usuario ?>">Continuar</button>
        <button type="submit">Atrás</button>
    </p>
</form>