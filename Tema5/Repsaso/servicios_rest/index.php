<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_CTES.php";

$app = new \Slim\App;



$app->post('/login', function ($request) {

    $datos_login[] = $request->getParam("usuario");
    $datos_login[] = $request->getParam("clave");


    echo json_encode(login($datos_login));
});

//logueado
$app->get('/logueado', function () {
    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

/*Mediante una petición GET, obtener todos los datos de un usuario. En caso de error por la BD el JSON devuelto será: {“error” : “Error….”}. Si el usuario no se encuentra registrado en la base de datos el JSON será: {“mensaje”: “El usuario con (id_usuario) no se encuentra registrado en la BD”}, en otro caso el JSON será: { “usuario” : […]} */
$app->get('/usuario/{id_usuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            $id_usuario = $request->getAttribute("id_usuario");
            echo json_encode(obtener_usuario($id_usuario));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});
/*Mediante una petición GET, obtener todos los datos de todos los usuarios que están de guardia un día a una hora. En caso de error por la BD el JSON devuelto será: {“error” : “Error….”}, en otro caso el JSON será: { “usuarios” : [[…], [...],…,[…]]} */
$app->get('/usuariosGuardia/{dia}/{hora}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            $dia = $request->getAttribute("dia");
            $hora = $request->getAttribute("hora");
            echo json_encode(usuarios_guardia($dia, $hora));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});
/*Mediante una petición GET, saber si un usuario está de guardia un día a una hora. En caso de error por la BD el JSON devuelto será: { “error” : “Error….”}, en otro caso el JSON será: { “de_guardia” : true} o { “de_guardia” : false} */
$app->get('/deGuardia', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            $dia = $request->getParam("dia");
            $hora = $request->getParam("hora");
            $usuario = $request->getParam("usuario");
            echo json_encode(deGuardia($dia, $hora, $usuario));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    
});

$app->run();
