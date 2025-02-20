<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_servicios.php";

$app = new \Slim\App;

$app->get('/logueado', function () {
    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para acceder a este servicio"));
    }
});


$app->post('/login', function ($request) {
    $usuario = $request->getParam('usuario');
    $clave = $request->getParam('clave');
    echo json_encode(login($usuario, $clave));
});


$app->run();
