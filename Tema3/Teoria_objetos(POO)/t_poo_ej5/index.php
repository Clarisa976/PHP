<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej5 POO</title>
</head>
<body>
    <h1>Ejercicio 5 POO</h1>
    <?php
        require "class_empleado.php";
        echo "<h2>Información de mis empleados </h2>";
        
        $empleado1 = new Empleado("David Domingo", 2500);
        $empleado2 = new Empleado("Dominga Diaz", 3500);

        $empleado1->impuestos();
        $empleado2->impuestos();
        
    ?>
</body>
</html>