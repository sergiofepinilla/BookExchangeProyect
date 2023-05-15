<?php
require_once '../header/header.php';
require_once '../navbar/navbar.php';
include_once "../includes/dbh.inc.php";

// Definimos la página actual para cada pestaña
$pageComprados = isset($_GET['pageComprados']) ? (int)$_GET['pageComprados'] : 1;
$pageVendidos = isset($_GET['pageVendidos']) ? (int)$_GET['pageVendidos'] : 1;
$pageEnVenta = isset($_GET['pageEnVenta']) ? (int)$_GET['pageEnVenta'] : 1;
$perPage = 10; // Limitamos los resultados a 10 por página

// Calculamos el inicio para cada pestaña
$startComprados = ($pageComprados > 1) ? ($pageComprados * $perPage) - $perPage : 0;
$startVendidos = ($pageVendidos > 1) ? ($pageVendidos * $perPage) - $perPage : 0;
$startEnVenta = ($pageEnVenta > 1) ? ($pageEnVenta * $perPage) - $perPage : 0;

// Libros Comprados
$conn = Connection::getConnection();
$stmt = $conn->prepare("
    SELECT libros_vendidos.*, datos_usuario.nombre, generos.genero AS nombre_genero
    FROM libros_vendidos 
    JOIN datos_usuario ON libros_vendidos.id_usu_vendedor = datos_usuario.id_usuario 
    JOIN generos ON libros_vendidos.genero = generos.id 
    WHERE libros_vendidos.id_usu_comprador = ? 
    LIMIT ? OFFSET ?
");

$stmt->bind_param("iii", $userId, $perPage, $startComprados);
$stmt->execute();
$resultLibrosComprados = $stmt->get_result();

// Libros Comprados Count 
$stmtCountComprados = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM libros_vendidos 
    WHERE libros_vendidos.id_usu_comprador = ?
");

$stmtCountComprados->bind_param("i", $userId);
$stmtCountComprados->execute();
$resultCountComprados = $stmtCountComprados->get_result();
$totalComprados = $resultCountComprados->fetch_assoc()['total'];

$totalPagesComprados = ceil($totalComprados / $perPage);


// Libros Vendidos
$stmt = $conn->prepare("
    SELECT libros_vendidos.*, generos.genero, datos_usuario.nombre 
    FROM libros_vendidos 
    INNER JOIN generos ON libros_vendidos.genero = generos.id 
    INNER JOIN datos_usuario ON libros_vendidos.id_usu_vendedor = datos_usuario.id_usuario
    WHERE libros_vendidos.id_usu_vendedor = ?
    LIMIT ? OFFSET ?
");
$stmt->bind_param("iii", $userId, $perPage, $startVendidos);
$stmt->execute();
$resultLibrosVendidos = $stmt->get_result();

// Libros Vendidos Count
$stmtCountVendidos = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM libros_vendidos 
    WHERE libros_vendidos.id_usu_vendedor = ?
");
$stmtCountVendidos->bind_param("i", $userId);
$stmtCountVendidos->execute();
$resultCountVendidos = $stmtCountVendidos->get_result();
$totalVendidos = $resultCountVendidos->fetch_assoc()['total'];

$totalPagesVendidos = ceil($totalVendidos / $perPage);

// Libros En Venta
$stmtEnVenta = $conn->prepare("
    SELECT libros_venta.*, generos.genero 
    FROM libros_venta 
    INNER JOIN generos ON libros_venta.genero = generos.id 
    WHERE libros_venta.id_usuario = ?
    LIMIT ? OFFSET ?
");
$stmtEnVenta->bind_param("iii", $userId, $perPage, $startEnVenta);
$stmtEnVenta->execute();
$resultLibrosEnVenta = $stmtEnVenta->get_result();

//Libros en Venta Count
$stmtCountEnVenta = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM libros_venta 
    WHERE libros_venta.id_usuario = ?
");

$stmtCountEnVenta->bind_param("i", $userId);
$stmtCountEnVenta->execute();
$resultCountEnVenta = $stmtCountEnVenta->get_result();
$totalEnVenta = $resultCountEnVenta->fetch_assoc()['total'];

$totalPagesEnVenta = ceil($totalEnVenta / $perPage);
?>

<div class="container mb-5 mt-5">
  <h1>Historial de Transacciones</h1>
  <ul class="nav nav-tabs mt-5">
    <li class="nav-item">
      <a class="nav-link active" href="#comprados" data-bs-toggle="tab">Libros Comprados</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#vendidos" data-bs-toggle="tab">Libros Vendidos</a>
    <li class="nav-item">
      <a class="nav-link" href="#enventa" data-bs-toggle="tab">Libros en Venta</a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="comprados">
      <!-- Tabla de Libros Comprados -->
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Fecha de compra</th>
            <th scope="col">Valorar</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $resultLibrosComprados->fetch_assoc()) : ?>
            <tr>
              <td><?php echo htmlspecialchars($row['titulo']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td><?php echo htmlspecialchars($row['nombre']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
              <td>
                <?php if ($row['review'] == 0) : ?>
                  <button class="btn btn-primary valorar" data-rowid="<?php echo $row['id']; ?>" data-idlibro="<?php echo $row['id_libro_venta']; ?>" data-idusuvendedor="<?php echo $row['id_usu_vendedor']; ?>" data-idusucomprador="<?php echo $userId; ?>">
                    Valorar
                  </button>
                <?php else : ?>
                  <button class="btn btn-primary" disabled>
                    Valorar
                  </button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <!-- Tabla de Libros Comprados -->
      <table class="table table-striped mt-3">

        <!-- Paginación Libros Comprados -->
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php if ($pageComprados > 1) : ?>
              <li class="page-item">
                <a class="page-link" href="?pageComprados=<?php echo $pageComprados - 1; ?>">Anterior</a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link">Anterior</a>
              </li>
            <?php endif; ?>

            <?php if ($pageComprados < $totalPagesComprados) : ?>
              <li class="page-item">
                <a class="page-link" href="?pageComprados=<?php echo $pageComprados + 1; ?>">Siguiente</a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link">Siguiente</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- Paginación Libros Comprados -->
      </table>
    </div>

    <div class="tab-pane" id="vendidos">
      <!-- Tabla de Libros Vendidos -->
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Comprador</th>
            <th scope="col">Fecha de compra</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $resultLibrosVendidos->fetch_assoc()) : ?>
            <tr>
              <td><?php echo htmlspecialchars($row['titulo']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td><?php echo htmlspecialchars($row['nombre']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <!-- Tabla de Libros Vendidos -->
      <table class="table table-striped mt-3">

        <!-- Paginación Libros en Vendidos -->
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php if ($pageVendidos > 1) : ?>
              <li class="page-item">
                <a class="page-link" href="?pageVendidos=<?php echo $pageVendidos - 1; ?>">Anterior</a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link">Anterior</a>
              </li>
            <?php endif; ?>

            <?php if ($pageVendidos < $totalPagesVendidos) : ?>
              <li class="page-item">
                <a class="page-link" href="?pageVendidos=<?php echo $pageVendidos + 1; ?>">Siguiente</a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link">Siguiente</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- Paginación Libros en Vendidos -->
      </table>
    </div>

    <div class="tab-pane" id="enventa">
      <!-- Tabla Libros en Venta -->
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Editorial</th>
            <th scope="col">Género</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $resultLibrosEnVenta->fetch_assoc()) : ?>
            <tr>
              <td><?php echo htmlspecialchars($row['titulo']); ?></td>
              <td><?php echo htmlspecialchars($row['editorial']); ?></td>
              <td><?php echo htmlspecialchars($row['genero']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td>
                <button class="btn btn-primary retirar" data-id="<?php echo $row['id']; ?>">
                  Retirar Libro
                </button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <!-- Tabla Libros en Venta -->

      <!-- Paginación Libros en Venta -->
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($pageEnVenta > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?pageEnVenta=<?php echo $pageEnVenta - 1; ?>">Anterior</a>
            </li>
          <?php else : ?>
            <li class="page-item disabled">
              <a class="page-link">Anterior</a>
            </li>
          <?php endif; ?>

          <?php if ($pageEnVenta < $totalPagesEnVenta) : ?>
            <li class="page-item">
              <a class="page-link" href="?pageEnVenta=<?php echo $pageEnVenta + 1; ?>">Siguiente</a>
            </li>
          <?php else : ?>
            <li class="page-item disabled">
              <a class="page-link">Siguiente</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- Paginación Libros en Venta -->
      </table>
    </div>
  </div>

</div>

<!-- Modal Valoración -->
<div class="modal fade" id="modalValoracion" tabindex="-1" aria-labelledby="modalValoracionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalValoracionLabel">Valoración</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formValoracion">
        <div class="modal-body">
          <input type="hidden" id="idLibroValorar" name="idLibro">
          <input type="hidden" id="rowId" value="">
          <input type="hidden" id="idUsuarioVendedor" name="idUsuarioVendedor">
          <input type="hidden" id="idUsuarioComprador" name="idUsuarioComprador">

          <div class="form-group">
            <label for="rating">Puntuación</label>
            <select id="rating" name="rating" autocomplete="off">
              <option value="">Selecciona una puntuación</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea id="comentario" name="comentario" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Enviar valoración</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Valoración -->


<?php require_once '../footer/upper_footer.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
<script src="purchease_history.js"></script>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>