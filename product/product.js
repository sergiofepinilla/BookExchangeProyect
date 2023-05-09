document.addEventListener("DOMContentLoaded", function () {
let sellerId;
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");
const categories = ["Fantasia", "Novelas", "", "", "", ""];

function getProduct() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: "../modelo/product_model.php",
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
  sellerId = product.id_usuario;
  console.log(sellerId);
  const category = document.getElementById("genero");
  category.href = `../shop/shop.php?category=${product.genero}`;
  category.textContent = categories[product.genero - 1];

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
  price.textContent = "Precio: "+product.precio + " €";

  const desc = document.getElementById("descripcion");
  desc.innerHTML = "<span class='fw-bold'>Descripción</span>:" +product.descripcion;

  const usu_vendedor = document.getElementById("usu_vendedor");
  usu_vendedor.textContent = product.vendedor_apodo;


  

  const usuVendedorLink = document.getElementById("usu_vendedor_link");
  usuVendedorLink.href = `../profile/profile.php?id=${product.id_usuario}`;

  const imgContainer = document.getElementById("imgContainer");
  const img = document.createElement("img");
  
  

  if (currentUserId == product.id_usuario) {
    const buyBtn = document.getElementById("buyBtn");
    buyBtn.disabled = true;
    buyBtn.classList.add("btn-secondary");
    buyBtn.classList.remove("btn-primary");
    buyBtn.textContent = "No puedes comprar tu propio producto";
  }
  img.classList.add("d-block","w-100","img-fluid");
  img.src = "data:image/jpeg;base64," + product.imagen;
  img.alt = product.nombre;
  
  imgContainer.appendChild(img);

  showRemoveProductLink(product);
}

function showRemoveProductLink(product) {
  const removeProductLink = document.getElementById("removeProductLink");

  if (product.id_usuario == currentUserId) {
    // Si el producto pertenece al usuario actual, muestra el enlace y asigna la URL de retirar producto
    removeProductLink.style.display = "block";
    removeProductLink.querySelector("a").href = `../remove_product/remove_product.php?productId=${product.id}`;
  } else {
    // Si el producto no pertenece al usuario actual, oculta el enlace
    removeProductLink.style.display = "none";
  }
}

document.getElementById("buyBtn").addEventListener("click", function () {
  purchaseProduct();
});


function purchaseProduct() {
  // Extrae la información del producto y del vendedor
  // (asumiendo que todos estos valores ya están en el DOM y disponibles)
  const id_usu_comprador = currentUserId;
  const id_usu_vendedor = sellerId;
  const nombre = document.getElementById("nombre").textContent;
  const isbn = document.getElementById("isbn").textContent.split(": ")[1];
  const autor = document.getElementById("autor").textContent.split(": ")[1];
  const genero = categories.indexOf(document.getElementById("categoria").textContent) + 1;
  const editorial = document.getElementById("editorial").textContent.split(": ")[1];
  const estado = document.getElementById("estado").textContent.split(": ")[1];
  const precio = parseFloat(document.getElementById("precio").textContent.split(" ")[0]);

  const formData = new FormData();
  formData.append("id_usu_comprador", id_usu_comprador);
  formData.append("id_usu_vendedor", id_usu_vendedor);
  formData.append("nombre", nombre);
  formData.append("isbn", isbn);
  formData.append("autor", autor);
  formData.append("genero", genero);
  formData.append("editorial", editorial);
  formData.append("estado", estado);
  formData.append("precio", precio);

  // Envía los datos al script de PHP usando AJAX
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
      if (data) {
        // Redirige a la página de éxito
        window.location.href = "../success.php";
      } else {
        // Redirige a la página de error
        window.location.href = "../error.php";
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

});