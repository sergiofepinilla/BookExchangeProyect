// Crea una variable para almacenar el valor anterior del array
var previousCart = JSON.parse(localStorage.getItem("cart"));

const btnSearch = document.getElementById('btnSearch')
btnSearch.addEventListener('click', search)

function search() {
    var product = document.getElementById('searchBar').value
    if (product) {
        window.location.replace("../shop/shop.php?name=" + product);
    } else {
        window.location.replace("../shop/shop.php");
    }
}

setInterval(function () {
    // Obtiene el valor del array desde localStorage
    var cart = JSON.parse(localStorage.getItem("cart"));

    // Comprueba si es la primera vez que se carga el array
    if (!previousCart) {
        // Establece el valor de la variable previousArray con el nuevo valor de array
        previousCart = cart;
    }

    // Comprueba si el array ha cambiado
    if (previousCart !== cart) {
        // Actualiza el valor de la variable previousArray con el nuevo valor de array
        previousCart = cart;


        var totalAmountCount = 0;
        // Actualiza el valor del span según la longitud del array
        cart.forEach(product => {
            //totalAmountCount += product.quantity;
        });

        document.getElementById("cartCount").innerHTML = cart.length;
    }
}, 1000); // Comprueba cada segundo