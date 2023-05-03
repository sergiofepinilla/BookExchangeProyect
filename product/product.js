const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");
const categories = ["Fantasia", "Novelas", "", "", "", ""];

function getProduct() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: "../modelo/index.php",
      type: "GET",
      data: { id: id },
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

function getImages() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: "../modelo/images.php",
      type: "GET",
      data: { id: id },
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

if (!id) {
  window.location.replace("../error/404.html");
} else {
  getProduct().then(
    function (product) {
      loadPodruct(product[0]);
    },
    function (error) {
      console.error(error);
    }
  );
}

function loadPodruct(product) {
  var index = 1;
  function createImg(image1, image2) {
    const img1 = document.createElement("img");
    img1.src = image1;
    img1.classList.add("d-block", "w-100");

    const img2 = document.createElement("img");
    img2.src = image2;
    img2.classList.add("d-block", "w-100");

    const col1 = document.createElement("div");
    col1.classList.add("col");
    col1.appendChild(img1);

    const col2 = document.createElement("div");
    col2.classList.add("col");
    col2.appendChild(img2);

    const row = document.createElement("div");
    row.classList.add("row");
    row.appendChild(col1);
    row.appendChild(col2);

    const carouselItem = document.createElement("div");
    carouselItem.classList.add("carousel-item");
    if (index == 1) {
      carouselItem.classList.add("active");
      index++;
    }
    carouselItem.appendChild(row);

    return carouselItem;
  }
  const imgContainer = document.getElementById("imgContainer");

  getImages().then(
    function (images) {
      var i = 1;
      var imageOld = "";
      images.forEach((image) => {
        if (i == 1) {
          imageOld = image;
          i++;
        } else {
          i = 1;
          imgContainer.appendChild(createImg(imageOld.ruta, image.ruta));
        }
      });
    },
    function (error) {
      console.error(error);
    }
  );

  const category = document.getElementById("categoria");
  category.href = `../shop/shop.php?category=${product.categoria}`;
  category.textContent = categories[product.categoria - 1];

  const name = document.getElementById("nombre");
  name.textContent = product.nombre;

  const price = document.getElementById("precio");
  price.textContent = product.precio + " €";

  const desc = document.getElementById("descripcion");
  desc.textContent = product.descripcion;
}
