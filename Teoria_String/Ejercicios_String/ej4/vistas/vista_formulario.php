<form action="ej4.php" method="post" class="formulario principal">

    <h1 class="centro">Romanos a árabes - Formulario</h1>
    <p clase="centro">Dime un número en números romanos y lo convertiré a cifras árabes.</p>
    <p>
        <label for="texto">Número: </label><input id="texto" name="texto" type="text" value="<?php if (isset($_POST["primera"])) {echo $_POST["primera"];} ?>">
        <?php
        if (isset($_POST["comparar"]) && $error_texto) {
            if ($texto == "") {
                echo "<span class='error'> Campo vacío </span>";
            } else {
                echo "<span class='error'> Debes teclear números romanos</span>";
            }
        } ?>
    </p>
    <button name="comparar">Convertir</button>
</form>