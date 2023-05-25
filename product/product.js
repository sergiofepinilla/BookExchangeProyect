document.addEventListener("DOMContentLoaded", function () {
  let sellerId;
  let id_book;
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const id = urlParams.get("id");
  let categories;

  function getCookie(name) {
    let cookieArray = document.cookie.split(";");
    let cookieName = name + "=";
    for (let i = 0; i < cookieArray.length; i++) {
      let cookie = cookieArray[i];
      while (cookie.charAt(0) === " ") {
        cookie = cookie.substring(1);
      }
      if (cookie.indexOf(cookieName) === 0) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }
    return "";
  }

  function setCookie(name, value, daysToExpire) {
    let date = new Date();
    date.setTime(date.getTime() + daysToExpire * 24 * 60 * 60 * 1000);
    let expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

  //Obtener Producto e Información del Usuario Vendedor
  function getProduct() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: "../modelo/product_model.php",
        type: "GET",
        data: { id: id },
        dataType: "json",
        success: function (data) {
          // No Existe Producto Mostrar Imagen no-result
          if (data.length === 0) {
            document.getElementById("no-results-image").style.display = "block";
            document.getElementById("bookContainer").style.display = "none";
            document.getElementById("recommendedContainer").style.display =
              "none";
            return;
          }
          resolve(data);
        },
        error: function (xhr, status, error) {},
      });
    });
  }
  //Obtener Libros Recomendados
  function getRecommendedBooks() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: "../modelo/recommended_books.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          resolve(data);
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    });
  }
  //Obtener Rating Vendedor
  function loadSellerRating() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: "../modelo/user_rating.php",
        type: "GET",
        data: { id: sellerId },
        dataType: "json",
        success: function (data) {
          resolve(data);
        },
        error: function (xhr, status, error) {
          reject(error);
        },
      });
    }).then(
      function (ratingData) {
        displaySellerRating(ratingData);
      },
      function (error) {
        console.error(error);
      }
    );
  }
  //Crear Estrellas
  function displaySellerRating(ratingData) {
    const user_rating = document.getElementById("user_rating");
    const review_count = document.getElementById("review_count");

    var fullStar = "&#9733;";
    var emptyStar = "&#9734;";
    var stars = "";
    for (var i = 0; i < 5; i++) {
      if (i < ratingData.average_score) {
        stars += fullStar;
      } else {
        stars += emptyStar;
      }
    }
    user_rating.innerHTML = stars;
    review_count.textContent = "(" + ratingData.num_reviews + ")";
  }

  if (!id) {
    window.location.replace("../home/home.php");
  } else {
    getProduct()
      .then((product) => {
        loadProduct(product[0]);
        return getRecommendedBooks();
      })
      .then((recommendedBooks) => {
        loadCarousel("recommendedCarouselInner", recommendedBooks);
        loadSellerRating();
      })
      .catch((error) => {
        console.error(error);
      });
  }
  //Cargar Carousel
  function loadCarousel(carouselInnerId, productsToShow) {
    var carouselInner = document.getElementById(carouselInnerId);

    for (let i = 0; i < productsToShow.length; i += 5) {
      var carouselItem = document.createElement("div");
      carouselItem.classList.add("carousel-item");

      if (i === 0) {
        carouselItem.classList.add("active");
      }

      var row = document.createElement("div");
      row.classList.add(
        "row",
        "row-cols-1",
        "row-cols-md-2",
        "row-cols-lg-3",
        "row-cols-xl-5",
        "g-3"
      );

      for (let j = i; j < i + 5 && j < productsToShow.length; j++) {
        var product = productsToShow[j];
        var card = createCard(product);
        row.appendChild(card);
      }

      carouselItem.appendChild(row);
      carouselInner.appendChild(carouselItem);
    }
  }
  //Cargar Producto
  function loadProduct(product) {
    sellerId = product.id_usuario;
    id_book = product.id;

    const categoryName = document.getElementById("genero_name");
    categoryName.innerHTML =
      "<span class='fw-bold'>Género</span>: " + product.nombre_genero;

    // Obtener Cookie Aceptada
    var cookiesAccepted = getCookie("cookiesAccepted");

    // Establecer Nueva Cookie Si Existe
    if (cookiesAccepted === "true") {
      setCookie("genre", product.nombre_genero, 30);
    }

    const recommendedGenre = getCookie("genre");
    const shopLink = document.getElementById("recommended_shop");
    if (recommendedGenre) {
      shopLink.href = `../shop/shop.php?query=${product.nombre_genero}`;
    } else {
      shopLink.href = "../shop/shop.php";
    }
    //Información Producto
    const name = document.getElementById("titulo");
    name.textContent = product.titulo;
    categories = product.id_genero;
    const autor = document.getElementById("autor");
    autor.innerHTML = "<span class='fw-bold'>Autor</span>: " + product.autor;

    const isbn = document.getElementById("isbn");
    isbn.innerHTML = "<span class='fw-bold'>ISBN</span>: " + product.isbn;

    const estado = document.getElementById("estado");
    estado.innerHTML = "<span class='fw-bold'>Estado</span>: " + product.estado;

    const editorial = document.getElementById("editorial");
    editorial.innerHTML =
      "<span class='fw-bold'>Editorial</span>: " + product.editorial;

    const price = document.getElementById("precio");
    price.textContent = "Precio: " + product.precio + " €";

    const desc = document.getElementById("descripcion");
    desc.innerHTML =
      "<span class='fw-bold'>Descripción</span>:" + product.descripcion;

    const usu_vendedor = document.getElementById("usu_vendedor");
    usu_vendedor.textContent = product.vendedor_apodo;

    const usuVendedorLink = document.getElementById("usu_vendedor_link");
    usuVendedorLink.href = `../profile/profile.php?id=${product.id_usuario}`;

    const imgContainer = document.getElementById("imgContainer");
    imgContainer.style.width = "300px";
    imgContainer.style.height = "300px";
    imgContainer.style.position = "relative";
    imgContainer.style.overflow = "hidden";
    const img = document.createElement("img");

    const profilePicture = document.getElementById("profilePicture");

    const img_perfil = document.createElement("img");
    img_perfil.classList.add(
      "card-img-top",
      "img-fluid",
      "rounded-circle",
      "border",
      "border-5",
      "border-dark",
      "img-perfil-vendedor"
    );
    img_perfil.src = "data:image/jpeg;base64," + product.foto_perfil;
    img_perfil.alt = product.vendedor_apodo;

    profilePicture.appendChild(img_perfil);

    if (typeof currentUserId !== "undefined") {
      if (currentUserId == product.id_usuario) {
        var comprarButton = document.getElementById("comprarButton");
        comprarButton.disabled = true;
        comprarButton.classList.add("btn-secondary");
        comprarButton.classList.remove("btn-primary");
        comprarButton.textContent = "No puedes comprar tu propio producto";
      }
    } else {
      var comprarButton = document.getElementById("comprarButton");
      comprarButton.disabled = true;
      comprarButton.classList.add("btn-secondary");
      comprarButton.classList.remove("btn-primary");
      comprarButton.textContent =
        "Necesitas estar registrado para poder comprar un producto";
    }

    img.classList.add("d-block", "img-fluid");
    img.src = "data:image/jpeg;base64," + product.imagen;
    img.alt = product.nombre;
    img.style.width = "100%";
    img.style.height = "100%";
    img.style.objectFit = "contain";

    imgContainer.appendChild(img);

    showRemoveProductLink(product);
  }
  // Impide Comprar Propios Productos
  function showRemoveProductLink(product) {
    const removeProductLink = document.getElementById("removeProductLink");

    if (product.id_usuario == currentUserId) {
      removeProductLink.style.display = "block";
      removeProductLink.querySelector(
        "a"
      ).href = `../purchase_history/purchase_history.php`;
    } else {
      // Si el producto no pertenece al usuario actual, oculta el enlace
      removeProductLink.style.display = "none";
    }
  }

  document.getElementById("buyBtn").addEventListener("click", function () {
    purchaseProduct();
  });
  //Proceso de Compra de Libro
  function purchaseProduct() {
    const id_usu_comprador = currentUserId;
    const id_usu_vendedor = sellerId;
    const titulo = document.getElementById("titulo").textContent;
    const isbn = document.getElementById("isbn").textContent.split(": ")[1];
    const autor = document.getElementById("autor").textContent.split(": ")[1];
    const genero = categories;
    const editorial = document
      .getElementById("editorial")
      .textContent.split(": ")[1];
    const estado = document.getElementById("estado").textContent.split(": ")[1];
    const precioElement = document.getElementById("precio");
    const precioText = precioElement.textContent.trim();
    const precioValue = precioText.split(":")[1].trim();
    const precio = parseFloat(precioValue);
    const id_libro = id_book;

    const formData = new FormData();
    formData.append("id_usu_comprador", id_usu_comprador);
    formData.append("id_usu_vendedor", id_usu_vendedor);
    formData.append("titulo", titulo);
    formData.append("isbn", isbn);
    formData.append("autor", autor);
    formData.append("genero", genero);
    formData.append("editorial", editorial);
    formData.append("estado", estado);
    formData.append("precio", precio);
    formData.append("id_libro", id_libro);

    // Enviar Datos al Script PHP vía AJAX
    fetch("../includes/purchase_process.inc.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error("Error en la solicitud");
        }
      })
      .then((data) => {
        if (data === "success") {
          window.location.href = "../home/home.php";
        } else {
          window.location.href = "../home/home.php?error=purchaseError";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
  //Función de Creación de Cartas de Producto
  function createCard(producto, margin = "") {
    var card = document.createElement("div");
    card.classList.add("col", "bg-black");
    if (margin) card.classList.add(margin);
    card.id = producto.id;

    var innerCard = document.createElement("div");
    innerCard.classList.add(
      "bg-black",
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
      "primary-btn",
      "w-100",
      "fw-bold",
      "border",
      "border-white",
      "rounded"
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

  // Modal Compra
  let comprarButton = document.getElementById("comprarButton");
  let comprarModal = new bootstrap.Modal(
    document.getElementById("comprarModal")
  );
  comprarButton.addEventListener("click", () => {
    comprarModal.show();
  });
});
