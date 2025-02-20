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
                let tabla_libros_admin = "<table class='centrado txt_centrado'>";
                tabla_libros_admin += "<tr>";
                tabla_libros_admin += "<th>Ref</th>";
                tabla_libros_admin += "<th>Título</th>";
                tabla_libros_admin += "<th>Acción</th>";
                tabla_libros_admin += "</tr>";

                $.each(data.libros, function (key, tupla) {
                    tabla_libros_admin += "<tr>";
                    tabla_libros_admin += "<td>"+ tupla['referencia'] + "</td>";
                    tabla_libros_admin += "<td><button class='enlace' onclick='obtener_detalles(\"" + tupla['referencia'] + "\")'>" + tupla['titulo'] + "</button></td>";
                    tabla_libros_admin += "<td><button class='enlace' onclick='cargar_confirmar_borrado(\"" + tupla['referencia'] + "\")'>Borrar</button> ";
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

/*function cargar_formulario_agregar() {
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

    $('#form_agregar_libro').on('submit', function (e) {
        e.preventDefault();

        // Se crea un objeto FormData con todos los campos del formulario
        let formData = new FormData(document.getElementById("form_agregar_libro"));
        let referencia = $("#ref_libro").val();

        // Si se ha seleccionado una imagen se envía primero al endpoint de subida
        if ($('#portada_libro').val()) {
            $.ajax({
                url: DIR_API + "/upload_image",  // Asegúrate de que esta ruta sea la correcta
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json"
            })
                .done(function (data) {
                    if (data.error) {
                        $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                    } else {
                        // Se añade el nombre de la imagen al formData (para enviarlo en la siguiente petición)
                        formData.set('portada', data.imagen);

                        // Se realiza la petición para crear el libro
                        $.ajax({
                            url: DIR_API + "/crearLibro", // Asegúrate de que esta ruta sea la correcta
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                "Authorization": "Bearer " + localStorage.getItem("token")
                            },
                            dataType: "json"
                        })
                            .done(function (data2) {
                                if (data2.error) {
                                    $('#mensajes_agregar').html("<span class='error'>" + data2.error + "</span>");
                                } else {
                                    $('#mensajes_agregar').html("<span class='mensaje'>" + data2.mensaje + "</span>");
                                    cargar_libros_admin();
                                }
                            })
                            .fail(function (a, b) {
                                $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                            });
                    }
                })
                .fail(function (a, b) {
                    $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                });
        } else {
            // Si no se seleccionó imagen, se añade el valor por defecto y se crea el libro
            formData.set('portada', "no_imagen.jpg");

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
                .done(function (data) {
                    if (data.error) {
                        $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                    } else {
                        $('#mensajes_agregar').html("<span class='mensaje'>" + data.mensaje + "</span>");
                        cargar_libros_admin();
                    }
                })
                .fail(function (a, b) {
                    $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                });
        }
    });
}*/

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

    // Evita duplicar event handlers
    $('#form_agregar_libro').off('submit').on('submit', function (e) {
        e.preventDefault();
        console.clear();

        let formElement = document.getElementById("form_agregar_libro");
        let formData = new FormData(formElement);
        let referencia = $("#ref_libro").val();
        console.log("Iniciando envío para referencia:", referencia);

        // Muestra el contenido del FormData antes de enviar
        console.log("FormData inicial:");
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        // Si se ha seleccionado un archivo, se envía a cargarPortada
        if ($('#portada_libro')[0].files.length > 0) {
            console.log("Archivo seleccionado, enviando a /cargarPortada...");
            $.ajax({
                url: DIR_API + "/cargarPortada",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json"
            })
                .done(function (data) {
                    console.log("Respuesta de /cargarPortada:", data);
                    if (data.error) {
                        $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                        return;
                    }
                    // Se elimina el campo 'portada' (archivo) y se reemplaza por el nombre de imagen
                    formData.delete('portada');
                    formData.append('portada', data.imagen);

                    console.log("FormData después de actualizar 'portada':");
                    for (let [key, value] of formData.entries()) {
                        console.log(key, value);
                    }

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
                        .done(function (data2) {
                            console.log("Respuesta de /crearLibro:", data2);
                            if (data2.error) {
                                $('#mensajes_agregar').html("<span class='error'>" + data2.error + "</span>");
                            } else {
                                $('#mensajes_agregar').html("<span class='mensaje'>" + data2.mensaje + "</span>");
                                cargar_libros_admin();
                                formElement.reset();
                            }
                        })
                        .fail(function (a, b) {
                            $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                        });
                })
                .fail(function (a, b) {
                    $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                });
        } else {
            console.log("No se ha seleccionado imagen, se usará 'no_imagen.jpg'");
            formData.set('portada', "no_imagen.jpg");
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
                .done(function (data) {
                    console.log("Respuesta de /crearLibro sin imagen:", data);
                    if (data.error) {
                        $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                    } else {
                        $('#mensajes_agregar').html("<span class='mensaje'>" + data.mensaje + "</span>");
                        cargar_libros_admin();
                        formElement.reset();
                    }
                })
                .fail(function (a, b) {
                    $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                });
        }
    });
}

function cargar_borrado(referencia) {
    limpiarMensaje();

    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        localStorage.setItem("ultm_accion", (new Date() / 1000));
        $.ajax({
            url: DIR_API + "/borrarLibro/" + referencia,
            dataType: "json",
            type: "DELETE",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
            .done(function (data) {
                if (data.error) {
                    $("#errores").html(data.error);
                    $("#principal").html("");
                } else if (data.no_auth) {
                    localStorage.clear();
                    cargar_vista_login("El tiempo de sesión de la API ha expirado.");
                } else if (data.mensaje_baneo) {
                    localStorage.clear();
                    cargar_vista_login("Usted ya no se encuentra registrado en la BD");
                } else {
                    $("#mensaje").html("<p class='txt_centrado mensaje'>¡¡ Libro borrado con éxito !!</p>");
                    cargar_libros_admin();
                }
            })
            .fail(function (a, b) {
                $("#errores").html(error_ajax_jquery(a, b));
                $("#principal").html("");
            });
    } else {
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}


function cargar_confirmar_borrado(referencia) {
    let html = "<p>¿Estás seguro de que deseas borrar el libro con referencia <strong>" + referencia + "</strong>?</p>";
    html += "<button onclick='cargar_borrado(\"" + referencia + "\")'>Sí</button> ";
    html += "<button onclick='limpiarMensaje()'>No</button>";
    $("#mensaje").html(html);

}




function limpiarMensaje() {
    $("#mensaje").html("");
}