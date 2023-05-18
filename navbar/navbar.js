var previousCart = JSON.parse(localStorage.getItem("cart"));

const btnSearch = document.getElementById("btnSearch");
btnSearch.addEventListener("click", search);

document.getElementById('searchBar').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        search();
    }
});

function search() {
    var product = document.getElementById("searchBar").value;
    if (product) {
        window.location.replace("../shop/shop.php?query=" + product);
    } else {
        window.location.replace("../shop/shop.php");
    }
}

setInterval(function() {
    var cart = JSON.parse(localStorage.getItem("cart"));

    if (!previousCart) {
        // Establece el valor de la variable previousCart con el nuevo valor de cart
        previousCart = cart;
    }

    if (JSON.stringify(previousCart) !== JSON.stringify(cart)) {
        // Actualiza el valor de la variable previousCart con el nuevo valor de cart
        previousCart = cart;

        var totalAmountCount = 0;

        cart.forEach((product) => {
            //totalAmountCount += product.quantity;
        });

        document.getElementById("cartCount").innerHTML = cart.length;
    }
}, 1000);

$(document).on('click', '#dropdownMenuButton, .dropdown-menu', function(event) {
    event.stopPropagation();
});
