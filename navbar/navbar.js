var previousCart = JSON.parse(localStorage.getItem("cart"));

const btnSearch = document.getElementById("btnSearch");
btnSearch.addEventListener("click", search);

function search() {
  var product = document.getElementById("searchBar").value;
  if (product) {
    window.location.replace("../shop/shop.php?name=" + product);
  } else {
    window.location.replace("../shop/shop.php");
  }
}

setInterval(function () {
  var cart = JSON.parse(localStorage.getItem("cart"));

  if (!previousCart) {
    // Establece el valor de la variable previousArray con el nuevo valor de array
    previousCart = cart;
  }

  if (previousCart !== cart) {
    // Actualiza el valor de la variable previousArray con el nuevo valor de array
    previousCart = cart;

    var totalAmountCount = 0;

    cart.forEach((product) => {
      //totalAmountCount += product.quantity;
    });

    document.getElementById("cartCount").innerHTML = cart.length;
  }
}, 1000);
