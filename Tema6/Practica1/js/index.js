const DIR_API1 = "http://localhost/Proyectos/PHP/Tema5/Teoria_SW/API";
const DIR_API2 = "http://localhost/Proyectos/PHP/Tema5/Ejercicios_SW/Actividad1_2_MA/Actividad1/servicios_rest";

$(function () {
    obtener_productos();
});

function obtener_productos() {
    $.ajax({
        url: DIR_API2 + "/productos",
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.error) {
                $('#detalles').html(data.error);
            } else {
                let html_tabla_productos = "<table>";
                html_tabla_productos += "<tr><th>Código</th><th>Nombre</th><th>PVP</th></tr>";

                $.each(data.productos, function (key, tupla) {
                    html_tabla_productos += "<td><button onclick='obtener_producto(\"" + tupla['cod'] + "\")'>" + tupla['cod'] + "</button></td>";
                    html_tabla_productos += "<td>" + tupla["nombre_corto"] + "</td>";
                    html_tabla_productos += "<td>" + tupla["PVP"] + "</td>";
                    html_tabla_productos += "<td><button onclick='montar_vista_borrar(\""+tupla['cod']+"\")>Borrar</button> - <button onclick='montar_vista_editar(\""+tupla['cod']+"\")>Editar</button></td>";
                    html_tabla_productos += "</tr>";
                });
                html_tabla_productos += "</table>";
                $('#detalles').html(html_tabla_productos);
            }
        })
        .fail(function (a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
        });
}


function obtener_producto(codigo) {
    $.ajax({
        url: DIR_API2 + "/producto/" + codigo,
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.error) {
                $('#respuesta').html("<p class='error'>" + data.error + "</p>");
            } else {
                let detalles = "<h3>Detalles del producto</h3>";
                detalles += "<p><strong>Código:</strong> "+data.producto['cod']+"</p>";
                if(data.producto['nombre']!==null){
                    detalles += "<p><strong>Nombre:</strong> "+data.producto['nombre']+"</p>";
                }else{
                    detalles += "<p><strong>Nombre:</strong>  </p>";
                }

                detalles += "<p><strong>Nombre corto:</strong> "+data.producto['nombre_corto']+"</p>";
                detalles += "<p><strong>Descripción:</strong> "+data.producto['descripcion']+"</p>";
                detalles +="<p><strong>PVP:</strong> "+data.producto['PVP']+" €</p>";
                detalles +="<p><strong>Familia:</strong> "+data.producto['nombre_familia']+"</p>";
                detalles +="<p><button onclick='borrar_respuestas()' >Volver</button</p>";
                $('#respuesta').html(detalles);
            }
            
        })
        .fail(function (a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
            $('#detalles').html("");
            $('#errores').html("");
        });
}
function borrar_respuestas() {
    $('#detalles').html("");
    
}
function montar_vista_borrar(cod) {
    let html_vista_borrar="<p>Se dispone usted a borrar el producto: <strong>"+cod+"</strong></p>";
    html_vista_borrar+="<p>¿Está seguro de que desea borrarlo?</p>";

}

function error_ajax_jquery(jqXHR, textStatus) {
    var respuesta;
    if (jqXHR.status === 0) {
        respuesta = 'Not connect: Verify Network.';
    }
    else if (jqXHR.status == 404) {
        respuesta = 'Requested page not found [404]';
    }
    else if (jqXHR.status === 500) {
        respuesta = 'Requested page not found [500]';
    } else if (textStatus === 'parsererror') {

        respuesta = 'Requested JSON parse failed.';

    } else if (textStatus === 'timeout') {

        respuesta = 'Time out error.';

    } else if (textStatus === 'abort') {

        respuesta = 'Ajax request aborted.';

    } else {

        respuesta = 'Uncaught Error: ' + jqXHR.responseText;

    }
    return respuesta;
}
