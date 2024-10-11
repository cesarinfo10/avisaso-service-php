function consultarIDequipo() {
    rut= $("#usuarioRut").val();

    fetch('servicios/usuarios.php?rut='+ rut +'&consultaUserNot')
    .then(response => response.json())
    .then(response => $("#include_player_ids").val(response[0]))
}
function guardarNotificacion(){
    var url = "servicios/noti.php?noti";
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: { 
            usuarioRut: $("#usuarioRut").val(),
            include_player_ids: $("#include_player_ids").val(),
            titulo: $("#titulo").val(),
            mensaje: $("#mensaje").val()
        },
        async: false,
        success: function(data) {
           //
        }
    });
}
function guardarNotificacionGral(){
    var url = "servicios/noti.php?notiGral";
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: { 
            tituloGral: $("#tituloGral").val(),
            mensajeGral: $("#mensajeGral").val()
        },
        async: false,
        success: function(data) {
           //
        }
    });
}

/**/