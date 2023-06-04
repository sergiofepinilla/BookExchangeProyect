function getProducts() {
  return new Promise(function (resolve, reject) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    $.ajax({
      url: "../modelo/user_profile_products.php",
      type: "GET",
      dataType: "json",
      data: { id: id },
      success: function (data) {
        resolve(data);
      },
      error: function (xhr, status, error) {
        document.getElementById("no-results-image").style.display = "block";
        document.getElementById("user-info").style.display = "none";
        document.getElementById("user-reviews").style.display = "none";
        //reject(error);
      },
    });
  });
}

function getReviews() {
  return new Promise(function (resolve, reject) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    $.ajax({
      url: "../modelo/user_profile_reviews.php",
      type: "GET",
      dataType: "json",
      data: { id: id },
      success: function (data) {
        resolve(data);
      },
      error: function (xhr, status, error) {
        reject(error);
      },
    });
  });
}

var productos;
var containerNovedades = document.getElementById("containerNovedades");
var productosLista = document.getElementById("productosLista");

function loadCarousel(carouselInnerId, productsToShow, userInfo, isLarge) {
  var imgPerfil = document.createElement("img");
  imgPerfil.classList.add(
    "card-img-top",
    "img-fluid",
    "rounded-circle",
    "h-100",
    "border",
    "border-3",
    "border-dark"
  );
  imgPerfil.src = "data:image/jpeg;base64," + userInfo.foto_perfil;
  imgPerfil.style.objectFit = "cover";
  imgPerfil.style.width = "180px";
  imgPerfil.style.borderRadius = "10px";

  var profileImageContainer = document.getElementById("profileImageContainer");
  profileImageContainer.appendChild(imgPerfil);

  var usu_apodo = document.getElementById("apodo");
  if (usu_apodo) {
    usu_apodo.textContent = userInfo.apodo;
  }

  var usu_nombre = document.getElementById("nombre");
  if (usu_nombre) {
    usu_nombre.innerHTML = userInfo.nombre;
  }

  var usu_correo = document.getElementById("correo");
  if (usu_correo) {
    usu_correo.innerHTML = userInfo.correo;
  }

  var carouselInner = document.getElementById(carouselInnerId);

  var productsPerItem = isLarge ? 5 : 2;

  for (let i = 0; i < productsToShow.length; i += productsPerItem) {
    var carouselItem = document.createElement("div");
    carouselItem.classList.add("carousel-item");

    if (i === 0) {
      carouselItem.classList.add("active");
    }

    var row = document.createElement("div");
    row.classList.add(
      "row",
      "row-cols-2",
      "row-cols-md-2",
      "row-cols-lg-3",
      "row-cols-xl-" + productsPerItem,
      "g-3"
    );

    for (let j = i; j < i + productsPerItem && j < productsToShow.length; j++) {
      var product = productsToShow[j];
      if (product.titulo != null) {
        var card = createCard(product);
      }
      row.appendChild(card);
    }

    carouselItem.appendChild(row);
    carouselInner.appendChild(carouselItem);
  }
}

getProducts().then(
  function (data) {
    console.log(data);
    var userInfo = data.user_info;
    if (userInfo.length === 0) {
      // Mostrar Imagen no-products
      document.getElementById("no-results-image").style.display = "block";
      document.getElementById("user-info").style.display = "none";
      document.getElementById("user-reviews").style.display = "none";
      return;
    }

    var total = 0;
    var products = data.products;

    if (products.length === 0) {
      // Mostrar Imagen no-products
      $("#book_div").css("display", "none");
      $("#no_book_div").css("display", "flex");
    }

    products.forEach(function (product) {
      if (product.titulo != null) {
        total++;
      }
    });

    var booksTabLink = document.querySelector(
      "a[data-toggle='tab'][href='#login']"
    );
    booksTabLink.innerHTML = `Libros (${total})`;

    var lastBooks = products;
    loadCarousel("carouselInnerLarge", lastBooks, userInfo, true);
    loadCarousel("carouselInnerSmall", lastBooks, userInfo, false);

    // Cantidad Libros Vendidos
    var libros_vendidos = document.getElementById("libros_vendidos");
    libros_vendidos.innerHTML = data.books_sold;

    // Cantidad Libros Venta
    var libros_en_venta = document.getElementById("libros_en_venta");
    libros_en_venta.innerHTML = data.books_on_sale;
  },
  function (error) {
    console.error(error);
  }
);

getReviews().then(
  function (data) {
    var reviews = data.reviews;
    var total = 0;

    if (reviews.length === 0) {
      // Mostrar Imagen no-products
      $("#reviewsContainer").css("display", "none");
      $("#no-reviews-div").css("display", "flex");
    }

    reviews.forEach(function (review) {
      if (review.puntuacion != null) {
        total++;
      }
    });

    var reviewsTabLink = document.getElementById("reviewsTabLink");
    reviewsTabLink.innerHTML = `Valoraciones (${total})`;

    loadReviews(reviews);

    // Puntuación Media
    var puntuacion = document.getElementById("puntuacion");
    // Puntuación Media a Numero con 2 Decimales
    puntuacion.innerHTML = data.average_score.toFixed(2);
  },
  function (error) {
    console.error(error);
  }
);

