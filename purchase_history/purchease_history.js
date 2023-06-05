document.addEventListener("DOMContentLoaded", function () {
  $(document).ready(function () {
    $("#rating").barrating({
      theme: "fontawesome-stars",
      onSelect: function (value, text, event) {},
    });
  });

  $(function () {
    let activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
      $('.nav-link[href="' + activeTab + '"]').tab("show");
    }
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
      localStorage.setItem("activeTab", $(e.target).attr("href"));
    });
  });

  $(document).ready(function () {
    // Calificación de Estrellas
    $("#rating").barrating({
      theme: "fontawesome-stars",
    });

    // Abrir modal on Click
    $(".valorar").click(function () {
      var idLibro = $(this).data("idlibro");
      var rowId = $(this).data("rowid");
      var idUsuarioVendedor = $(this).data("idusuvendedor");
      var idUsuarioComprador = $(this).data("idusucomprador");

      // Configura el Id del Libro en el Formulario de Valoración
      $("#idLibroValorar").val(idLibro);
      $("#idUsuarioVendedor").val(idUsuarioVendedor);
      $("#idUsuarioComprador").val(idUsuarioComprador);
      $("#rowId").val(rowId);

      $("#modalValoracion").modal("show");
    });

    // Retirar Producto de la Tienda
    $(".retirar").click(function () {
      var idLibro = $(this).data("id");
      console.log("qweqwe");
      console.log(idLibro);

      var confirmar = confirm(
        "¿Seguro que quieres retirar el libro de la tienda?"
      );

      if (confirmar) {
        $.ajax({
          url: "../includes/deleteProduct.inc.php",
          type: "POST",
          data: {
            idLibro: idLibro,
          },
          success: function (data) {
            location.reload();
          },
          error: function (xhr, status, error) {
            alert("Hubo un problema al retirar el libro de la tienda.");
          },
        });
      }
    });

    // Formulario de Valoración
    $("#formValoracion").submit(function (e) {
      e.preventDefault();

      // Verificar Puntuación Seleccionada
      var rating = parseInt($("#rating").val());
      if (!rating) {
        alert(
          "Por favor, selecciona una puntuación antes de enviar la valoración."
        );
        return;
      }

      var rating = parseInt($("#rating").val());
      var comentario = $("#comentario").val();
      var libroId = parseInt($("#idLibroValorar").val());
      var idUsuarioVendedor = parseInt($("#idUsuarioVendedor").val());
      var idUsuarioComprador = parseInt($("#idUsuarioComprador").val());
      var rowId = parseInt($("#rowId").val());

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
          $("#formValoracion").hide();
          // Mostrar Mensaje Exito
          $("#successMessage").show();

          // Temporizador Modal
          setTimeout(function () {
            $("#modalValoracion").modal("hide");
          }, 2000);

          // Limpiar Formulario
          $("#rating").barrating("clear");
          $("#comentario").val("");

          // Recargar Página
          setTimeout(function () {
            location.reload();
          }, 2000);
        },
        error: function (err) {
          alert(
            "Hubo un error al enviar tu valoración. Por favor, inténtalo de nuevo."
          );
        },
      });
    });
  });
});
