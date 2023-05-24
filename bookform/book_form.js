function sanitarizar(input) {
  // Eliminar cualquier etiqueta HTML
  let sanitizedInput = input.replace(/(<([^>]+)>)/gi, "");

  // Eliminar cualquier caracter especial
  sanitizedInput = sanitizedInput.replace(/[^\w\s]/gi, "");

  // Eliminar espacios al inicio y al final
  sanitizedInput = sanitizedInput.trim();

  return sanitizedInput;
}

//Limitar input precio
const precioInput = document.getElementById('precio');
precioInput.addEventListener('input', () => {
  if (precioInput.value.length > 5) {
    precioInput.value = precioInput.value.slice(0, 5);
  }
});

//Limitar textarea descripcion 
const descripcionInput = document.getElementById('descripcion');
const maxLengthDescription = 250; 

descripcionInput.addEventListener('input', () => {
  const descripcion = descripcionInput.value;

  if (descripcion.length > maxLengthDescription) {
    descripcionInput.value = descripcion.slice(0, maxLengthDescription);
  }
});

//Limitar ISBN 
const isbnInput = document.getElementById('isbn');
const maxLengthISBN = 13;

isbnInput.addEventListener('input', () => {
  const isbn = isbnInput.value;

  if (isbn.length > maxLengthISBN) {
    isbnInput.value = isbn.slice(0, maxLengthISBN);
  }
});



function validarFase1() {
  const nombre = document.getElementById("nombre");
  const autor = document.getElementById("autor");
  const isbn = document.getElementById("isbn");
  const editorial = document.getElementById("editorial");
  const estado = document.getElementById("estado");

  const sanitizedNombre = sanitarizar(nombre.value);
  const sanitizedAutor = sanitarizar(autor.value);
  const sanitizedIsbn = sanitarizar(isbn.value);
  const sanitizedEditorial = sanitarizar(editorial.value);
  const sanitizedEstado = sanitarizar(estado.value);

  if (sanitizedNombre === "" || sanitizedEstado === "") {
    alert("Rellene todos los campos marcados con un asterisco *");
    return false;
  }

     // Expresión regular para validar el ISBN
     const isbnRegex = /^(|\d{10}|\d{13})$/;

      if (!isbnRegex.test(sanitizedIsbn)) {
        alert("El ISBN debe estar vacío, contener 10 dígitos o 13 dígitos.");
        return false;
    }

  // Actualizar el valor de los campos de texto con la versión sanitizada
  nombre.value = sanitizedNombre;
  autor.value = sanitizedAutor;
  isbn.value = sanitizedIsbn;
  editorial.value = sanitizedEditorial;
  estado.value = sanitizedEstado;

  return true;
}

function validarFase2() {
  const precio = document.getElementById("precio");
 

  const sanitizedPrecio = precio.value;
  const descripcion = document.getElementById("descripcion");

  const sanitizedDescripcion = sanitarizar(descripcion.value);

  if (sanitizedPrecio === "" || isNaN(sanitizedPrecio)) {
    alert("Por favor, ingrese un precio válido");
    return false;
  }
  console.log(sanitizedPrecio);
  console.log(isNaN(sanitizedPrecio));

  // Actualizar el valor del campo de texto con la versión sanitizada
  precio.value = sanitizedPrecio;
  descripcion.value = sanitizedDescripcion;

  console.log(precio.value);
  console.log(isNaN(sanitizedPrecio));
  console.log(isNaN(sanitizedPrecio));

  return true;
}

document.getElementById("btnFase1").addEventListener("click", function () {
  if (validarFase1()) {
    document.getElementById("pills-fase2-tab").click();
  }
});
document.getElementById("btnFase2").addEventListener("click", function () {
  if (validarFase1() && validarFase2()) {
    document.getElementById("pills-fase3-tab").click();
  }
});
document.getElementById("btnFase3").addEventListener("click", function () {
  if (validarFase1() && validarFase2()) {
    document.getElementById("pills-fase4-tab").click();
  }
});

document.getElementById("btnFase3").addEventListener("click", function () {
  if (validarFase1() && validarFase2()) {
    document.getElementById("confirmNombre").innerText =
      document.getElementById("nombre").value;
    document.getElementById("confirmAutor").innerText =
      document.getElementById("autor").value;
    document.getElementById("confirmISBN").innerText =
      document.getElementById("isbn").value;
    document.getElementById("confirmEditorial").innerText =
      document.getElementById("editorial").value;
    document.getElementById("confirmGenero").innerText =
      document.getElementById("genero").options[
        document.getElementById("genero").selectedIndex
      ].text;
    document.getElementById("confirmEstado").innerText =
      document.getElementById("estado").options[
        document.getElementById("estado").selectedIndex
      ].text;
    document.getElementById("confirmPrecio").innerText =
      document.getElementById("precio").value;
    document.getElementById("confirmDescripcion").innerText =
      document.getElementById("descripcion").value;
      
    // Añade este código para actualizar la imagen en la confirmación
    if (document.getElementById("imagen").files.length > 0) {
      document.getElementById("confirmImagen").src =
        document.getElementById("imagenPrevia").src;
    } else {
      document.getElementById("confirmImagen").src = "../assets/img/default.PNG";
    }

    document.getElementById("pills-fase4-tab").click();
  }
});

// Habilitar - Deshabilitar Envio por CheckBox

const enviarFormulario = document.getElementById('enviarFormulario');
const confirmarEnvio = document.getElementById('confirmarEnvio');

// Inicialmente, el botón de envío está deshabilitado
enviarFormulario.disabled = true;

// Cuando el estado del checkbox cambia, actualiza el estado del botón de envío
confirmarEnvio.addEventListener('change', () => {
    enviarFormulario.disabled = !confirmarEnvio.checked;
});




//Botones de regreso
document.getElementById("btnRegresar").addEventListener("click", function () {
  document.getElementById("pills-fase1-tab").click();
});

document.getElementById("btnRegresar2").addEventListener("click", function () {
  document.getElementById("pills-fase2-tab").click();
});

document.getElementById("btnRegresar3").addEventListener("click", function () {
  document.getElementById("pills-fase3-tab").click();
});

//Preview de la imagen
document.getElementById("imagen").addEventListener("change", function (e) {
  const file = e.target.files[0];
  const reader = new FileReader();

  // Tamaño máximo del archivo: 2 MB
  const maxSize = 2 * 1024 * 1024;

  // Dinmensiones Máximas
  const maxWidth = 1920;
  const maxHeight = 1080;

  const allowedFormats = ["image/jpeg", "image/png"];

  if (file) {
    if (file.size > maxSize) {
      alert("El tamaño del archivo de imagen no debe superar los 2 MB.");
      e.target.value = "";
      return;
    }

    if (!allowedFormats.includes(file.type)) {
      alert("Solo se permiten formatos de archivo JPEG y PNG.");
      e.target.value = "";
      return;
    }

    reader.onload = function (e) {
      const img = new Image();

      img.onload = function () {
        if (img.width > maxWidth || img.height > maxHeight) {
          alert(
            "Las dimensiones de la imagen no deben superar 1920x1080 píxeles."
          );
          document.getElementById("imagen").value = "";
        } else {
          document.getElementById("imagenPrevia").src = e.target.result;
        }
      };

      img.src = e.target.result;
    };

    reader.readAsDataURL(file);
  } else {
    document.getElementById("imagenPrevia").src = "";
  }
});
