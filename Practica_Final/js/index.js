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
                    tabla_libros_admin += "<td><button class='enlace' onclick='obtener_detalles(\"" + tupla['referencia'] + "\")'>" + tupla['titulo'] + "</td>";
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
