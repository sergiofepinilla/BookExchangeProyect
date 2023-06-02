document
  .getElementById("searchBar")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      search();
    }
  });

document
  .getElementById("searchBar2")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      search();
    }
  });

document
  .getElementById("btnSearch")
  .addEventListener("click", function (event) {
    search();
  });

document
  .getElementById("btnSearch2")
  .addEventListener("click", function (event) {
    search();
  });

function search() {
  var product = document.getElementById("searchBar").value;
  if (product) {
    window.location.replace("../shop/shop.php?query=" + product);
  } else {
    window.location.replace("../shop/shop.php");
  }
}

$(document).on(
  "click",
  "#dropdownMenuButton, .dropdown-menu",
  function (event) {
    event.stopPropagation();
  }
);
