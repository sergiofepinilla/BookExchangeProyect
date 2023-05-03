function validarFase1() {
    const nombre = document.getElementById('nombre');
    const autor = document.getElementById('autor');
    const isbn = document.getElementById('isbn');
    const editorial = document.getElementById('editorial');
    const estado = document.getElementById('estado');

    if (nombre.value === '' || estado.value === '') {
        alert('Rellene todos los campos marcados con un asterisco *');
        return false;
    }

    return true;
}

document.getElementById('btnFase1').addEventListener('click', function() {
    if (validarFase1()) {
        document.getElementById('pills-fase2-tab').click();
    }
});
document.getElementById('btnFase2').addEventListener('click', function() {
    if (validarFase1()) {
        document.getElementById('pills-fase3-tab').click();
    }
});
document.getElementById('btnFase3').addEventListener('click', function() {
    if (validarFase1()) {
        document.getElementById('pills-fase4-tab').click();
    }
});
document.getElementById('btnRegresar').addEventListener('click', function() {
    document.getElementById('pills-fase1-tab').click();
});
document.getElementById('btnFase3').addEventListener('click', function() {
if (validarFase1()) {
    document.getElementById('confirmNombre').innerText = document.getElementById('nombre').value;
    document.getElementById('confirmAutor').innerText = document.getElementById('autor').value;
    document.getElementById('confirmISBN').innerText = document.getElementById('isbn').value;
    document.getElementById('confirmEditorial').innerText = document.getElementById('editorial').value;
    document.getElementById('confirmGenero').innerText = document.getElementById('genero').options[document.getElementById('genero').selectedIndex].text;
    document.getElementById('confirmEstado').innerText = document.getElementById('estado').options[document.getElementById('estado').selectedIndex].text;
    document.getElementById('confirmPrecio').innerText = document.getElementById('precio').value;
    document.getElementById('confirmCambio').innerText = document.getElementById('cambio').checked ? 'Sí' : 'No';
    document.getElementById('confirmEnvio').innerText = document.getElementById('envio').checked ? 'Sí' : 'No';
    document.getElementById('confirmDescripcion').innerText = document.getElementById('descripcion').value;
    document.getElementById('pills-fase4-tab').click();
     // Añade esta línea para actualizar la imagen en la confirmación
    document.getElementById('confirmImagen').src = document.getElementById('imagenPrevia').src;

document.getElementById('pills-fase4-tab').click();
}
});

document.getElementById('btnRegresar2').addEventListener('click', function() {
    document.getElementById('pills-fase2-tab').click();
});

document.getElementById('imagen').addEventListener('change', function(e) {
const file = e.target.files[0];
const reader = new FileReader();

reader.onload = function(e) {
    const img = document.getElementById('imagenPrevia');
    img.src = e.target.result;
};

if (file) {
    reader.readAsDataURL(file);
} else {
    document.getElementById('imagenPrevia').src = '';
}
});