function loadReviews(reviews) {
  var reviewsContainer = document.getElementById("reviewsContainer");

  reviews.forEach(function (review) {
    var reviewCard = createReviewCard(review);
    reviewsContainer.appendChild(reviewCard);
  });
}

function createCard(producto, margin = "") {
  var card = document.createElement("div");
  card.classList.add("col", "dark-theme");
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

function createReviewCard(review) {
  var card = document.createElement("div");
  card.classList.add(
    "card",
    "mb-4",
    "rounded",
    "dark-theme",
    "custom-card-border",
    "custom-text"
  );

  var cardBody = document.createElement("div");
  cardBody.classList.add("card-body");

  var rowTop = document.createElement("div");
  rowTop.classList.add("row", "align-items-center");

  var colImg = document.createElement("div");
  colImg.classList.add("col-auto");

  var imgLink = document.createElement("a");
  imgLink.href = `../profile/profile.php?id=${review.id_usu_valorador}`;
  imgLink.classList.add("profile-link");

  var img = document.createElement("img");
  img.classList.add("rounded-circle");
  img.src = "data:image/jpeg;base64," + review.foto_perfil;
  img.alt = "Foto de perfil del revisor";
  img.style.width = "60px";
  img.style.height = "60px";
  img.style.objectFit = "cover";

  imgLink.appendChild(img);
  colImg.appendChild(imgLink);

  var colName = document.createElement("div");
  colName.classList.add("col");

  var titleLink = document.createElement("a");
  titleLink.href = `../profile/profile.php?id=${review.id_usu_valorador}`;
  titleLink.classList.add("profile-link");

  var title = document.createElement("h5");
  title.classList.add("card-title", "mb-0");
  title.textContent = review.nombre_valorador;

  titleLink.appendChild(title);
  colName.appendChild(titleLink);

  rowTop.appendChild(colImg);
  rowTop.appendChild(colName);

  var hr = document.createElement("div");
  hr.classList.add("custom-hr", "w-100", "mb-2", "mt-2");

  var rowMid = document.createElement("div");
  rowMid.classList.add("row", "align-items-center");

  var colRating = document.createElement("div");
  colRating.classList.add("col-auto");

  var rating = document.createElement("p");
  rating.classList.add("card-text", "mb-3", "star-rating");
  var fullStar = "&#9733;";
  var emptyStar = "&#9734;";
  var stars = "";
  for (var i = 0; i < 5; i++) {
    if (i < review.puntuacion) {
      stars += fullStar;
    } else {
      stars += emptyStar;
    }
  }
  rating.innerHTML = stars;

  colRating.appendChild(rating);

  var colDate = document.createElement("div");
  colDate.classList.add("col", "text-end");

  var date = document.createElement("p");
  date.classList.add("card-text", "mb-0");
  var reviewDate = new Date(review.fecha_review);
  date.textContent = "Fecha de revisión: " + reviewDate.toLocaleDateString();

  colDate.appendChild(date);

  rowMid.appendChild(colRating);
  rowMid.appendChild(colDate);

  var comment = document.createElement("p");
  comment.classList.add("card-text");
  comment.textContent = review.comentario ? review.comentario : "";

  cardBody.appendChild(rowTop);
  cardBody.appendChild(hr);
  cardBody.appendChild(rowMid);
  cardBody.appendChild(comment);
  card.appendChild(cardBody);

  return card;
}

var booksTabLink = document.getElementById("booksTabLink");

function applyEllipsisStyle(element, lineHeight, maxLines) {
  element.style.overflow = "hidden";
  element.style.textOverflow = "ellipsis";
  element.style.display = "-webkit-box";
  element.style.webkitBoxOrient = "vertical";
  element.style.webkitLineClamp = maxLines;
  element.style.lineHeight = lineHeight;
  element.style.maxHeight = `calc(${lineHeight} * ${maxLines})`;
}
var profilePictureElement = document.getElementById("profilePicture");
if (profilePictureElement) {
  document
    .getElementById("profilePicture")
    .addEventListener("change", function (e) {
      if (e.target.files && e.target.files[0]) {
        // Restricciones Tamaño / Formato
        var fileSize = e.target.files[0].size / 1024 / 1024;
        var fileType = e.target.files[0].type;

        if (fileSize > 2) {
          // Tamaño máximo de 2MB
          alert("El archivo es demasiado grande. Debe ser menor a 2MB.");
          return;
        }

        if (fileType !== "image/jpeg" && fileType !== "image/png") {
          // Solo permite JPG y PNG
          alert(
            "El formato del archivo no es válido. Solo se permiten archivos JPG y PNG."
          );
          return;
        }

        var reader = new FileReader();

        reader.onload = function (event) {
          var imgElement = document.createElement("img");
          imgElement.src = event.target.result;
          imgElement.classList.add(
            "card-img-top",
            "img-fluid",
            "rounded-circle",
            "h-100",
            "border",
            "border-3",
            "border-dark"
          );
          imgElement.style.objectFit = "cover";
          imgElement.style.width = "180px";
          imgElement.style.borderRadius = "10px";

          var container = document.getElementById("profileImageContainer");
          container.innerHTML = "";
          container.appendChild(imgElement);
        };

        reader.readAsDataURL(e.target.files[0]);
      } else {
        console.log("No file selected");
      }
    });
}
