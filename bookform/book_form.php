<?php
require_once '../header/header.php';
require_once '../navbar/navbar.php';
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-fase1-tab" data-bs-toggle="pill" href="#pills-fase1" role="tab" aria-controls="pills-fase1" aria-selected="true" style="pointer-events: none;">Información</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-fase2-tab" data-bs-toggle="pill" href="#pills-fase2" role="tab" aria-controls="pills-fase2" aria-selected="false" style="pointer-events: none;">Precio y Envío</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-fase3-tab" data-bs-toggle="pill" href="#pills-fase3" role="tab" aria-controls="pills-fase3" aria-selected="false" style="pointer-events: none;">Imagen</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-fase4-tab" data-bs-toggle="pill" href="#pills-fase4" role="tab" aria-controls="pills-fase4" aria-selected="false" style="pointer-events: none;">Confirmación</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-fase1" role="tabpanel" aria-labelledby="pills-fase1-tab">
                    <h1>Información del libro</h1>
                    <hr>
                    <form>
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del libro</label>
                                    <input type="text" placeholder="Ingrese el nombre del libro *" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" placeholder="Ingrese el ISBN del libro" class="form-control" id="isbn" name="isbn" required>
                                </div>
                                <div class="mb-3">
                                    <label for="autor" class="form-label">Autor</label>
                                    <input type="text" placeholder="Ingrese el autor del libro " class="form-control" id="autor" name="autor" required>
                                </div>
                            </div>
                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editorial" class="form-label">Editorial</label>
                                    <input type="text" placeholder="Ingrese la editorial del libro" class="form-control" id="editorial" name="editorial" required>
                                </div>
                                <div class="mb-3">
                                    <label for="genero" class="form-label">Género</label>
                                    <select class="form-select" id="genero" name="genero" required>
                                        <option value="">Seleccione el género del libro *</option>
                                        <option value="1">Acción y aventura</option>
                                        <option value="2">Biografía</option>
                                        <option value="3">Ciencia ficción</option>
                                        <option value="4">Crimen y misterio</option>
                                        <option value="5">Cuento de hadas</option>
                                        <option value="6">Ensayo</option>
                                        <option value="7">Fantasía</option>
                                        <option value="8">Ficción histórica</option>
                                        <option value="9">Ficción literaria</option>
                                        <option value="10">Horror y terror</option>
                                        <option value="11">Humor</option>
                                        <option value="12">Infantil y juvenil</option>
                                        <option value="13">Memorias</option>
                                        <option value="14">Narrativa</option>
                                        <option value="15">Novela gráfica</option>
                                        <option value="16">Novela negra</option>
                                        <option value="17">Novela romántica</option>
                                        <option value="18">Poesía</option>
                                        <option value="19">Política</option>
                                        <option value="20">Realismo mágico</option>
                                        <option value="21">Religión y espiritualidad</option>
                                        <option value="22">Sátira</option>
                                        <option value="23">Teatro</option>
                                        <option value="24">Thriller y suspense</option>
                                        <option value="25">Viajes y aventuras</option>
                                        <option value="26">Otro</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado del libro</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="">Seleccione el estado del libro *</option>
                                        <option value="nuevo">Nuevo</option>
                                        <option value="usado">Usado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnFase1">Siguiente</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-fase2" role="tabpanel" aria-labelledby="pills-fase2-tab">
                    <h1>Precio y envio</h1>
                    <form>
                        <div class="mb-3 col-sm-6">
                            <label for="precio" class="form-label">Precio</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precio" name="precio" required>
                                <span class="input-group-text">
                                    <i class="bi bi-currency-euro"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cambio" class="form-check-label">¿Acepta cambios?</label>
                            <input type="checkbox" class="form-check-input" id="cambio" name="cambio">
                        </div>
                        <div class="mb-3">
                            <label for="envio" class="form-check-label">¿Realizas envios?</label>
                            <input type="checkbox" class="form-check-input" id="envio" name="envio">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" id="btnRegresar">Regresar</button>
                        <button type="button" class="btn btn-primary" id="btnFase2">Siguiente</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-fase3" role="tabpanel" aria-labelledby="pills-fase3-tab">
                    <h1>Imagen del libro</h1>
                    <hr>
                    <form>
                        <div class="row">
                            <!-- Columna izquierda: Seleccionar archivo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Seleccione una imagen para la portada del libro</h5>
                                    <hr>
                                    <input class="form-control" type="file" id="imagen" name="imagen" required>
                                </div>
                            </div>
                            <!-- Columna derecha: Mostrar imagen seleccionada -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <!-- Añade este div para mostrar la previsualización -->
                                    <h5>Imagen del libro</h5>
                                    <hr>
                                    <img src="" id="imagenPrevia" alt="" style="max-width: 100%; max-height: 300px;">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="btnRegresar2">Regresar</button>
                        <button type="button" class="btn btn-primary" id="btnFase3">Siguiente</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-fase4" role="tabpanel" aria-labelledby="pills-fase4-tab">
                    <h1>Confirmación</h1>
                    <hr>
                    <div class="row">
                        <!-- Columna izquierda: Datos -->
                        <div class="col-md-6">
                            <h5>Información del libro</h5>
                            <ul>
                                <li><strong>Nombre del libro:</strong> <span id="confirmNombre"></span></li>
                                <li><strong>Autor:</strong> <span id="confirmAutor"></span></li>
                                <li><strong>ISBN:</strong> <span id="confirmISBN"></span></li>
                                <li><strong>Editorial:</strong> <span id="confirmEditorial"></span></li>
                                <li><strong>Género:</strong> <span id="confirmGenero"></span></li>
                                <li><strong>Estado del libro:</strong> <span id="confirmEstado"></span></li>
                                <li><strong>Precio:</strong> <span id="confirmPrecio"></span></li>
                                <li><strong>Acepta cambios:</strong> <span id="confirmCambio"></span></li>
                                <li><strong>Realiza envíos:</strong> <span id="confirmEnvio"></span></li>
                                <li><strong>Descripción:</strong> <span id="confirmDescripcion"></span></li>
                            </ul>
                        </div>
                        <!-- Columna derecha: Imagen del libro -->
                        <div class="col-md-6">
                            <h5>Imagen del libro</h5>
                            <div class="mb-3">
                                <img src="" class="img-fluid border border-dark border-3" id="confirmImagen" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 300px;">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form id="formularioCompleto" method="post" action="../includes/book_form.inc.php">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="envio" name="envio">
                            <label for="envio" class="form-check-label">Confirmo que toda la información es correcta</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="book_form.js"></script>
<?php require_once '../footer/footer_links.php' ?>