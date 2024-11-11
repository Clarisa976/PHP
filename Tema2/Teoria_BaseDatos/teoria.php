<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria de Base de datos</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <h1>Teoria BD</h1>
    <?php
    //las funciones para la BD empiezan por mysqli
    //lo primero que hay que hacer es una conexión a la bd
    //donde está alojada -> localhost
    //nombre de usuario -> jose
    //contraseña -> josefa
    //la base de datos a la que vamos a hacerle las consultas
    //por si cambia la bd por x motivos es mejor usar constantes
    const SERVIDOR_BD = 'localhost';
    const USUARIO_BD = 'jose';
    const CLAVE_BD = 'josefa';
    const NOMBRE_BD = 'bd_teoria';

    try {
        @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        //hay que indicar que los datos sean utf8
        mysqli_set_charset($conexion, 'utf8');
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p></body></html>");
        //hay que cerrar las etiquetas aqui porque si da el die
        //no se cierra correctamente
    }

    echo "<h2>Conexión bien</h2>";

    //en una bd haremos siempre tres cosas:
    //conectarse, consultar y cerrar

    try {
        $consulta = "select * from t_alumnos";
        //la función que hace la consulta es   
        $resultado = mysqli_query($conexion, $consulta);
        //esto nos devolverá un recurso

    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die("<p>No se ha podido la consula: " . $e->getMessage() . "</p></body></html>");
    }

    //la función para saber el número de tuplas es:
    $numero_tuplas = mysqli_num_rows($resultado);
    echo "<h2>Consulta bien</h2>";
    echo "<p>El número de alumnos en la tabla alumnos es de: " . $numero_tuplas . "</p>";

    //la función que nos dará las tuplas cuando se lo pasamos es:
    //mysqli_fetch
    //al usarlo iremos avanzando tupla tupla desde la 0 a la N
    //para volver a un punto de la tupla usaremos: mysqli_data_seek()
    echo "<h3>Mostrando el contenido de las tuplas: </h3>";
    $tupla = mysqli_fetch_assoc($resultado); //esto nos dará la primera tupla que se obtine en resultados
    //lo que se guarda es un array asociativo
    echo "<p>El nombre del primer alumno obtenido es: " . $tupla["nombre"] . "</p>";
    //si repetimos el procedimiento la siguiente sería la siguiente tupla

    //fetch_row hace que se guarde en un array escalar
    $tupla = mysqli_fetch_row($resultado);
    echo "<p>El teléfono del segundo alumno obtenido es: " . $tupla[2] . "</p>";


    //fetch_object 
    //hay que usar -> ya que es un objeto e indicar a lo que estamos llamando en este caso ->cp
    $tupla = mysqli_fetch_object($resultado);
    echo "<p>El código postal del tercer alumno obtenido es: " . $tupla->cp . "</p>";


    //para movernos al un punto de las tuplas usamos:
    mysqli_data_seek($resultado, 1);

    //fetch_array
    //obtiene los datos dobles, te los guarda tanto en 
    //un array asociativo como uno escalar
    $tupla = mysqli_fetch_array($resultado);
    echo "<p>El nombre del segundo alumno obtenido es " . $tupla[1] . " y su teléfono es " . $tupla["telefono"] . "</p>";


    /*Esto entrará en los exámenes si o si:*/
    mysqli_data_seek($resultado, 0);
    echo "<h4>Información de todos los alumnos</h4>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Código</th><th>Nombre</th><th>Teléfono</th><th>Código Postal</th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["cod_alu"] . "</td>";
        echo "<td>" . $tupla["nombre"] . "</td>";
        echo "<td>" . $tupla["telefono"] . "</td>";
        echo "<td>" . $tupla["cp"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    //cuando terminemos la consulta y ya no vayamos a usarlo más
    //tenemos que liberarlo usando
    mysqli_free_result($resultado);



    try {
        
        //la función que hace la consulta es   
        $resultado = mysqli_query($conexion, $consulta);
        //esto nos devolverá un recurso

    } catch (Exception $e) {
        mysqli_close($conexion); //lo cerramos si no hace la consulta
        die("<p>No se ha podido la consula: " . $e->getMessage() . "</p></body></html>");
    }

    mysqli_data_seek($resultado, 0);
    echo "<h4>Notas de asignatura</h4>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Nombre</th><th>Notas</th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
            echo "<td>" . $tupla["nombre"] . "</td>";
            echo "<td>" . $tupla["nota"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($resultado);


    //lo último que hay que hacer con una conexión es cerrarla
    mysqli_close($conexion);
    echo "<h2>Cierre de conexión</h2>";
    ?>
</body>

</html>