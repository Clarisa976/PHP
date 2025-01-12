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
//tercer servicio: método post para insertar un producto mostrando por abajo el mensaje 'El producto (nombre_corto) se ha insertado correctamente'
$app->post('/producto/insertar',function($request){
    //los datos indroducidos se guardarían en un array
    $datos=[
        $request->getParam('codigo'),
        $request->getParam('nombre'),
        $request->getParam('nombre_corto'),
        $request->getParam('descripcion'),
        $request->getParam('PVP'),
        $request->getParam('familia'),
    ];
    echo json_encode(insertar_producto($datos));
});
//cuarto servicio: método put para actualizar los datos de un producto a través de su cod. mostrando por abajo el mensaje 'El producto (nombre_corto) se ha actualizado correctamente'
$app->put('/producto/actualizar/{codigo}',function($request){
    $datos=[
        $request->getParam('nombre'),
        $request->getParam('nombre_corto'),
        $request->getParam('descripcion'),
        $request->getParam('PVP'),
        $request->getParam('familia'),
    ];
    echo json_encode(actualizar_producto($datos));
});

//quinto servicio: método delete para borrar un producto a través de su cod. mostrando por abajo el mensaje 'El procuto(codigo) se ha borrado correctamente'
$app->delete('/producto/borrar/{codigo}',function($request){
    echo json_encode(borrar_producto($request->getAttribute('codigo')));
});

//sexto servicio: método get que nos devolverá la información de todas las familias
$app->get('/familias',function(){
    echo json_encode(obtener_familias());
});
//séptimo servicio: método get para comprobar si hay repetidos al insertar
$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request){
    echo json_encode(repetidos_insertar($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')));
});
//octavo servicio: método get para mirar si hay repetidos al editar
$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request){
    echo json_encode(repetidos_actualizar($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')));
});

// Una vez creado servicios los pongo a disposición
$app->run();
