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
        reject(error);
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

function loadCarousel(carouselInnerId, productsToShow, userProfile) {

   // Crea la imagen de perfil aquí
   var imgPerfil = document.createElement("img");
   imgPerfil.classList.add("card-img-top", "img-fluid", "rounded-circle", "h-100", "border", "border-3", "border-dark");
   imgPerfil.src = "data:image/jpeg;base64," + userProfile.foto_perfil;
   imgPerfil.style.objectFit = "cover";
   imgPerfil.style.width = "180px";
   imgPerfil.style.borderRadius = "10px";
 
   // Selecciona el contenedor de la imagen de perfil
   var profileImageContainer = document.getElementById("profileImageContainer");
 
   // Agrega la imagen de perfil al contenedor
   profileImageContainer.appendChild(imgPerfil);

   var usu_apodo = document.getElementById("apodo");
   if (usu_apodo) {
    usu_apodo.textContent = userProfile.apodo;
  }

   var usu_nombre = document.getElementById("nombre");
   if(usu_nombre){
    usu_nombre.innerHTML = userProfile.nombre;
   }
   
   var usu_correo = document.getElementById("correo");
   if(usu_correo){
    usu_correo.innerHTML = userProfile.correo;
   }
 
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
    var products = data.products;
    var total = 0;
    console.log(data);  // Agrega esta línea
    var books_sold = data.books_sold;
    var books_on_sale = data.books_on_sale;

    console.log('Libros vendidos:', books_sold);
    console.log('Libros en venta:', books_on_sale);


    products.forEach(function(product) {
      if (product.titulo != null) {
        total++;
      }
    });

    var userProfile = products[0];

    var booksTabLink = document.querySelector(
      "a[data-toggle='tab'][href='#login']"
    );
    booksTabLink.innerHTML = `Libros (${total})`;

    var lastBooks = products;
    loadCarousel("carouselInner", lastBooks,userProfile);

// Muestra la cantidad de libros vendidos
var libros_vendidos = document.getElementById("libros_vendidos");
libros_vendidos.innerHTML = data.books_sold;

// Muestra la cantidad de libros en venta
var libros_en_venta = document.getElementById("libros_en_venta");
libros_en_venta.innerHTML = data.books_on_sale;},
function (error) {
console.error(error);
}
);

getReviews().then(
  function (data) {
    var reviews = data.reviews;
    var total = 0;

    reviews.forEach(function(review) {
      if (review.puntuacion != null) {
        total++;
      }
    });

    var reviewsTabLink = document.getElementById("reviewsTabLink");
    reviewsTabLink.innerHTML = `Valoraciones (${total})`;

    loadReviews(reviews);  // Llama a la nueva función aquí

    // Muestra la puntuación media
    var puntuacion = document.getElementById("puntuacion");
    puntuacion.innerHTML = data.average_score.toFixed(2);  // Convierte la puntuación media a un número con dos decimales
  },
  function (error) {
    console.error(error);
  }
);


function loadReviews(reviews) {
  var reviewsContainer = document.getElementById("reviewsContainer");  // Asegúrate de tener este contenedor en tu HTML

  reviews.forEach(function(review) {
    var reviewCard = createReviewCard(review);
    reviewsContainer.appendChild(reviewCard);
  });
}



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
  cardBody.classList.add("card-body", "d-flex", "flex-column","bg-black");

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
  price.classList.add("price-hp", "text-white", "text-end","fw-bold", "badge","mb-3");
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

function createReviewCard(review) {
  var card = document.createElement("div");
  card.classList.add("card", "my-2","rounded","bg-light");

  var cardBody = document.createElement("div");
  cardBody.classList.add("card-body");

  var rowTop = document.createElement("div");
  rowTop.classList.add("row", "align-items-center");

  var colImg = document.createElement("div");
  colImg.classList.add("col-auto");

  var imgLink = document.createElement("a");
  imgLink.href = `../profile/profile.php?id=${review.id_usu_valorador}`;
  imgLink.classList.add("profile-link");  // Añade la clase aquí

  var img = document.createElement("img");
  img.classList.add("rounded-circle");
  img.src = "data:image/jpeg;base64," + review.foto_perfil;
  img.alt = "Foto de perfil del revisor";
  img.style.width = "60px"; // Ajusta este valor para cambiar el tamaño de la imagen
  img.style.height = "60px"; // Asegúrate de que el alto y el ancho sean iguales para una imagen circular
  img.style.objectFit = "cover";

  imgLink.appendChild(img);
  colImg.appendChild(imgLink);

  var colName = document.createElement("div");
  colName.classList.add("col");

  var titleLink = document.createElement("a");
  titleLink.href = `../profile/profile.php?id=${review.id_usu_valorador}`;
  titleLink.classList.add("profile-link");  // Añade la clase aquí

  var title = document.createElement("h5");
  title.classList.add("card-title", "mb-0");
  title.textContent = review.nombre_valorador;

  titleLink.appendChild(title);
  colName.appendChild(titleLink);

  rowTop.appendChild(colImg);
  rowTop.appendChild(colName);

  var hr = document.createElement("hr");

  var rowMid = document.createElement("div");
  rowMid.classList.add("row", "align-items-center");

  var colRating = document.createElement("div");
  colRating.classList.add("col-auto");

  var rating = document.createElement("p");
  rating.classList.add("card-text", "mb-3", "star-rating");  // Añade la clase aquí
  var fullStar = "&#9733;";
  var emptyStar = "&#9734;";
  var stars = "";
  for(var i = 0; i < 5; i++) {
    if(i < review.puntuacion) {
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
  comment.textContent = review.comentario ? review.comentario : "No hay comentarios";

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
var profilePictureElement = document.getElementById('profilePicture');
if (profilePictureElement) {
document.getElementById('profilePicture').addEventListener('change', function(e) {
  // Comprueba si el usuario seleccionó un archivo
  if (e.target.files && e.target.files[0]) {
      // Restricciones de tamaño y formato
      var fileSize = e.target.files[0].size / 1024 / 1024; // tamaño del archivo en MB
      var fileType = e.target.files[0].type;
      
      if (fileSize > 2) { // Tamaño máximo de 2MB
          alert('El archivo es demasiado grande. Debe ser menor a 2MB.');
          return;
      }
      
      if (fileType !== 'image/jpeg' && fileType !== 'image/png') { // Solo permite JPG y PNG
          alert('El formato del archivo no es válido. Solo se permiten archivos JPG y PNG.');
          return;
      }

      var reader = new FileReader();

      reader.onload = function(event) {
          // Cuando la imagen esté cargada, reemplace la imagen del perfil
          var imgElement = document.createElement("img");
          imgElement.src = event.target.result;
          imgElement.classList.add("card-img-top", "img-fluid", "rounded-circle", "h-100", "border", "border-3", "border-dark");
          imgElement.style.objectFit = "cover";
          imgElement.style.width = "180px";
          imgElement.style.borderRadius = "10px";

          // Limpia el contenedor de la imagen de perfil y agrega la nueva imagen
          var container = document.getElementById('profileImageContainer');
          container.innerHTML = '';
          container.appendChild(imgElement);
      };

      // Lee la imagen como URL de datos
      reader.readAsDataURL(e.target.files[0]);
  } else {
      console.log("No file selected");
  }

});
}

