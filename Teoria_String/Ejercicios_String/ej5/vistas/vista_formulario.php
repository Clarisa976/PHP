<form action="ej5.php" method="post" class="formulario principal">

    <h1 class="centro">Árabes a romanos - Formulario</h1>
    <p clase="centro">Dime un número en números árabes y lo convertiré a cifras romanas.</p>
    <p>
        <label for="texto">Número: </label><input id="texto" name="texto" type="text" value="<?php if (isset($_POST["primera"])) {echo $_POST["primera"];} ?>">
        <?php
        if (isset($_POST["comparar"]) && $error_texto) {
            if ($texto == "") {
                echo "<span class='error'> Campo vacío </span>";
            } else {
                echo "<span class='error'> Debes teclear números árabes</span>";
            }
        } ?>
    </p>
    <button name="comparar">Convertir</button>
</form>