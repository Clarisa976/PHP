<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;



$app->get('/logueado', function () {
    $test = validateToken();
    if (is_array($test))
        echo json_encode($test);
    else
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->post('/login', function ($request) {

    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");
    echo json_encode(login($usuario, $clave));
});

//NO HACER SALIR

//obetener todos los datos de los alumnos con un get
$app->get('/alumnos', function () {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test['usuario']['tipo']=='tutor') {
                echo json_encode((obtener_alumnos()));
            }else{
                echo json_encode(array('no_auth' => "No tienes permiso para usar este servicio"));
            }
        }
        echo json_encode(($test));
    } else {
        echo json_encode(array('no_auth' => "No tienes permiso para usar este servicio"));
    }
});

$app->get('/notasAlumno/{cod_alu}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            
                $cod_alu = $request->getAttribute('cod_alu');
                echo json_encode((obtener_notas_alumnos($cod_alu)));
            
        }
        echo json_encode(($test));
    } else {
        echo json_encode(array('no_auth' => "No tienes permiso para usar este servicio"));
    }
});

$app->get('/conexion_PDO',function($request){

    echo json_encode(conexion_pdo());
});

$app->get('/conexion_MYSQLI',function($request){
    
    echo json_encode(conexion_mysqli());
});



// Una vez creado servicios los pongo a disposición
$app->run();
?>
