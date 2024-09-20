echo "<h1>Recogida de datos</h1>";
//de esta forma se mostrará solamente lo que estamos pidiendo
echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
echo "<p><strong>Contraseña: </strong>" . $_POST["pass"] . "</p>";
echo "<p><strong>Sexo: </strong>";
if (isset($_POST["sexo"])) {
    echo $_POST["sexo"];
}
echo "</p>";
echo "<p><strong>Nacido en: </strong>" . $_POST["nacido"] . "</p>";
echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
echo "<p><strong>Suscrito: </strong>";

if (isset($_POST["suscribirse"])) {
    //echo "<p><strong>Suscrito:</strong>".$_POST["suscribirse"]."</p>";
    echo "Sí";
} else {
    echo "No";
}
echo "</p>";
