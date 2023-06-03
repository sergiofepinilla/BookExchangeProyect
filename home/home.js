document.addEventListener("DOMContentLoaded", function () {
  const recommendedGenre = getCookie("genre");
  const shopLink = document.getElementById("recommended_shop");
  if (recommendedGenre) {
    shopLink.href = `../shop/shop.php?query=${recommendedGenre}`;
  } else {
    shopLink.href = "../shop/shop.php";
  }
  //Obtener Productos
  function getProducts() {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: "../modelo/homepage_product.php",
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

  function loadCarousel(carouselInnerId, productsToShow, productsPerSlide) {
    var carouselInner = document.getElementById(carouselInnerId);

    for (let i = 0; i < productsToShow.length; i += productsPerSlide) {
      var carouselItem = document.createElement("div");
      carouselItem.classList.add("carousel-item");

      if (i === 0) {
        carouselItem.classList.add("active");
      }

      var row = document.createElement("div");
      row.classList.add(
        "row",
        "row-cols-2",
        "row-cols-sm-2",
        "row-cols-md-2",
        "row-cols-lg-5",
        "row-cols-xl-5",
        "g-3"
      );

      for (
        let j = i;
        j < i + productsPerSlide && j < productsToShow.length;
        j++
      ) {
        var product = productsToShow[j];
        var card = createCard(product);
        row.appendChild(card);
      }

      carouselItem.appendChild(row);
      carouselInner.appendChild(carouselItem);
    }
  }

  // Cargar Productos En Carousel
  Promise.all([getProducts(), getRecommendedBooks()]).then(
    function ([products, recommendedBooks]) {
      var lastBooks = products.slice(0, 10);
      loadCarousel("carouselInnerLg", lastBooks, 5); // 5 productos por slide en pantalla grande
      loadCarousel("carouselInnerSm", lastBooks, 2); // 2 productos por slide en pantalla pequeña
      loadCarousel("recommendedCarouselInnerLg", recommendedBooks, 5); // Ajusta esto según tus necesidades
      loadCarousel("recommendedCarouselInnerSm", recommendedBooks, 2); // Ajusta esto según tus necesidades
    },
    function (error) {
      console.error(error);
    }
  );

  // Crear Tarjetas Personalizadas Para Cada Producto
  function createCard(producto, margin = "") {
    var card = document.createElement("div");
    card.classList.add("col", "dark-th");
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
  // Aplicar Estilo A Las Tarjetas
  function applyEllipsisStyle(element, lineHeight, maxLines) {
    element.style.overflow = "hidden";
    element.style.textOverflow = "ellipsis";
    element.style.display = "-webkit-box";
    element.style.webkitBoxOrient = "vertical";
    element.style.webkitLineClamp = maxLines;
    element.style.lineHeight = lineHeight;
    element.style.maxHeight = `calc(${lineHeight} * ${maxLines})`;
  }

  // Obtener El Valor De Una Cookie
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Establecer Cookie
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  // Mostrar notificación de Cookies
  function showCookieNotification() {
    var cookieNotification = document.getElementById("cookie-notification");
    cookieNotification.style.display = "block";
  }

  // Ocultar Notificación sin Establecer Cookie
  function acceptCookies() {
    setCookie("cookiesAccepted", "true", 30);
    var cookieNotification = document.getElementById("cookie-notification");
    cookieNotification.style.display = "none";
  }

  //Rechazar Cookie - Ocultar Notificación
  function rejectCookies() {
    var cookieNotification = document.getElementById("cookie-notification");
    cookieNotification.style.display = "none";
  }

  // Verifica Cookie "genero" Establecida
  var genreCookie = getCookie("cookiesAccepted");
  if (genreCookie === null) {
    showCookieNotification();
  }

  var acceptCookiesButton = document.getElementById("accept-cookies");
  acceptCookiesButton.addEventListener("click", acceptCookies);

  var rejectCookiesButton = document.getElementById("reject-cookies");
  rejectCookiesButton.addEventListener("click", rejectCookies);
});
