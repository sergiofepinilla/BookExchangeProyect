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
  const category = document.getElementById("genero");
  category.href = `../shop/shop.php?category=${product.genero}`;
  category.textContent = categories[product.genero - 1];

  const name = document.getElementById("titulo");
  name.textContent = product.titulo;

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

  const profilePicture = document.getElementById("profilePicture");

  const img_perfil = document.createElement("img");
  img_perfil.classList.add("card-img-top", "img-fluid", "rounded-circle", "border", "border-5", "border-dark");
  img_perfil.style.maxHeight = "100%"; // Establece la altura máxima de la imagen al 100% del contenedor
  img_perfil.style.width = "auto"; // Ajusta automáticamente el ancho de la imagen según su proporción
  img_perfil.src = "data:image/jpeg;base64," + product.foto_perfil;
  img_perfil.alt = product.vendedor_apodo;

  profilePicture.appendChild(img_perfil);
  
  
  if(typeof currentUserId !== "undefined"){
    if (currentUserId == product.id_usuario) {
      const buyBtn = document.getElementById("buyBtn");
      buyBtn.disabled = true;
      buyBtn.classList.add("btn-secondary");
      buyBtn.classList.remove("btn-primary");
      buyBtn.textContent = "No puedes comprar tu propio producto";
    }
}else{
      const buyBtn = document.getElementById("buyBtn");
      buyBtn.disabled = true;
      buyBtn.classList.add("btn-secondary");
      buyBtn.classList.remove("btn-primary");
      buyBtn.textContent = "Necesitas estar registrado para poder comprar un producto";
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
  const id_usu_comprador = currentUserId;
  console.log(id_usu_comprador);
  const id_usu_vendedor = sellerId;
  console.log(id_usu_vendedor);
  const titulo = document.getElementById("titulo").textContent;
  console.log(titulo);
  const isbn = document.getElementById("isbn").textContent.split(": ")[1];
  console.log(isbn);
  const autor = document.getElementById("autor").textContent.split(": ")[1];
  console.log(autor);
  const genero = categories.indexOf(document.getElementById("genero").textContent) + 1;
  console.log(genero);
  const editorial = document.getElementById("editorial").textContent.split(": ")[1];
  console.log(editorial);
  const estado = document.getElementById("estado").textContent.split(": ")[1];
  console.log(estado);
  const precioElement = document.getElementById("precio");
  const precioText = precioElement.textContent.trim(); // Elimina espacios en blanco al inicio y al final
  const precioValue = precioText.split(":")[1].trim(); // Extrae la parte después de ":" y elimina espacios en blanco
  const precio = parseFloat(precioValue); // Convierte el valor en formato numérico

  const formData = new FormData();
  formData.append("id_usu_comprador", id_usu_comprador);
  formData.append("id_usu_vendedor", id_usu_vendedor);
  formData.append("titulo", titulo);
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
      if (data === "success") {
        // Redirige a la página de éxito
        window.location.href = "../home/home.php";
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