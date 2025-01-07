<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function($request){

    
    //$datos["cod"]=$request->getParam('cod');
    //echo json_encode(array("mensaje"=> "Hola ".$request->getAttribute('codigo')) ,JSON_FORCE_OBJECT);
    $respuesta["mensaje"]="Hola, buenos dias";
    echo json_encode($respuesta);
});

// Una vez creado servicios los pongo a disposición
$app->run();
?>