<?php
if (isset($_POST["btnEnviar"])) {

    function mi_strlen($texto)
    {
        $contador = 0;
        while (isset($texto[$contador])) {
            $contador++;
        }
        return $contador;
    }

    function mi_explode($separador, $texto)
    {
        //creamos un array para almacenar el texto
        $array_aux = [];
        $tamanio = mi_strlen($texto);
        $aux = ""; //para almacenar el texto antes de añadirlo al array
        //recorremos el texto
        for ($i = 0; $i < $tamanio; $i++) {
            if ($texto[$i] == $separador) {
                $array_aux[] = $aux; //lo agregamos al array
                $aux = ""; //borramos lo que haya
            } else {
                $aux .= $texto[$i];
            }
        }
        $array_aux[] = $aux; //añadimos el texto que pueda haber tras el último separador
        return $array_aux;
    }
    function mi_explode_miguel_angel($separador, $texto)
    {
        $aux = [];
        $i = 0;
        $longitud = mi_strlen($texto);
        while ($i < $longitud && $texto[$i] == $separador) {
            $i++;
        }
        if ($i < $longitud) {
            $j = 0;
            $aux[$j] = $texto[$i];
            for ($i = $i + 1; $i < $longitud; $i++) {
                if ($texto[$i] != $separador) {
                    $aux[$j] .= $texto[$i];
                } else {
                    while ($i < $longitud && $texto[$i] == $separador) {
                        $i++;
                        if ($i < $longitud) {
                            $j++;
                            $aux[$j] = $texto[$i];
                        }
                    }
                }
            }
        }
        return $aux;
    }
}


//control de errores
if (isset($_POST["btnEnviar"])) {
    $error_formulario = $_POST["texto"] == ""; 
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio3.php" method="post">
        <p>
            <label for="texto">Introduce un texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_formulario) {
                echo "<span class='error'>Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <label for="separador">Seleccione un separador: </label>
            <select name="separador" id="separador">
                <option value="," <?php if (isset($_POST["btnEnviar"]) && $_POST["separador"] == ",") echo "selected" ?>> ',' coma </option>
                <option value=";" <?php if (isset($_POST["btnEnviar"]) && $_POST["separador"] == ";") echo "selected" ?>> ';' punto y coma </option>
                <option value=":" <?php if (isset($_POST["btnEnviar"]) && $_POST["separador"] == ":") echo "selected" ?>> ':' dos puntos </option>
                <option value=" " <?php if (isset($_POST["btnEnviar"]) && $_POST["separador"] == " ") echo "selected" ?>> ' ' espacio</option>
            </select>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Contar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnEnviar"]) && !$error_formulario) {
        echo "<p> Has introducido un total de  " . count(mi_explode($_POST["separador"], $_POST["texto"])) . " caracteres</p>";
        echo "<p> Has introducido un total de  " . count(mi_explode_miguel_angel($_POST["separador"], $_POST["texto"])) . " caracteres</p>";
        print_r(mi_explode($_POST["separador"],$_POST["texto"]));
    }
    ?>
</body>

</html>