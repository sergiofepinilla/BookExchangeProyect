function getProducts() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: "../modelo/index.php",
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

// Load products into carousels
getProducts().then(
  function (products) {
    var lastBooks = products.slice(0, 10);
    var recommendedBooks = products.slice(0, 10); // Cambiar a futuro por los libros recomendados

    loadCarousel("carouselInner", lastBooks);
    loadCarousel("recommendedCarouselInner", recommendedBooks);
  },
  function (error) {
    console.error(error);
  }
);

/*
getProducts().then(function (products) {
    productos = products.slice(0, 5); // Obtén los primeros 4 elementos del array de productos
    productos.forEach(producto => {
        productosLista.appendChild(createCard(producto))
    })
}, function (error) {
    console.error(error);
});
*/

/*
getProducts().then(function (products) {
    productos = products
    productos.forEach(producto => {
        productosLista.appendChild(createCard(producto))
    })
}, function (error) {
    console.error(error);
});
*/

function createCard(producto, margin = "") {
  var card = document.createElement("div");
  card.classList.add("col");
  if (margin) card.classList.add(margin);
  card.id = producto.id;

  var innerCard = document.createElement("div");
  innerCard.classList.add("card", "bg-black", "border-3", "border-dark");

  var link = document.createElement("a");
  link.href = `../product/product.php?id=${producto.id}`;

  var img = document.createElement("img");
  img.classList.add("card-img-top");
  img.src = producto.imagen;
  img.alt = producto.nombre;
  link.appendChild(img);

  var cardBody = document.createElement("div");
  cardBody.classList.add("card-body");

  var clearfix = document.createElement("div");
  clearfix.classList.add("clearfix", "mb-3");

  var badge = document.createElement("span");
  badge.classList.add(
    "float-start",
    "badge",
    "rounded-pill",
    "bg-primary",
    "col-12",
    "col-xxl-9"
  );
  badge.textContent = producto.nombre;
  clearfix.appendChild(badge);

  var price = document.createElement("span");
  price.classList.add("float-end", "price-hp", "text-white");
  price.innerHTML = `${producto.precio}&euro;`;
  clearfix.appendChild(price);

  cardBody.appendChild(clearfix);

  var textEnd = document.createElement("div");
  textEnd.classList.add("row", "gx-2");

  var divBuy = document.createElement("div");
  divBuy.classList.add("col-12", "col-xxl-6");

  var buyBtn = document.createElement("button");
  buyBtn.classList.add("btn", "btn-success", "w-100", "mb-2", "mb-xxl-0");
  buyBtn.textContent = "COMPRA";
  divBuy.appendChild(buyBtn);
  textEnd.appendChild(divBuy);

  buyBtn.addEventListener("click", addToCart);

  var divCheck = document.createElement("div");
  divCheck.classList.add("col-12", "col-xxl-6");

  var checkBtn = document.createElement("a");
  checkBtn.classList.add("btn", "btn-primary", "w-100");
  checkBtn.textContent = "VER";
  checkBtn.href = `../product/product.php?id=${producto.id}`;
  divCheck.appendChild(checkBtn);
  textEnd.appendChild(divCheck);

  cardBody.appendChild(textEnd);

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
