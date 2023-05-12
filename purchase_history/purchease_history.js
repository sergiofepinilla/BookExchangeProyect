
document.addEventListener("DOMContentLoaded", function () {
$(document).ready(function() {
    $('#rating').barrating({
        theme: 'fontawesome-stars',
        onSelect: function(value, text, event) {
            // Aquí puedes definir lo que sucederá cuando el usuario seleccione una calificación.
            // Por ejemplo, puedes enviar la calificación a un servidor o mostrar un mensaje.
            console.log("Valoración seleccionada: " + value);
        }
    });
});


$(function() {
  // Al cargar la página, comprueba si hay un tab guardado en la localStorage
  let activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    // Si hay un tab guardado, actívalo
    $('.nav-link[href="' + activeTab + '"]').tab('show');
  }

  // Cuando cambies de tab, guarda el nuevo tab en la localStorage
  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
});

$(document).ready(function() {
    // Inicializa la calificación de estrellas
    $('#rating').barrating({
        theme: 'fontawesome-stars'
    });

    // Abre el modal de valoración cuando se hace clic en el botón de valorar
    $('.valorar').click(function() {
        var idLibro = $(this).data('idlibro');
        var idUsuarioVendedor = $(this).data('idusuvendedor');
        var idUsuarioComprador = $(this).data('idusucomprador');



        // Configura el id del libro en el formulario de valoración
        $('#idLibroValorar').val(idLibro);
        $('#idUsuarioVendedor').val(idUsuarioVendedor);
        $('#idUsuarioComprador').val(idUsuarioComprador);

        var idUsuarioVendedor = $('#idUsuarioVendedor').val();
        var idUsuarioComprador = $('#idUsuarioComprador').val();
    

        // Abre el modal de valoración
        $('#modalValoracion').modal('show');
    });

    // Envía el formulario de valoración
    $('#formValoracion').submit(function(e) {
        e.preventDefault();

        // Aquí puedes enviar la valoración al servidor
        var rating = $('#rating').val();
        var comentario = $('#comentario').val();
        var libroId = $('#idLibroValorar').val();
        var idUsuarioVendedor = $('#idUsuarioVendedor').val();
        var idUsuarioComprador = $('#idUsuarioComprador').val();

        

        // Hacer una petición AJAX para enviar la valoración
        $.ajax({
            url: '../includes/review.inc.php', // Asegúrate de reemplazar esta URL con la tuya
            type: 'POST',
            data: {
                rating: rating,
                comentario: comentario,
                libroId: libroId,
                idUsuarioVendedor: idUsuarioVendedor,
                idUsuarioComprador: idUsuarioComprador
            },
            success: function(data) {
                // Cierra el modal después de enviar la valoración
                $('#modalValoracion').modal('hide');

                // Limpiar el formulario
                $('#rating').barrating('clear');
                $('#comentario').val('');

                // Aquí puedes actualizar la interfaz de usuario con la nueva valoración
                // ...
                window.location.href = "../success.php";
                // Informar al usuario que la valoración fue enviada con éxito
         
            
            },
            error: function(err) {
                // Informar al usuario si hubo un error al enviar la valoración
                alert('Hubo un error al enviar tu valoración. Por favor, inténtalo de nuevo.');
            }
        });
    });
});

});