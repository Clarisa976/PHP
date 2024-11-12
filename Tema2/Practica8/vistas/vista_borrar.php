<?php
    if(mysqli_num_rows($resultado)>0){
        $detalle_tupla = mysqli_fetch_assoc($resultado);
        echo "<p>¿Estás seguro que quires borrar al usuario <strong>".$detalle_tupla["nombre"]."</strong>?</p>";
        echo "<form action='index.php' method='post'>";
        echo "<input type='hidden' name='nombre_foto_bd' value='".$detalle_tupla["$id_usuario"]."'>";
            echo "<button type='submit' value='".$_POST["btnBorrar"]."' name='btnContBorrar'>Continuar</button>";
            echo "<button type='submit'>Volver</button>";
        echo "</form>";
    }else{
        echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
    }
    mysqli_free_result($resultado);
?>