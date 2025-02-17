<?php
if (isset($_POST["btnEditar"]))
    $codigo = $_POST["btnEditar"];
else
    $codigo = $_POST["btnContEditar"];

$url = DIR_SERV . "/producto/" . $codigo;

$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta,true);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</select></p></body></html>");
}

$detalles = $obj['producto'];
?>
<h2>Editando el producto con id <?php echo $codigo ?></h2>
<form action="index.php" method="post">
<p>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" maxlength="200" value="<?php echo isset($detalles['nombre']) ? $detalles['nombre'] : ''; ?>">
    </p>

    <p>
        <label for="nombre_corto">Nombre corto: </label>
        <input type="text" name="nombre_corto" id="nombre_corto" maxlength="50" value="<?php echo isset($detalles['nombre_corto']) ? $detalles['nombre_corto'] : ''; ?>">
        <?php
        if (isset($_POST["nombre_corto"]) && $error_nombre_corto)
            echo "<span class='error'> Campo vacío</span>";
        ?>
    </p>

    <p>
        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion"><?php echo isset($detalles['descripcion']) ? $detalles['descripcion'] : ''; ?></textarea>
    </p>

    <p>
        <label for="pvp">PVP: </label>
        <input type="text" name="pvp" id="pvp" maxlength="11" value="<?php echo isset($detalles['PVP']) ? $detalles['PVP'] : ''; ?>">
        <?php
        if (isset($_POST["pvp"]) && $error_pvp) {
            if ($_POST["pvp"] == "")
                echo "<span class='error'> Campo vacío</span>";
            else if (!is_numeric($_POST["pvp"]))
                echo "<span class='error'> No es un número</span>";
            else
                echo "<span class='error'> Tiene que ser un valor positivo</span>";
        }
        ?>
    </p>

    <p>
        <label for="familia">Seleccione una familia: </label>
        <select name="familia" id="familia">
            <?php
            // Obtenemos las familias
            $url = DIR_SERV . "/familias";
            $respuesta = consumir_servicios_REST($url, "GET");
            $obj = json_decode($respuesta, true);

            if (!$obj) {
                session_destroy();
                die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
            }

            if (isset($obj['error'])) {
                session_destroy();
                die("<p>" . $obj['error'] . "</select></p></body></html>");
            }

            foreach ($obj['familias'] as $tupla) {
                $selected = ($tupla['cod'] == $detalles['familia']) ? 'selected' : '';
                echo "<option value='" . $tupla['cod'] . "' $selected>" . $tupla['nombre'] . "</option>";
            }
            ?>
        </select>
        </select>
    </p>
    <p>
        <button type="submit" name="btnVolver">Volver</button>
        <button type="submit" name="btnContEditar" value="<?php echo $codigo; ?>">Continuar</button>
    </p>
</form>