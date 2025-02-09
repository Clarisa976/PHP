<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;



$app->get('/logueado',function(){
    $test=validateToken();
    if(is_array($test))
        echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->post('/login',function($request){
  
    $usuario=$request->getParam("usuario");
    $clave=$request->getParam("clave");
    echo json_encode(login($usuario,$clave));
    
});


$app->get('/usuario/{id_usuario}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
        {
            $id_usuario=$request->getAttribute("id_usuario");
            echo json_encode(obtenerUsuario($id_usuario));
        }
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->get('/usuariosGuardia/{dia}/{hora}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
        {
            $dia=$request->getAttribute("dia");
            $hora=$request->getAttribute("hora");
            echo json_encode(usuariosGuardia($dia,$hora));
        }
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->get('/deGuardia/{dia}/{hora}/{id_usuario}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
        {
            $dia=$request->getAttribute("dia");
            $hora=$request->getAttribute("hora");
            $id_usuario=$request->getAttribute("id_usuario");
            echo json_encode(deGuardia($dia,$hora,$id_usuario));
        }
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));

});
// Una vez creado servicios los pongo a disposición
$app->run();
?>
