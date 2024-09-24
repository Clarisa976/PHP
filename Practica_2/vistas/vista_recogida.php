<?php
echo "<h1>Estos son los datos enviados: </h1>";
//de esta forma se mostrará solamente lo que estamos pidiendo
echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
echo "<p><strong>Nacido en: </strong>" . $_POST["nacido"] . "</p>";
echo "<p><strong>El sexo es: </strong>".$_POST["sexo"]."</p>";




if (isset($_POST["aficiones"])) {
    echo "<p><strong>Las aficiones seleccionadas han sido: </strong><br>";
     echo "<ol>";
     foreach($_POST['aficiones'] as $campo) {
       
        echo "<li> $campo</li>";
        
    }
    echo "</ol>";
    
    echo "</p>";
} else {
    echo "<p><strong>No has seleccionado ninguna afición </strong> </p>";
}




if (isset($_POST["comentarios"]) && !empty(trim($_POST["comentarios"]))) {
    echo "<p><strong>El comentario enviado ha sido: </strong>" .($_POST["comentarios"]) . "</p>";
} else {
    echo "<p><strong>No has hecho ningún comentario </strong> </p>";

}
?>