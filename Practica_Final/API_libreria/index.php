<?php
require __DIR__ . '/Slim/autoload.php';
require "src/funciones_CTES_servicios.php";

$app = new \Slim\App();

// a) Servicio de login: POST /login  
$app->post('/login', function ($request) {

    $datos_login[] = $request->getParam("lector");
    $datos_login[] = $request->getParam("clave");


    echo json_encode(login($datos_login));
});


// b) Obtener datos del usuario logueado: GET /logueado  
$app->get('/logueado', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// c) Obtener todos los libros: GET /obtenerLibros  
$app->get('/obtenerLibros', function () {
    echo json_encode(obtener_libros()); 
});

// d) Crear un nuevo libro: POST /crearLibro  
$app->post('/crearLibro', function ($request,) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $referencia  = $request->getParam("referencia");
        $titulo      = $request->getParam("titulo");
        $autor       = $request->getParam("autor");
        $descripcion = $request->getParam("descripcion");
        $precio      = $request->getParam("precio");

        $resultado   = crear_libro($referencia, $titulo, $autor, $descripcion, $precio);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// e) Actualizar un libro: PUT /actualizarLibro/{referencia}  
$app->put('/actualizarLibro/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $referencia  = $args['referencia'];
        $titulo      = $request->getParam("titulo");
        $autor       = $request->getParam("autor");
        $descripcion = $request->getParam("descripcion");
        $precio      = $request->getParam("precio");

        $resultado   = actualizar_libro($referencia, $titulo, $autor, $descripcion, $precio);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// f) Borrar un libro: DELETE /borrarLibro/{referencia}  
$app->delete('/borrarLibro/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $referencia  = $args['referencia'];
        $resultado   = borrar_libro($referencia);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// g) Actualizar la portada de un libro: PUT /actualizarPortada/{referencia}  
$app->put('/actualizarPortada/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $referencia = $args['referencia'];
        $portada    = $request->getParam("portada");
        $resultado = actualizar_portada($referencia, $portada);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// h) Comprobar duplicado en inserción: GET /repetido/{tabla}/{columna}/{valor}  
$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $tabla    = $args['tabla'];
        $columna  = $args['columna'];
        $valor    = $args['valor'];
        $resultado =  repetido_insertando($tabla, $columna, $valor);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// i) Comprobar duplicado en edición: GET /repetido/{tabla}/{columna}/{valor}/{columna_key}/{valor_key}  
$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_key}/{valor_key}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $tabla       = $args['tabla'];
        $columna     = $args['columna'];
        $valor       = $args['valor'];
        $columna_key = $args['columna_key'];
        $valor_key   = $args['valor_key'];
        $resultado   = repetido_editando($tabla, $columna, $valor, $columna_key, $valor_key);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// j) Obtener todos los datos de un libro: GET /obtenerLibro/{referencia}  
$app->get('/obtenerLibro/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"])) {
        $referencia = $args['referencia'];
        $resultado  = obtener_libro($referencia);
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

$app->run();
