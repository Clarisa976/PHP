<?php

require __DIR__ . '/Slim/autoload.php';
require "src/funciones.php";

//primer servicio: método get para obtener todos los productos
$app->get('/productos', function () {
    //devolvemos un json de un array de todos los productos o un mensaje de error al no poder conectarse
    echo json_encode(obtener_productos());
});

//segundo servicio: método get para obtener un producto por su id
$app->get('/producto/{cod}',function($request){
    $cod=$request->getAttribute("cod");
    echo json_encode(obtener_producto($cod));
});

// Una vez creado servicios los pongo a disposición
$app->run();
