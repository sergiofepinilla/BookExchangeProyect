document.addEventListener("DOMContentLoaded", function () {
    //GESTION TABS
    $(function () {
        // Comprobar Tab Guardado en Local Storage
        let activeTab = localStorage.getItem("activeTab");
        if (activeTab) {
            $('.nav-link[href="' + activeTab + '"]').tab("show");
        }
        // Guardar Nuevo Tab
        $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
            localStorage.setItem("activeTab", $(e.target).attr("href"));
        });
    });

    // Borrar Usuario
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

    // Bloquear Usuario
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

        var confirmar = confirm("¿Seguro que quieres retirar el libro de la tienda?");

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
});