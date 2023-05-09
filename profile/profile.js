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
        resolve({
          products: data.products,
          total: data.total,
        });
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

getProducts().then(
  function (data) {
    var products = data.products;
    var total = data.total;

    var booksTabLink = document.querySelector(
      "a[data-toggle='tab'][href='#login']"
    );
    booksTabLink.innerHTML = `Libros (${total})`;

    var lastBooks = products.slice(0, 10);
    var recommendedBooks = products.slice(0, 10);

    loadCarousel("carouselInner", lastBooks);
    loadCarousel("recommendedCarouselInner", recommendedBooks);
  },
  function (error) {
    console.error(error);
  }
);

function createCard(producto, margin = "") {
  var card = document.createElement("div");
  card.classList.add("col");
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

  // Crea un div contenedor para la imagen
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
  ); // Añade las clases de Flexbox aquí
  imgContainer.style.height = "250px"; // Establece la altura fija del contenedor de la imagen

  var link = document.createElement("a");
  link.href = `../product/product.php?id=${producto.id}`;

  var img = document.createElement("img");
  img.classList.add("card-img-top", "img-fluid");
  img.src = "data:image/jpeg;base64," + producto.imagen;
  img.alt = producto.nombre;
  img.style.objectFit = "cover"; // Añade esta línea para ajustar la imagen al contenedor

  imgContainer.appendChild(img);
  link.appendChild(imgContainer);

  var cardBody = document.createElement("div");
  cardBody.classList.add("card-body", "d-flex", "flex-column","bg-black");

  // Crea el nuevo elemento <p> y asígnale una clase de Bootstrap
  var bookName = document.createElement("p");
  bookName.classList.add("mb-2"); // Añade una clase para el margen inferior

  // Establece el contenido del nuevo elemento <p> con el nombre del libro
  bookName.textContent = producto.nombre;

  // Aplica los estilos de puntos suspensivos al nombre del libro
  applyEllipsisStyle(bookName, "1.2em", 1); // lineHeight: 1.2em, maxLines: 1

  // Inserta el nuevo elemento <p> en el cardBody antes del elemento clearfix
  cardBody.insertBefore(bookName, clearfix);

  var clearfix = document.createElement("div");
  clearfix.classList.add("clearfix", "mb-3");

  var badge = document.createElement("span");
  badge.classList.add(
    "float-start",
    "badge",
    "rounded-pill",
    "bg-primary",
    "col-12",
    "col-xxl-9",
    "mb-3"
  );
  badge.textContent = producto.estado;
  clearfix.appendChild(badge);

  var price = document.createElement("span");
  price.classList.add(
    "float-end",
    "price-hp",
    "text-white",
    "bg-warning",
    "rounded-pill",
    "fw-bold",
    "badge"
  );
  price.innerHTML = `${producto.precio}&euro;`;
  clearfix.appendChild(price);

  cardBody.appendChild(clearfix);

  var textEnd = document.createElement("div");
  textEnd.classList.add("row", "gx-2");

  var divCheck = document.createElement("div");
  divCheck.classList.add("col-12");

  var checkBtn = document.createElement("a");
  checkBtn.classList.add("btn", "btn-success", "w-100");
  checkBtn.textContent = "VER";
  checkBtn.href = `../product/product.php?id=${producto.id}`;
  divCheck.appendChild(checkBtn);
  textEnd.appendChild(divCheck);

  var usu_apodo = document.getElementById("nombre");
  usu_apodo.textContent = producto.apodo;

  cardBody.appendChild(textEnd);

  innerCard.appendChild(link);
  innerCard.appendChild(cardBody);
  card.appendChild(innerCard);

  return card;
}


var booksTabLink = document.getElementById("booksTabLink");
booksTabLink.innerHTML = `Libros (${total})`;

var booksTabLink = document.getElementById("booksTabLink");

var booksTabLink = document.getElementById("booksTabLink");

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
