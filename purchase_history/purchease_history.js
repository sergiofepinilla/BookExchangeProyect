document.addEventListener("DOMContentLoaded", function () {
  $(document).ready(function () {
    $("#rating").barrating({
      theme: "fontawesome-stars",
      onSelect: function (value, text, event) {
        // Aquí puedes definir lo que sucederá cuando el usuario seleccione una calificación.
        // Por ejemplo, puedes enviar la calificación a un servidor o mostrar un mensaje.
      },
    });
  });

  $(function () {
    // Al cargar la página, comprueba si hay un tab guardado en la localStorage
    let activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
      // Si hay un tab guardado, actívalo
      $('.nav-link[href="' + activeTab + '"]').tab("show");
    }

    // Cuando cambies de tab, guarda el nuevo tab en la localStorage
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
      localStorage.setItem("activeTab", $(e.target).attr("href"));
    });
  });

  $(document).ready(function () {
    // Inicializa la calificación de estrellas
    $("#rating").barrating({
      theme: "fontawesome-stars",
    });

    // <!-- Abrir modal on Click -->
    $(".valorar").click(function () {
      var idLibro = $(this).data("idlibro");
      var rowId = $(this).data("rowid");
      var idUsuarioVendedor = $(this).data("idusuvendedor");
      var idUsuarioComprador = $(this).data("idusucomprador");

      // Configura el id del libro en el formulario de valoración
      $("#idLibroValorar").val(idLibro);
      $("#idUsuarioVendedor").val(idUsuarioVendedor);
      $("#idUsuarioComprador").val(idUsuarioComprador);
      $("#rowId").val(rowId);

      // Abre el modal de valoración
      $("#modalValoracion").modal("show");
    });
    // <!-- Abrir modal on Click -->

    // <-- Retirar Producto de la Tienda -->
    $(".retirar").click(function () {
      var idLibro = $(this).data("id");
      console.log("qweqwe");
      console.log(idLibro);

      var confirmar = confirm(
        "¿Seguro que quieres retirar el libro de la tienda?"
      );

      if (confirmar) {
        // Aquí iría la llamada AJAX para eliminar el libro.
        $.ajax({
          url: "../includes/deleteProduct.inc.php", // Cambia esto por la ruta a tu script PHP para retirar libros.
          type: "POST",
          data: {
            idLibro: idLibro,
          },
          success: function (data) {
            // Recargar la página o actualizar la tabla después de que el libro se haya retirado exitosamente.
            location.reload();
          },
          error: function (xhr, status, error) {
            alert("Hubo un problema al retirar el libro de la tienda.");
          },
        });
      }
    });
    // <-- Retirar Producto de la Tienda -->

    // <-- Formulario de Valoración -->
    $("#formValoracion").submit(function (e) {
      e.preventDefault();

      // Aquí puedes enviar la valoración al servidor
      var rating = parseInt($("#rating").val());
      var comentario = $("#comentario").val();
      var libroId = parseInt($("#idLibroValorar").val());
      var idUsuarioVendedor = parseInt($("#idUsuarioVendedor").val());
      var idUsuarioComprador = parseInt($("#idUsuarioComprador").val());
      var rowId = parseInt($("#rowId").val());

      console.log("Tipo de rating: " + rating);
      console.log("Tipo de comentario: " + comentario);
      console.log("Tipo de libroId: " + libroId);
      console.log("Tipo de idUsuarioComprador: " + idUsuarioComprador);
      console.log("Tipo de idUsuarioVendedor: " + idUsuarioVendedor);
      console.log("Rowid: " + rowId);

      $.ajax({
        url: "../includes/review.inc.php",
        type: "POST",
        data: {
          rating: rating,
          comentario: comentario,
          libroId: libroId,
          idUsuarioVendedor: idUsuarioVendedor,
          idUsuarioComprador: idUsuarioComprador,
          rowId: rowId,
        },
        success: function (data) {
          // Cierra el modal después de enviar la valoración
          $("#modalValoracion").modal("hide");

          // Limpiar el formulario
          $("#rating").barrating("clear");
          $("#comentario").val("");

          location.reload();
          // Informar al usuario que la valoración fue enviada con éxito
        },
        error: function (err) {
          // En caso de error
          alert(
            "Hubo un error al enviar tu valoración. Por favor, inténtalo de nuevo."
          );
        },
      });
    });
    // <-- Formulario de Valoración -->
  });
});
