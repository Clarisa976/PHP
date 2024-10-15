<form action="ej3.php" method="post" class="formulario principal">

    <h1 class="centro">Frases palíndromas - Formulario</h1>
    <p clase="centro">Dime una frase y te diré si es palíndroma o no.</p>
    <p>
        <label for="texto">Frase: </label><input id="texto" name="texto" type="text" value="<?php if (isset($_POST["primera"])) {echo $_POST["primera"];} ?>">
        <?php
        if (isset($_POST["comparar"]) && $error_texto) {
            if ($texto == "") {
                echo "<span class='error'> Campo vacío </span>";
            } else if ($longitud_texto < 3) {
                echo "<span class='error'> Debes teclear al menos tres caracteres </span>";
            } else {
                echo "<span class='error'> Debes teclear letras </span>";
            }
        } ?>
    </p>
    <button name="comparar">Comparar</button>
</form>