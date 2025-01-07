<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function(){

    $respuesta["mensaje"]="Hola que tal?";
    echo json_encode($respuesta);
});

$app->get('/saludo/{nombre}',function($request){
    $nombre=$request->getAttribute("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});

$app->post('/saludo',function($request){
    //por debajo
    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});
//añadir un método put y otro delete.
//delete('/borrar_saludo/{id}) y que aparezca 'se ha borrado el saludo num X
$app->delete('/borrar_saludo/{id}',function($request){
    $id=$request->getAttribute("id");
    $respuesta["mensaje"]="Se ha borrado el saludo con id ".$id;
    echo json_encode($respuesta);
});
//put('/cambiar_saludo/{id}'....)y por debajo un nombre el mensaje sería: Se le ha actualizado el saludo con id X al nombre X
$app->put('/cambiar_saludo/{id}',function($request){
    $id=$request->getAttribute("id");
    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Se le ha actualizado el saludo con id ".$id." al nombre ".$nombre;
    echo json_encode($respuesta);
});

$app->run();

?>