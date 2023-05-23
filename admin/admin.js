document.addEventListener("DOMContentLoaded", function () {

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


// Borrar usuario
$(".delete-user").click(function () {
  var idUsuario = $(this).data("id");
  console.log(idUsuario);
  var confirmar = confirm("¿Seguro que quieres eliminar el usuario?");
  if (confirmar) {
    $.ajax({
      url: "../includes/deleteUser.inc.php",
      type: "POST",
      data: {
        idUsuario: idUsuario,
      },
      success: function (data) {
        location.reload();
      },
      error: function (xhr, status, error) {
        alert("Hubo un problema al eliminar el usuario.");
      },
    });
  }
});

$(".block-user").click(function () {
  var idUsuario = $(this).data("id");
  console.log(idUsuario);
  var confirmar = confirm("¿Seguro que quieres bloquear y eliminar los registros del usuario?");
  if (confirmar) {
    $.ajax({
      url: "../includes/blockUser.inc.php",
      type: "POST",
      data: {
        idUsuario: idUsuario,
      },
      success: function (data) {
        location.reload();
      },
      error: function (xhr, status, error) {
        alert("Hubo un problema al bloquear al usuario.");
      },
    });
  }
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
    //Retirar Producto de la Tienda 
});
