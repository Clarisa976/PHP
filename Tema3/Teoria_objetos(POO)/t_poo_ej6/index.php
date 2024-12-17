<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej6 POO</title>
</head>
<body>
    <h1>Ejercicio 6 POO</h1>
    <?php
        require "class_menu.php";
        $m= new Menu();
        $m -> cargar("https://classroom.google.com/u/0/h","classroom");
        $m -> cargar("https://classroom.google.com/u/0/h","class");
        $m -> cargar("https://classroom.google.com/u/0/h","room");
        $m->vertical();
        $m->horizontal();
        
        
        
    ?>
</body>
</html>