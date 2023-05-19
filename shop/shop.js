var currentCategory = "";
var currentPage = 1;
var totalPages = 1;

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  const query = urlParams.get('query');
  getProducts(currentPage, currentCategory, query);
  
  $(".dropdown-item").click(function (event) {
    event.preventDefault();
    currentCategory = $(this).attr("href").split("=")[1];
    currentPage = 1;
    getProducts(currentPage, currentCategory, query);
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
      window.scrollTo(0, document.getElementById('category-header').offsetTop);
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
    data: { page: page, category: category, query: query }
  };

  $.ajax(ajaxSettings)
    .done(function (response) {
      $("#container").empty();
      var categoryName = (category === "") ? "Todos" : response.categoryName;
      $("#category-header").text(categoryName);

      response.products.forEach((producto) => {
        $("#container").append(createCard(producto));
      });

      currentPage = page;
      totalPages = response.totalPages;

      $("#page-number").text(currentPage);
      $("#total-pages").text(totalPages);

      $("#prev-page").prop("disabled", currentPage === 1);
      $("#next-page").prop("disabled", currentPage === totalPages);
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
  bookName.classList.add("mb-2","fw-bold");
  bookName.textContent = producto.titulo;
  applyEllipsisStyle(bookName, "1.2em", 1);

  bookNameRow.appendChild(bookName);

  var badgeRow = document.createElement("div");
  badgeRow.classList.add("row", "justify-content-center", "mb-3");

  var badge = document.createElement("span");
  badge.classList.add("badge", "rounded-pill", "bg-primary");
  badge.textContent = producto.nombre_genero;

  badgeRow.appendChild(badge);

  var priceRow = document.createElement("div");
  priceRow.classList.add("row", "justify-content-end");

  var price = document.createElement("span");
  price.classList.add(
    "price-hp",
    "text-white",
    "fw-bold",
    "text-end",
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

function applyEllipsisStyle(element, lineHeight, maxLines) {
  element.style.overflow = "hidden";
  element.style.textOverflow = "ellipsis";
  element.style.display = "-webkit-box";
  element.style.webkitBoxOrient = "vertical";
  element.style.webkitLineClamp = maxLines;
  element.style.lineHeight = lineHeight;
  element.style.maxHeight = `calc(${lineHeight} * ${maxLines})`;
}

