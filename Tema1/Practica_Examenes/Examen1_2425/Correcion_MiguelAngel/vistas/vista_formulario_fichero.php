<h1>Ejercicio 4</h1>
<form action="ejercicio4.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fichero">Seleccione un fichero de texto plano para agregar al fichero aulas.txt (Máx. 500KB)</label>
            <input type="file" name="archivo" accept=".txt"/>
            <?php
            if(isset($_POST["btnSubir"]) && $error_form)
            {
                if($_FILES["archivo"]["name"]=="")
                    echo "<span class='error'> No has seleccionado un archivo </span>";
                elseif($_FILES["archivo"]["error"] )
                    echo "<span class='error'> Error en la subida del fichero al servidor </span>";
                elseif($_FILES["archivo"]["type"]!="text/plain")
                    echo "<span class='error'> No has seleccionado un archivo de texto plano </span>"; 
                else
                    echo "<span class='error'> El archivo seleccionado es mayor de 500KB </span>"; 
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnSubir">subir</button>
        </p>
</form>