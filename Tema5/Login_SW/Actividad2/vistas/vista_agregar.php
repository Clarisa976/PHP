<div >
    <form class='centrado' action='index.php' method='POST'>
    <h2> Creando un producto </h2>
        <p>
            <label for='cod'>Código:</label>
            <input type='text' id='cod' name="cod" value="<?php if(isset($_POST["cod"])) echo $_POST["cod"]; ?>"/>
            <?php
                if(isset($_POST["btnContAgregar"]) && $error_cod){
                    if($_POST["cod"]==""){
                        echo "<span> Campo vacio</spam>";
                    }else{
                        echo "<span> Codigo repetido </spam>";
                    }
                }
            ?>
        </p>
        <p>
            <label for='nombre'>Nombre:</label>
            <input type='text' id='nombre' name='nombre' value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"]; ?>"/>
        </p>
        <p>
            <label for='nombre_corto'>Nombre corto:</label>
            <input type='text' id='nombre_corto' name='nombre_corto' value="<?php if(isset($_POST["nombre_corto"])) echo $_POST["nombre_corto"]; ?>"/>
            <?php
                if(isset($_POST["btnContAgregar"]) && $error_nombre_corto){
                    if($_POST["nombre_corto"]==""){
                        echo "<span> Campo vacio</spam>";
                    }else{
                        echo "<span> Codigo repetido </spam>";
                    }
                }
            ?>
        </p>
        <p>
            <label for='descripcion'>descripción:</label>
            <textarea id='descripcion' name='descripcion' value="<?php if(isset($_POST["descripcion"])) echo $_POST["descripcion"]; ?>"></textarea>
            <?php
                if(isset($_POST["descripcion"]) && $error_descripcion){
                    echo "<span> Campo Vacio </spam>";
                }
            ?>
        </p>
        <p>
            <label for='pvp'>PVP:</label>
            <input type='text' id='pvp' name='pvp' value="<?php if(isset($_POST["pvp"])) echo $_POST["pvp"]; ?>">
        </p>
        <p>
            <label for='familia'>Seleccione una familia:</label>
            <select id="familia" name="familia">
                <?php
                    foreach($json_familias["familia"] as $tupla){
                        echo "<option value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                    }
                ?>
            </select>
        </p>
        <button type='submit'>Volver</button>
        <button name='btnContAgregar' value='btnContAgregar' type='submit'>Continuar</button>
        </br>
        </br>
    </form>
</div>