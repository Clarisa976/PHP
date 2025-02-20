<?php
echo "<div class='centrado'>";
echo "<p> Información del Producto " . $_POST["btnDetalles"] . " es:</p>";
if (isset($json_detalles["mensaje"])) {
    echo "<p> El producto ya no se encuentra en la BD</p>";
} elseif (isset($json_detalles["producto"])) {
    echo "<p><b>Nombre_corto:</b> " . $json_detalles["producto"]["nombre_corto"] . "</p>";
    echo "<p><b>Precio:</b> " . $json_detalles["producto"]["PVP"] . "</p>";
    echo "<p><b>Descripción:</b> " . $json_detalles["producto"]["descripcion"] . "</p>";
    echo "<p><b>Familia:</b> " . $json_detalles["producto"]["nombre_familia"] . "</p>";
    echo "<p><form action='index.php'><button type='submit'>Volver</button></form></p>";
}

echo "</div>";