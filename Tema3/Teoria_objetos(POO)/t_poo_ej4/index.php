<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej4 POO</title>
</head>
<body>
    <h1>Ejercicio 4 POO</h1>
    <?php
        require "class_uva.php";
        echo "<h2>Información de mi uva</h2>";
        $uva=new Uva("verde","pequeña",false);
        if($uva->tieneSemilla()){
            echo "<p>La uva tiene semilla y además:</p>";
           $uva->imprimir();
    
        }else{
            echo "<p>La uva no tiene semilla y además:</p>";
            $uva->imprimir();
        }
        
        

        
    ?>
</body>
</html>