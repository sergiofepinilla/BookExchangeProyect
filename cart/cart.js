class Product {
  id = 0;
  name;
  description;
  price;
  imageUrl;
  quantity;
  constructor(name, description, price, imageUrl, quantity) {
    this.name = name;
    this.description = description;
    this.price = price;
    this.imageUrl = imageUrl;
    this.quantity = quantity;
  }
}
document.addEventListener("DOMContentLoaded", () => {
  var ticket = document.getElementById("ticket");
  var lista = document.getElementById("listaProductos");
  var total = 0;
  var productos = localStorage.getItem("cart");
  productos = JSON.parse(productos) ?? [];

  if (productos.length == 0) {
    document.getElementById("totalAmount").classList.add("d-none");
    document.getElementById("checkOut").classList.add("d-none");

    return;
  }

  document.getElementById("emptyStuff").classList.add("d-none");

  productos.forEach((product) => {
    lista.appendChild(addProductToList(product));
    ticket.appendChild(addProductToTicket(product));
    total += product.quantity * product.price;
  });
  document.getElementById("total").innerText = total.toFixed(2) + "€";

  function addProductToList(product) {
    console.log(product);

    // Create the outer container for the product row
    const row = document.createElement("div");
    row.classList.add("row", "py-2", "me-1", "align-items-center");
    row.id = product.id;

    // Create the image column
    const imageCol = document.createElement("div");
    imageCol.classList.add("col-4", "col-sm-3", "mb-4");
    const image = document.createElement("img");
    image.src = product.image;
    image.alt = product.name;
    image.classList.add("w-75", "border", "border-3");
    imageCol.appendChild(image);
    row.appendChild(imageCol);

    // Create the product details column
    const detailsCol = document.createElement("div");
    detailsCol.classList.add("col-6");
    const name = document.createElement("h4");
    name.textContent = product.name;
    detailsCol.appendChild(name);

    const description = document.createElement("p");
    description.textContent = product.description.substring(0, 90) + "...";
    detailsCol.appendChild(description);
    row.appendChild(detailsCol);

    // Create the quantity and delete button column
    const buttonCol = document.createElement("div");
    buttonCol.classList.add("col-12", "col-sm-3", "d-flex", "flex-column");

    const rowAmount = document.createElement("div");
    rowAmount.classList.add("d-flex");
    buttonCol.appendChild(rowAmount);

    const addQuantity = document.createElement("button");
    addQuantity.classList.add(
      "col-4",
      "btn",
      "fw-bold",
      "text-white",
      "border",
      "border-danger"
    );
    addQuantity.textContent = "-";
    rowAmount.appendChild(addQuantity);
    addQuantity.addEventListener("click", () => {
      var numberAmount = document.getElementById(
        "amount-article-" + product.id
      );

      numberAmount.value = parseInt(numberAmount.value) - 1;

      if (numberAmount.value < 1) {
        numberAmount.value = 1;
      }

      addProduct(addQuantity);
    });

    const amountContainer = document.createElement("div");
    amountContainer.classList.add("col-4", "p-1");
    rowAmount.appendChild(amountContainer);

    const quantity = document.createElement("input");
    quantity.id = "amount-article-" + product.id;
    quantity.type = "number";
    quantity.value = product.quantity;
    quantity.min = 1;
    quantity.classList.add("col-12", "text-end", "quantityValue");
    amountContainer.appendChild(quantity);
    quantity.addEventListener("input", addProduct);

    const remQuantity = document.createElement("button");
    remQuantity.classList.add(
      "col-4",
      "btn",
      "fw-bold",
      "text-white",
      "border",
      "border-danger"
    );
    remQuantity.textContent = "+";
    rowAmount.appendChild(remQuantity);
    remQuantity.addEventListener("click", () => {
      var numberAmount = document.getElementById(
        "amount-article-" + product.id
      );
      numberAmount.value = parseInt(numberAmount.value) + 1;

      addProduct(addQuantity);
    });

    const deleteButton = document.createElement("button");
    deleteButton.classList.add(
      "btn",
      "mt-1",
      "mb-4",
      "border",
      "border-danger"
    );
    const deleteIcon = document.createElement("i");
    deleteIcon.classList.add("bi", "bi-trash", "text-white");
    deleteIcon.style.pointerEvents = "none";
    deleteButton.appendChild(deleteIcon);
    deleteButton.addEventListener("click", deleteProduct);
    buttonCol.appendChild(deleteButton);
    row.appendChild(buttonCol);

    // Create a horizontal rule to separate the product rows
    const hr = document.createElement("hr");
    row.appendChild(hr);

    return row;
  }

  function addProductToTicket(product) {
    const div = document.createElement("div");
    div.classList.add("d-flex", "justify-content-between");
    div.id = product.id;

    const productName = document.createElement("p");
    productName.innerText = product.name;
    div.appendChild(productName);

    const productPrice = document.createElement("p");
    productPrice.innerText = `${product.quantity} x ${product.price}€`;
    div.appendChild(productPrice);

    return div;
  }

  function deleteProduct(e) {
    var parentNode = e.target.parentNode.parentNode;
    var elements = document.getElementsByName(parentNode.getAttribute("name"));

    var cart = localStorage.getItem("cart");
    cart = JSON.parse(cart);
    var targetId = parentNode.id;
    var product = cart.find((x) => x.id === targetId);

    if (product == null) {
      return;
    }

    console.log(targetId);

    // Buscar y eliminar de LocalStorage
    for (let i = cart.length - 1; i >= 0; i--) {
      var thisProduct = cart[i];

      if (thisProduct.id === product.id) {
        cart.splice(i, 1);

        break;
      }
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    if (cart.length == 0) {
      document.getElementById("totalAmount").classList.toggle("d-none");
      document.getElementById("checkOut").classList.toggle("d-none");
      document.getElementById("emptyStuff").classList.toggle("d-none");
    }
    // Eliminar de la lista de productos
    parentNode.remove();

    // Eliminar del ticket
    var ticket = document.getElementById("ticket");
    var ticketProduct = ticket.querySelector(
      `.d-flex.justify-content-between[id='${product.id}']`
    );
    ticketProduct.remove();

    updateTicketTotal(cart);
  }

  function addProduct(e) {
    //COMPROBAR QUE NO ESTÉ VACIO
    if (e.target != null) {
      if (e.target.value == "") e.target.value = 1;
    }

    var cart = localStorage.getItem("cart");
    cart = JSON.parse(cart);

    //ACTUALIZAR CANTIDAD
    var targetId;

    if (e.target != null) {
      // Botones en number
      targetId = e.target.parentNode.parentNode.parentNode.parentNode.id;
    } else {
      // Botones -/+ a los lados de number
      targetId = e.parentNode.parentNode.parentNode.id;
    }

    var product = cart.find((x) => x.id === targetId);
    product.quantity = parseInt(
      document.getElementById("amount-article-" + targetId).value
    );
    localStorage.setItem("cart", JSON.stringify(cart));

    //ACTUALIZAR CANTIDAD DEL TICKET SI SE ESPECIFICA PRODUCTO
    var ticket = document
      .getElementById("ticket")
      .querySelector(`.d-flex.justify-content-between[id='${product.id}']`);
    ticket.getElementsByTagName(
      "p"
    )[1].innerText = `${product.quantity} x ${product.price}€`;

    updateTicketTotal(cart);
  }

  function updateTicketTotal(cart) {
    //ACTUALIZAR TOTAL
    total = 0;
    cart.forEach((product) => {
      total += product.quantity * product.price;
    });
    document.getElementById("total").innerText = total.toFixed(2) + "€";
  }
});
