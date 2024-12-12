<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej3 POO</title>
</head>
<body>
    <h1>Ejercicio 3 POO</h1>
    <?php
        require "class_fruta.php";
        echo "<h2>Información de mis fruticas</h2>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        //creamos una fruta
        $pera=new Fruta("verde","medianita");
        echo "<p>Creando una perita...</p>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        $melon=new Fruta("amarillo","grande");
        echo "<p>Creando un melón...</p>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        //hay varias formas de destruir un objeto:
        //unset($melon);
        $melon=null;
        echo "<p>Destruyendo el melón...</p>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        
        

        
    ?>
</body>
</html>