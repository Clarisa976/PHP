function cargar_libros_normal() {
    $.ajax({
        url: DIR_API + "/obtenerLibros",
        type: "GET",
        dataType: "json"
    })
        .done(function (data) {
            if (data.error) {
                $('#errores').html(data.error);
                $('#principal').html("");
                localStorage.clear();
            }
            else {
                let html_libros = "";
                $.each(data.libros, function (key, tupla) {
                    html_libros += "<div>";
                    html_libros += "<img src='images/" + tupla["portada"] + "' alt='Portada' title='Portada'><br>";
                    html_libros += tupla["titulo"] + " - " + tupla["precio"] + "€<br>";
                    html_libros += "</div>";
                });
                html_libros += "</div>";
                $('.contenedor_libros').html(html_libros);
            }
        })
        .fail(function (a, b) {
            $('#errores').html(error_ajax_jquery(a, b));
            $('#principal').html("");
        });
}
function cargar_libros_admin() {
    $.ajax({
        url: DIR_API + "/obtenerLibros",
        type: "GET",
        dataType: "json",
        headers: {
            "Authorization": "Bearer " + localStorage.getItem("token")
        }
    })
        .done(function (data) {
            if (data.error) {
                $('#errores').html(data.error);
                $('#principal').html("");
                localStorage.clear();
            } else {
                let tabla_libros_admin = "<table>";
                tabla_libros_admin += "<tr>";
                tabla_libros_admin += "<th>Ref</th>";
                tabla_libros_admin += "<th>Título</th>";
                tabla_libros_admin += "<th>Acción</th>";
                tabla_libros_admin += "</tr>";

                $.each(data.libros, function (key, tupla) {
                    tabla_libros_admin += "<tr>";
                    tabla_libros_admin += "<td>"+ tupla['referencia'] + "</td>";
                    tabla_libros_admin += "<td><button class='enlace' onclick='obtener_detalles(\"" + tupla['referencia'] + "\")'>" + tupla['titulo'] + "</button></td>";
                    tabla_libros_admin += "<td><button class='enlace' onclick='montar_vista_borrar(\"" + tupla['referencia'] + "\")'>Borrar</button> ";
                    tabla_libros_admin += " - <button class='enlace' onclick='montar_vista_editar(\"" + tupla['referencia'] + "\")'>Editar</button> </td>";
                    tabla_libros_admin += "</tr>";
                });

                tabla_libros_admin += "</table>";
                $('#libros').html(tabla_libros_admin);
            }
        })
        .fail(function (a, b) {
            $('#errores').html(error_ajax_jquery(a, b));
            $('#principal').html("");
        });
}

function cargar_formulario_agregar() {    
    let html_form = "";

    html_form += "<h3>Agregar un nuevo libro</h3>";
    html_form += "<form id='form_agregar_libro' enctype='multipart/form-data'>";

    html_form += "<label for='ref_libro'>Referencia: </label><br>";
    html_form += "<input type='text' id='ref_libro' name='referencia' required><br><br>";

    html_form += "<label for='titulo_libro'>Título: </label><br>";
    html_form += "<input type='text' id='titulo_libro' name='titulo' required><br><br>";

    html_form += "<label for='autor_libro'>Autor: </label><br>";
    html_form += "<input type='text' id='autor_libro' name='autor' required><br><br>";

    html_form += "<label for='desc_libro'>Descripción: </label><br>";
    html_form += "<textarea id='desc_libro' name='descripcion' rows='3' cols='30'></textarea><br><br>";

    html_form += "<label for='precio_libro'>Precio: </label><br>";
    html_form += "<input type='number' step='0.01' id='precio_libro' name='precio' required><br><br>";

    html_form += "<label for='portada_libro'>Portada (opcional): </label><br>";
    html_form += "<input type='file' id='portada_libro' name='portada' accept='image/*'><br><br>";

    html_form += "<input type='submit' value='Agregar'>";
    html_form += "</form>";
    html_form += "<div id='mensajes_agregar'></div>";

    $('#respuestas').html(html_form);

    $('#form_agregar_libro').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(document.getElementById("form_agregar_libro"));


        $.ajax({
            url: DIR_API + "/crearLibro",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("token")  
            },
            dataType: "json"
        })
        .done(function(data) {
            if (data.error) {
                $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
            } else {
                $('#mensajes_agregar').html("<span class='mensaje'>" + data.mensaje + "</span>");
                cargar_libros_admin();
            }
        })
        .fail(function(a, b) {
            $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a,b) + "</span>");
        });
    });
}
