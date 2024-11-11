<?php
echo "<h2>Detalles del usuario " . $_POST["btnDetalle"] . "</h2>";
if (mysqli_num_rows($resultado) > 0) {
    $tupla_detalles = mysqli_fetch_assoc($resultado);
    echo "<p>";
    echo "<strong>Nombre: </strong>" . $tupla_detalles["nombre"] . "<br/>";
    echo "<strong>Usuario: </strong>" . $tupla_detalles["usuario"] . "<br/>";
    echo "<strong>Clave: </strong><br/>";
    echo "<strong>DNI: </strong>" . $tupla_detalles["dni"] . "<br/>";
    echo "</p>";
    echo "<strong>Sexo: </strong>" . $tupla_detalles["sexo"] . "<br/>";
    echo "<strong>Foto: </strong><img alt='foto usuario' title='foto usuario' src='Img/" . $tupla_detalles["foto"] . "'><br/>";
    echo "</p>";
    echo "</p>";
} else {
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
}
mysqli_free_result($resultado);
?>