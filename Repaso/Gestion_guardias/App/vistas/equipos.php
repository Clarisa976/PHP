<?php
if(isset($_POST['btnEquipo'])){

    $datos_guardia["dia"]=$_POST["dia"];
    $datos_guardia["hora"]=$_POST["hora"];
    $datos_guardia["id_usuario"]=$datos_usuario_log["id_usuario"];
    $headers[]="Authorization: Bearer ".$_SESSION["token"];
    $url=DIR_SERV."/deGuardia/".$datos_guardia["dia"]."/".$datos_guardia["hora"]."/".$datos_usuario_log["id_usuario"];

    $respuesta=consumir_servicios_JWT_REST($url,"GET",$headers,$datos_guardia);
    $json_guardia=json_decode($respuesta,true);

    if(!$json_guardia){
        session_destroy();
        die(error_page("Guardias","<p>Error consumiendo el Servicio: ".$url."</p>"));
    }
    if(isset($json_guardia['error'])){
        session_destroy();
        die(error_page("Guardias","<p>Error: ".$json['error']."</p>"));
    }
    if(isset($json_guardia['no_auth'])){
        session_unset();
        $_SESSION['mensaje_seguridad']="No autorizado";
        header("Location:index.php");
        exit;
    }
    $guardia=$json_guardia['de_guardia'];

}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .enlinea {
            display: inline;
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        table{
            width: 80%;
            border-collapse: collapse;
            text-align: center;
        }
        table,
        td,
        th {
            border: 1px solid black
        }
        th{
            background-color: #ccc;
        }
        .izq{
            text-align: left;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <h1>Gestión de guardias</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log['usuario']; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class='enlace' name='btnSalir' type='submit'>Salir</button></form>
    </div>
    <div>
        <h2>Equipos de guardia del IES Mar de Alborán</h2>
        <?php 
        //tabla
        $dias[0]="";
        $dias[]="Lunes";
        $dias[]="Martes";
        $dias[]="Miércoles";
        $dias[]="Jueves";
        $dias[]="Viernes";

        $horas[1]="1ºHora";
        $horas[]="2ºHora";
        $horas[]="3ºHora";
        $horas[]="";
        $horas[]="4ºHora";
        $horas[]="5ºHora";
        $horas[]="6ºHora";

        echo "<table>";
        echo "<tr>";
        //recorremos la tabla
        for($i=0;$i<count($dias);$i++)
        {
            echo "<th>".$dias[$i]."</th>";
        }
        echo "</tr>";
        $contador=1;
        for ($hora=1; $hora < count($horas)+1; $hora++) { 
           echo "<tr>";
           if($hora==4){
            echo "<td colspan='6'>RECREO</td>";
           }else{
            for ($dia=0; $dia < count($dias); $dia++) { 
                if($dia==0){
                    echo "<th>".$horas[$hora]."</th>";
                }else{
                    echo "<td>";
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='dia' value='".$dia."'>";
                    echo "<input type='hidden' name='hora' value='".$hora."'>";
                    echo "<button name='btnEquipo' class='enlace' value='".$contador."'>Equipo".$contador."</button>";
                    echo "</form>";
                    echo "</td>";
                    $contador++;
                }
            }
           }
           echo "</tr>";
        }
        echo "</table>";

        ?>

        <?php
        if(isset($_POST['btnEquipo'])||isset($_POST['btnProfesor'])){
            if(isset($guardia)&&$guardia==false){

                echo "<h2>Equipo de Guardia ".$_POST['btnEquipo']." </h2>";
                echo "<p>¡¡ Atención, usted no se encuentra de guardia el ".$dias[$_POST['dia']]." a las ".$horas[$_POST['hora']]." !!</p>";
            }else{
                echo "<h2>Equipo de Guardia ".$_POST['btnEquipo']."</h2>";
                echo "<h3>".$dias[$_POST['dia']]." a ".$horas[$_POST['hora']]."</h3>";

                $datos_guardia['dia']=$_POST['dia'];
                $datos_guardia['hora']=$_POST['hora'];

                $headers[]="Authorization: Bearer ".$_SESSION['token'];

                $url_guardia = DIR_SERV . '/usuariosGuardia/' . $datos_guardia["dia"] . '/' . $datos_guardia["hora"];

                $respuesta=consumir_servicios_JWT_REST($url_guardia,'GET', $headers,$datos_guardia);
                $json_guardia_profe=json_decode($respuesta,true);

                if(!$json_guardia_profe){
                    session_destroy();
                    die(error_page("Guardias","<p>Error consumiendo el Servicio: ".$url_guardia."</p>"));
                }
                if(isset($json_guardia_profe['error'])){
                    session_destroy();
                    die(error_page("Guardias","<p>Error: ".$json_guardia_profe['error']."</p>"));
                }

                $profesores=$json_guardia_profe['usuarios'];

                echo "<table>";
                echo "<tr><th>Profesores de guardia</th><th>Información del profesor con id_usuario: ".$datos_usuario_log['id_usuario']."</th></tr>";
                for ($i=0; $i < count($profesores); $i++) { 
                    echo "<tr>";
                    echo "<td>";
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='dia' value='".$_POST['dia']."'/>";
                    echo "<input type='hidden' name='hora' value='".$_POST['hora']."'/>";
                    echo "<input type='hidden' name='btnEquipo' value='".$_POST['btnEquipo']."'/>"; 
                    echo "<input type='hidden' name='nombre' value='".$profesores[$i]['nombre']."'/>";
                    echo "<input type='hidden' name='id_usuario' value='".$datos_usuario_log['id_usuario']."'/>";
                    echo "<button class='enlace' name='btnProfesor' value='".$i."'>".$profesores[$i]['nombre']."</button>";
                    echo "</td>";
                    if (isset($_POST['btnProfesor']) && $_POST['btnProfesor']==$i) {
                        echo "<td rowspan='".count($profesores)."'>";
                        echo "<p class='izq'>";
                        echo "<strong> Nombre: </strong>".$profesores[$i]['nombre']."<br>";
                        echo "<strong> Usuario: </strong>".$profesores[$i]['usuario']."<br>";
                        echo "<strong> Contraseña: </strong><br>";
                        echo "<strong> Email: </strong>".$profesores[$i]['email']."<br>";
                        echo "</p>";
                        echo "</td>";
                    }
                    
                    echo "</tr>";

                }
                echo "</table>";
            }
        }
        ?>
    </div>
</body>

</html>