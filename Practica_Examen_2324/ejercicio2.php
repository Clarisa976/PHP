<?php
const VOCALES = ['a', 'i', 'u', 'e', 'o', 'A', 'I', 'U', 'E', 'O'];

function es_Vocal($texto)
{
    $es_letra = false;
    foreach (VOCALES as $vocal) {
        if ($texto == $vocal) {
            $es_letra = true;
            break;
        }
    }
    return $es_letra;
}
function mi_explode($separador, $texto)
{
    $array = []; //array al que le añadiremos las palabras
    $i = 0; //contador
    $longitud = strlen($texto);

    while ($i < $longitud && $texto[$i] == $separador) {
        $i++;
    }
    if ($i < $longitud) {
        $j = 0;
        $aux[$j] = $texto[$i];
        $contiene_vocal = es_Vocal($texto[$i]); //verificamos si la letra es vocal
        for ($i = $i + 1; $i < $longitud; $i++) {
            if ($texto[$i] != $separador) {
                $aux[$j] .= $texto[$i];
                //verificamos si se una vocal
                if (es_Vocal($texto[$i])) {
                    $contiene_vocal = true;
                }
            } else {
                if ($contiene_vocal) {
                    unset($aux[$j]); //si contiene vocales no la guardamos
                }
                while ($i < $longitud && $texto[$i] == $separador) {
                    $i++;
                    if ($i < $longitud) {
                        $j++;
                        $aux[$j] = $texto[$i];
                        $contiene_vocal = es_Vocal($texto[$i]);//reiniciamos la verificación
                    }
                }
            }
        }
        //verificamos la última palabra
        if ($contiene_vocal) {
            unset($aux[$j]); //si es una vocal se elimina
        }
    }
    return $aux;
}
if (isset($_POST["btnContar"])) {
    $error_formulario = $_POST["texto"] == "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 2. Contar Palabras sin las vocales (a,e,i,o,u,A,E,I,O,U)</h1>
    <form action="ejercicio2.php" method="post">
        <p>
            <label for="texto">Introduzca un Texto</label>
            <input type="text" name="texto" id="texto"
                value="<?php if (isset($_POST['texto']))
                            echo $_POST['texto']; ?>">
        </p>
        <p>
            <label for="separador">Elija el Separador</label>
            <select name="separador" id="separador">
                <option value=";" <?php if (isset($_POST['separador']) && $_POST['separador'] == ';')
                                        echo 'selected'; ?>>
                    Punto y Coma</option>
                <option value="," <?php if (isset($_POST['separador']) && $_POST['separador'] == ',')
                                        echo 'selected'; ?>>
                    Coma</option>
                <option value=" " <?php if (isset($_POST['separador']) && $_POST['separador'] == ' ')
                                        echo 'selected'; ?>>
                    Espacio</option>
                <option value=":" <?php if (isset($_POST['separador']) && $_POST['separador'] == ':')
                                        echo 'selected'; ?>>
                    Dos puntos</option>
            </select>
        </p>
        <p>
            <button type="submit" name="btnContar">Contar</button>
        </p>
        <?php
        if (isset($_POST['btnContar']) && $error_formulario) {
            echo "<p class='error'>Campo vacío</p>";
        }
        ?>

    </form>
    <?php
    if (isset($_POST['btnContar']) && !$error_formulario) {

        echo "<h2>Respuesta</h2>";
        $numPalabras = mi_explode($_POST["separador"], $_POST["texto"]);
        echo "<p>El texto \"" . $_POST['texto'] . "\" con el separador '" . $_POST["separador"] . "' contiene " . count($numPalabras) . " sin las vocales.</p>";
    }
    ?>
</body>

</html>