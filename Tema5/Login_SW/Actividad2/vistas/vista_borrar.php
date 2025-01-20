<?php
    echo "<div class='centrado txt_centrado'>";
    echo "<form action='index.php' method='POST'>";
    echo "<p> Se dispone a borrar el producto: " . $_POST["id_usuario"] . "</p>";
    echo "<p> ¿Esta seguro?</p>";
    echo "<button type='submit' >Volver</button>";
    echo "<button name='btnContBorrar' value='" . $_POST["id_usuario"] . "' type='submit' >Continuar</button>";
    echo "</form>";
    echo "</div>";
?>