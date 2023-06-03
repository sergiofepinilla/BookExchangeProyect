document.addEventListener("DOMContentLoaded", (event) => {
  var currentCategory = "";
  var currentPage = 1;
  var totalPages = 1;

  $(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get("query");
    getProducts(currentPage, currentCategory, query);

    $(".dropdown-item").click(function (event) {
      event.preventDefault();
      currentCategory = $(this).attr("href").split("=")[1];
      currentPage = 1;

      // Borra el parámetro de búsqueda (query) de la URL.
      urlParams.delete("query");

      // Actualiza la URL en la barra de direcciones sin recargar la página.
      history.pushState({}, "", "?" + urlParams.toString());

      // Llama a getProducts sin el parámetro de búsqueda.
      getProducts(currentPage, currentCategory);
    });

    $("#prev-page").click(function (event) {
      event.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        getProducts(currentPage, currentCategory, query);
      }
    });

    $("#next-page").click(function (event) {
      event.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        window.scrollTo(
          0,
          document.getElementById("category-header").offsetTop
        );
        getProducts(currentPage, currentCategory, query);
      }
    });

    $("#clear").click(function (event) {
      event.preventDefault();
      currentCategory = "";
      currentPage = 1;
      getProducts(currentPage, currentCategory);
    });

    if (currentPage === 1) {
      $("#prev-page").prop("disabled", true);
    } else {
      $("#prev-page").prop("disabled", false);
    }

    if (currentPage === totalPages) {
      $("#next-page").prop("disabled", true);
      document.getElementById("next-page").disabled = true;
    } else {
      $("#next-page").prop("disabled", false);
      document.getElementById("next-page").disabled = false;
    }
  });

  function getProducts(page, category, query) {
    var ajaxSettings = {
      url: "../modelo/shop_product.php",
      type: "GET",
      dataType: "json",
      data: { page: page, category: category, query: query },
    };

    $.ajax(ajaxSettings)
      .done(function (response) {
        $("#container").empty();
        var categoryName = category === "" ? "Todos" : response.categoryName;
        $("#category-header").text(categoryName);

        if (response.products.length === 0) {
          $("#no-results-image").css("display", "flex");
          $("#container").css("display", "none");
          $("#pagination-container").css("display", "none");
        } else {
          response.products.forEach((producto) => {
            $("#container").append(createCard(producto));
          });
          $("#no-results-image").css("display", "none");
          $("#container").css("display", "flex");
          $("#pagination-container").css("display", "block");
        }

        currentPage = page;
        totalPages = response.totalPages;

        $("#page-info").text(`Página ${currentPage} de ${totalPages}`);

        $("#prev-page").prop("disabled", currentPage === 1);
        $("#next-page").prop("disabled", currentPage === totalPages);
      })
      .fail(function (xhr, status, error) {
        console.error(error);
      });
  }

  function createCard(producto, margin = "") {
    var card = document.createElement("div");
    card.classList.add(
      "col-12",
      "px-4",
      "px-md-2",
      "col-md-3",
      "dark-theme",
      "mb-3"
    );
    if (margin) card.classList.add(margin);
    card.id = producto.id;

    var innerCard = document.createElement("div");
    innerCard.classList.add(
      "dark-theme",
      "text-white",
      "card",
      "d-flex",
      "flex-column",
      "h-100"
    );

    var imgContainer = document.createElement("div");
    imgContainer.classList.add(
      "flex-grow-1",
      "d-flex",
      "align-items-center",
      "justify-content-center",
      "img-fluid",
      "overflow-hidden",
      "custom-card-border",
      "rounded"
    );
    imgContainer.style.height = "250px";

    var link = document.createElement("a");
    link.href = `../product/product.php?id=${producto.id}`;

    var img = document.createElement("img");
    img.classList.add("card-img-top", "img-fluid");
    img.src = "data:image/jpeg;base64," + producto.imagen;
    img.alt = producto.titulo;
    img.style.objectFit = "contain";
    img.style.height = "100%";
    img.style.width = "auto";

    imgContainer.appendChild(img);
    link.appendChild(imgContainer);

    var cardBody = document.createElement("div");
    cardBody.classList.add(
      "card-body",
      "d-flex",
      "flex-column",
      "dark-theme",
      "custom-card-border",
      "rounded"
    );

    var bookNameRow = document.createElement("div");
    bookNameRow.classList.add("row", "justify-content-center");

    var bookName = document.createElement("p");
    bookName.classList.add("mb-2", "fw-bold");
    bookName.textContent = producto.titulo;
    applyEllipsisStyle(bookName, "1.2em", 1);

    bookNameRow.appendChild(bookName);

    var autorBadgeRow = document.createElement("div");
    autorBadgeRow.classList.add("row", "justify-content-center", "mb-3");

    var autorBadge = document.createElement("span");
    autorBadge.classList.add("badge", "bg-light", "text-dark");
    autorBadge.textContent = producto.autor;

    autorBadgeRow.appendChild(autorBadge);

    var categoryBadgeRow = document.createElement("div");
    categoryBadgeRow.classList.add("row", "justify-content-center", "mb-3");

    var badge = document.createElement("span");
    badge.classList.add("badge", "inf-nav", "border", "border-white");
    badge.textContent = producto.nombre_genero;

    categoryBadgeRow.appendChild(badge);

    var priceRow = document.createElement("div");
    priceRow.classList.add("row", "justify-content-end", "text-end");

    var price = document.createElement("span");
    price.classList.add("price-hp", "text-white", "fw-bold", "mb-3");
    price.innerHTML = `${producto.precio}&euro;`;

    priceRow.appendChild(price);

    cardBody.appendChild(bookNameRow);
    cardBody.appendChild(autorBadgeRow);
    cardBody.appendChild(categoryBadgeRow);
    cardBody.appendChild(priceRow);

    var btnRow = document.createElement("div");
    btnRow.classList.add("row");

    var divCheck = document.createElement("div");
    divCheck.classList.add("col-12");

    var checkBtn = document.createElement("a");
    checkBtn.classList.add(
      "btn",
      "w-100",
      "fw-bold",
      "dark-theme",
      "custom-text",
      "rounded",
      "custom-card-border"
    );
    checkBtn.textContent = "VER";
    checkBtn.href = `../product/product.php?id=${producto.id}`;
    divCheck.appendChild(checkBtn);
    btnRow.appendChild(divCheck);

    cardBody.appendChild(btnRow);

    innerCard.appendChild(link);
    innerCard.appendChild(cardBody);
    card.appendChild(innerCard);

    return card;
  }

  function applyEllipsisStyle(element, lineHeight, maxLines) {
    element.style.overflow = "hidden";
    element.style.textOverflow = "ellipsis";
    element.style.display = "-webkit-box";
    element.style.webkitBoxOrient = "vertical";
    element.style.webkitLineClamp = maxLines;
    element.style.lineHeight = lineHeight;
    element.style.maxHeight = `calc(${lineHeight} * ${maxLines})`;
  }
});
