<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_ctes.php";

$app= new \Slim\App;

$app->post('/login',function($request){
    //obtiene usuario y clave
    //comprueba si está o no en la bd
    $usuario=$request->getParam("usuario");
    $clave=$request->getParam("clave");
    echo json_encode(login($usuario,$clave));
});



$app->run();

?>