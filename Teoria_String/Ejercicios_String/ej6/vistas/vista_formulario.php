<form action="ej6.php" method="post">
            <div class="formulario principal">
                <h1 class="centro">Quita acentos - Formulario</h1>
                <p>
                <h2 clase="centro">Escribe un texto y le quitaré los acentos.</h2>
                <label for="txtQuitarAcentos">Texto: </label>
                <textarea name="txtQuitarAcentos" value="" id="txtQuitarAcentos" cols="30" rows="5"><?php if (isset($_POST["txtQuitarAcentos"])) echo $_POST["txtQuitarAcentos"]; ?></textarea>
                <?php
                if (isset($_POST["comparar"]) && $error_form) {
                    if ($texto == "") 
                        echo "<span class = 'error'> Campo vacío </span>";
                    
                    
                }
                ?>
                </p>
                
                <p>
                    <input type="submit" value="Quitar acentos" name="comparar">
                </p>
            </div>
        </form>