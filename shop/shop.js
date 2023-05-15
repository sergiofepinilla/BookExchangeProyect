$(document).ready(function () {
  getProducts(); // Muestra todos los productos cuando se carga la página

  $(".dropdown-item").click(function (event) {
    event.preventDefault(); // Detiene la acción por defecto del click en el enlace
    var category = $(this).attr("href").split("=")[1]; // Obtiene la categoría del href del enlace
    getProducts(category); // Hace la solicitud GET con la categoría seleccionada
  });
});

function getProducts(category) {
  var ajaxSettings = {
    url: "../modelo/shop_product.php",
    type: "GET",
    dataType: "json",
  };

  var categoryName = "Todos"; // Por defecto, mostramos todos los productos

  if (category !== undefined) {
    ajaxSettings.data = { category: category };
    categoryName = $(
      ".dropdown-item[href='./shop.php?category=" + category + "']"
    ).text();
  }

  $.ajax(ajaxSettings)
    .done(function (products) {
      // Borra el contenido actual del contenedor
      $("#container").empty();

      // Actualiza el encabezado con la categoría seleccionada
      $("#category-header").text(categoryName);

      // Añade los nuevos productos al contenedor
      var productos = products;
      productos.forEach((producto) => {
        container.appendChild(createCard(producto));
      });
    })
    .fail(function (xhr, status, error) {
      console.error(error);
    });
}

function createCard(producto, margin = "") {
  var card = document.createElement("div");
  card.classList.add("col", "mb-3");
  if (margin) card.classList.add(margin);
  card.id = producto.id;

  var innerCard = document.createElement("div");
  innerCard.classList.add(
    "text-white",
    "card",
    "border-3",
    "border-dark",
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
    "border",
    "border-bottom",
    "border-white"
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
  cardBody.classList.add("card-body", "d-flex", "flex-column", "bg-black");

  var bookNameRow = document.createElement("div");
  bookNameRow.classList.add("row", "justify-content-center");

  var bookName = document.createElement("p");
  bookName.classList.add("mb-2");
  bookName.textContent = producto.titulo;
  applyEllipsisStyle(bookName, "1.2em", 1);

  bookNameRow.appendChild(bookName);

  var badgeRow = document.createElement("div");
  badgeRow.classList.add("row", "justify-content-center", "mb-3");

  var badge = document.createElement("span");
  badge.classList.add("badge", "rounded-pill", "bg-primary");
  badge.textContent = producto.estado;

  badgeRow.appendChild(badge);

  var priceRow = document.createElement("div");
  priceRow.classList.add("row", "justify-content-end");

  var price = document.createElement("span");
  price.classList.add(
    "price-hp",
    "text-white",
    "bg-warning",
    "rounded-pill",
    "fw-bold",
    "badge",
    "mb-3"
  );
  price.innerHTML = `${producto.precio}&euro;`;

  priceRow.appendChild(price);

  cardBody.appendChild(bookNameRow);
  cardBody.appendChild(badgeRow);
  cardBody.appendChild(priceRow);

  var btnRow = document.createElement("div");
  btnRow.classList.add("row");

  var divCheck = document.createElement("div");
  divCheck.classList.add("col-12");

  var checkBtn = document.createElement("a");
  checkBtn.classList.add("btn", "btn-success", "w-100");
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

function addToCart(e) {
  var cart = localStorage.getItem("cart");
  cart = JSON.parse(cart) ?? [];

  var id = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var product =
    cart.find((x) => x.id === id) ?? productos.find((x) => x.id === id);

  if (cart.find((x) => x.id === id)) cart.find((x) => x.id === id).quantity++;
  else {
    product.quantity++;
    cart.push(product);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
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
