<form action="ej1.php" method="post">
            <div class="formulario principal">
                <h1 class="centro">Ripios - Formulario</h1>
                <p>
                <h2 clase="centro">Dime dos palabras y te diré si riman o no.</h2>
                <label for="primera">Primera palabra: </label>
                <input type="text" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $primera ?>">
                <?php
                if (isset($_POST["comparar"]) && $error_primera) {
                    if ($primera == "") {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                    }
                }
                ?>
                </p>
                <p>
                    <label for="segunda">Segunda palabra: </label>
                    <input type="text" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $segunda ?>">
                    <?php
                    if (isset($_POST["comparar"]) && $error_segunda) {
                        if ($segunda == '') {
                            echo "<span class = 'error'> Campo vacío </span>";
                        } else {
                            echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                        }
                    }
                    ?>
                </p>
                <p>
                    <input type="submit" value="Comparar" name="comparar">
                </p>
            </div>
        </form>