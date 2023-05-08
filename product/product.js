const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");
const categories = ["Fantasia", "Novelas", "", "", "", ""];

function getProduct() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: "../modelo/homepage_product2.php",
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
      loadProduct(product[0]);
    },
    function (error) {
      console.error(error);
    }
  );
}

function loadProduct(product) {
  const category = document.getElementById("categoria");
  category.href = `../shop/shop.php?category=${product.categoria}`;
  category.textContent = categories[product.categoria - 1];

  const name = document.getElementById("nombre");
  name.textContent = product.nombre;

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
  price.textContent = product.precio + " €";

  const desc = document.getElementById("descripcion");
  desc.textContent = product.descripcion;

  const usu_vendedor = document.getElementById("usu_vendedor");
  usu_vendedor.textContent = product.vendedor_apodo;

  const usu_correo = document.getElementById("usu_correo");
  usu_correo.textContent = product.vendedor_correo;

  const usuVendedorLink = document.getElementById("usu_vendedor_link");
  usuVendedorLink.href = `../profile/profile.php?id=${product.id_usuario}`;

  const imgContainer = document.getElementById("imgContainer");
  const img = document.createElement("img");
  img.classList.add("d-block", "w-100");
  img.src = "data:image/jpeg;base64," + product.imagen;
  img.alt = product.nombre;
  imgContainer.appendChild(img);
}
