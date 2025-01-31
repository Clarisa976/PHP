<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_CTES.php";

$app= new \Slim\App;

$app->get('/logueado',function(){

    $test=validateToken();
    if(is_array($test))
    {
        echo json_encode($test);
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  
});


$app->post('/login',function($request){
    
    $datos_login[]=$request->getParam("lector");
    $datos_login[]=$request->getParam("clave");


    echo json_encode(login($datos_login));
});
//obtener todos los libros de la bd
$app->get('/obtenerLibros', function () {
    $test = validateToken();
    if (is_array($test)) {
        if(isset($test['usuario'])){
            echo json_encode($test);
        }else{
            echo json_encode(obtenerLibros());
        }        
    }else{
        echo json_encode(array("no_auth" => "No tienes permiso para usar este servicio"));  
    }
});

//crear un libro

//actualizar un libro con la referencia

//borrar un libro con la referencia

//actualizar la portada con la referencia

//repetido insertando un libro

//repetido actualizando

//obtener un libro por referencia
$app->run();

?>