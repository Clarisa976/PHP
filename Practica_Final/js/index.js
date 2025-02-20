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
    var html_form = "";
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

    $('#form_agregar_libro').off('submit').on('submit', function (e) {
        e.preventDefault();
        console.clear();

        // Comprobación de tiempo de sesión (si es parte de tu lógica)
        if (((new Date() / 1000) - localStorage.ultm_accion) >= MINUTOS * 60) {
            localStorage.clear();
            cargar_vista_login("Su tiempo de sesión ha expirado");
            return;
        }

        var formElement = document.getElementById("form_agregar_libro");
        var formData = new FormData(formElement);
        var referencia = $("#ref_libro").val();
        // Aseguramos que la referencia esté presente en el FormData
        formData.append('referencia', referencia);

        console.log("Iniciando envío para referencia:", referencia);

        // Primero, se invoca el endpoint para verificar duplicados:
        $.ajax({
            url: DIR_API + "/repetido/libros/referencia/" + referencia,
            type: "GET",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("token")
            }
        })
        .done(function(dupData) {
            if (dupData.repetido) {
                // Si ya existe, se muestra un error y se detiene el proceso
                $('#mensajes_agregar').html("<span class='error'>La referencia ya existe.</span>");
                return;
            } else {
                // Si no existe duplicado, se continúa con el flujo normal:
                if ($('#portada_libro')[0].files.length > 0) {
                    // Si se seleccionó una imagen, primero se sube con /cargarPortada:
                    $.ajax({
                        url: DIR_API + "/cargarPortada",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem("token")
                        }
                    })
                    .done(function(data) {
                        console.log("Respuesta de /cargarPortada:", data);
                        if (data.error) {
                            $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                            return;
                        }
                        // Se actualiza el FormData reemplazando el campo de archivo por el nombre de la imagen devuelto
                        formData.delete('portada');
                        formData.append('portada', data.imagen);

                        // Se realiza la petición para insertar el libro en la BD
                        $.ajax({
                            url: DIR_API + "/crearLibro",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            headers: {
                                "Authorization": "Bearer " + localStorage.getItem("token")
                            }
                        })
                        .done(function(data2) {
                            console.log("Respuesta de /crearLibro:", data2);
                            if (data2.error) {
                                $('#mensajes_agregar').html("<span class='error'>" + data2.error + "</span>");
                            } else {
                                $('#mensajes_agregar').html("<span class='mensaje'>" + data2.mensaje + "</span>");
                                if (typeof cargar_libros_admin === "function") {
                                    cargar_libros_admin();
                                }
                                formElement.reset();
                            }
                        })
                        .fail(function(a, b) {
                            $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                        });
                    })
                    .fail(function(a, b) {
                        $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                    });
                } else {
                    // Si no se seleccionó imagen, se asigna la imagen por defecto
                    console.log("No se ha seleccionado imagen, se usará 'no_imagen.jpg'");
                    formData.set('portada', "no_imagen.jpg");
                    $.ajax({
                        url: DIR_API + "/crearLibro",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem("token")
                        }
                    })
                    .done(function(data) {
                        console.log("Respuesta de /crearLibro sin imagen:", data);
                        if (data.error) {
                            $('#mensajes_agregar').html("<span class='error'>" + data.error + "</span>");
                        } else {
                            $('#mensajes_agregar').html("<span class='mensaje'>" + data.mensaje + "</span>");
                            formElement.reset();
                        }
                    })
                    .fail(function(a, b) {
                        $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a, b) + "</span>");
                    });
                }
            }
        })
        .fail(function(a, b) {
            $('#mensajes_agregar').html("<span class='error'>Error al verificar duplicado: " + error_ajax_jquery(a, b) + "</span>");
        });
    });
}


//sin portada
/*function cargar_formulario_agregar() {
    var html_form = "";
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
    // Se omite el input para la portada, ya que se usará la imagen por defecto
    html_form += "<input type='submit' value='Agregar'>";
    html_form += "</form>";
    html_form += "<div id='mensajes_agregar'></div>";

    // Insertar el formulario en el contenedor correspondiente
    $('#respuestas').html(html_form);

    // Asignar el manejador de evento submit al formulario
    $('#form_agregar_libro').off('submit').on('submit', function (e) {
        e.preventDefault();
        console.clear();

        var formElement = document.getElementById("form_agregar_libro");
        var formData = new FormData(formElement);

        // Se asigna siempre la portada por defecto
        formData.set('portada', "no_imagen.jpg");

        // Realiza la petición para crear el libro
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
            console.log("Respuesta de /crearLibro:", data);
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
    });
}*/


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


function obtener_detalles(referencia) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        localStorage.setItem("ultm_accion", (new Date() / 1000));
        
        $.ajax({
            url: DIR_API + "/obtenerLibro/" + referencia,
            dataType: "json",
            type: "GET",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
        .done(function(data) {
            if (data.error) {
                $("#errores").html(data.error);
                $("#respuestas").html("");
                $("#productos").html("");
            } else if (data.mensaje) {
                let html_detalle = "<h2>Detalles del Libro " + referencia + "</h2>";
                html_detalle += "<p>" + data.mensaje + "</p>";
                $("#respuestas").html(html_detalle);
                cargar_libros_admin(); 
            } else if (data.no_auth) {
                localStorage.clear();
                cargar_vista_login("El tiempo de sesión de la API ha expirado.");
            } else if (data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("Usted ya no se encuentra registrado en la BD");
            } else {
                let libro = data.libro;
                let html_detalle = "<h2>Detalles del Libro " + libro["referencia"] + "</h2>";
                html_detalle += "<p>";
                html_detalle += "<strong>Título: </strong>" + (libro["titulo"] ? libro["titulo"] : "") + "<br>";
                html_detalle += "<strong>Autor: </strong>" + (libro["autor"] ? libro["autor"] : "") + "<br>";
                html_detalle += "<strong>Descripción: </strong>" + (libro["descripcion"] ? libro["descripcion"] : "") + "<br>";
                html_detalle += "<strong>Precio: </strong>" + (libro["precio"] ? libro["precio"] : "") + " €<br>";
                html_detalle += "<strong>Portada: </strong><br/><img src='images/" + (libro["portada"] ? libro["portada"] : "no_imagen.jpg") + "' alt='Portada'><br>";
                html_detalle += "</p>";
                html_detalle += "<p><button onclick='limpiarMensaje()'>Cerrar</button></p>";
                $("#respuestas").html(html_detalle);
            }
        })
        .fail(function(a, b) {
            $("#errores").html(error_ajax_jquery(a, b)); 
            $("#respuestas").html("");
            $("#productos").html("");
        });
    } else {
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}


function limpiarMensaje() {
    $("#mensaje").html("");
    $("#respuestas").html("");
    cargar_formulario_agregar();
}
