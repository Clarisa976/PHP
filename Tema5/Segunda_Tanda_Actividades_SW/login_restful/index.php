<?php


require __DIR__ . '/Slim/autoload.php';
require "src/funciones_CTES_servicios.php";


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

$app->get('/usuarios',function(){
    $test=validateToken();
    if(is_array($test))
        json_encode(obtener_usuarios());
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->get('/productos',function(){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
                echo json_encode(obtener_productos());
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});
  

$app->get('/producto/{codigo}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
            {
                $cod=$request->getAttribute("codigo");
                echo json_encode(obtener_producto($cod));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});



$app->post('/producto/insertar',function($request){

    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
            {
                $datos[]=$request->getParam("cod");
                $datos[]=$request->getParam("nombre");
                $datos[]=$request->getParam("nombre_corto");
                $datos[]=$request->getParam("descripcion");
                $datos[]=$request->getParam("PVP");
                $datos[]=$request->getParam("familia");

                echo json_encode(insertar_producto($datos));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));



    
});

$app->put('/producto/actualizar/{codigo}',function($request){

    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
            {
                $datos[]=$request->getParam("nombre");
                $datos[]=$request->getParam("nombre_corto");
                $datos[]=$request->getParam("descripcion");
                $datos[]=$request->getParam("PVP");
                $datos[]=$request->getParam("familia");
                $datos[]=$request->getAttribute("codigo");

                echo json_encode(actualizar_producto($datos));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));

    
    
});


$app->delete('/producto/borrar/{codigo}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
            {
                $cod=$request->getAttribute("codigo");
                echo json_encode(borrar_producto($cod));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));



    
});


$app->run();
?>