<?php
require_once '../header/header.php';
require_once '../navbar/navbar.php';

if (!isset($_SESSION['user'])) {
  echo
  '<img src="../assets/img/403.png" alt="forbidden" class="bg-danger w-100">';
  require_once "../footer/upper_footer.php";
  echo '<script src="../navbar/navbar.js"></script>';
  require_once "../footer/footer_links.php";
  exit();
}

include_once "../includes/dbh.inc.php";

// Pagina Actual de Cada Pestaña
$pageComprados = isset($_GET['pageComprados']) ? (int)$_GET['pageComprados'] : 1;
$pageVendidos = isset($_GET['pageVendidos']) ? (int)$_GET['pageVendidos'] : 1;
$pageEnVenta = isset($_GET['pageEnVenta']) ? (int)$_GET['pageEnVenta'] : 1;
$perPage = 10; // 10 Resultados por Página

// Inicio de Cada Pestaña
$startComprados = ($pageComprados > 1) ? ($pageComprados * $perPage) - $perPage : 0;
$startVendidos = ($pageVendidos > 1) ? ($pageVendidos * $perPage) - $perPage : 0;
$startEnVenta = ($pageEnVenta > 1) ? ($pageEnVenta * $perPage) - $perPage : 0;

// Libros Comprados
$conn = Connection::getConnection();
$stmt = $conn->prepare("
    SELECT libros_vendidos.*, usuarios.apodo, usuarios.id as id_usuario, generos.nombre_genero AS nombre_genero
    FROM libros_vendidos 
    JOIN usuarios ON libros_vendidos.id_usu_vendedor = usuarios.id
    JOIN generos ON libros_vendidos.genero = generos.id_genero 
    WHERE libros_vendidos.id_usu_comprador = ? 
    ORDER BY libros_vendidos.id DESC
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
SELECT libros_vendidos.*, generos.nombre_genero, usuarios.id as id_usuario, usuarios.apodo, 
COALESCE((SELECT apodo FROM usuarios WHERE id = libros_vendidos.id_usu_comprador), 'desconocido') as apodo_comprador
FROM libros_vendidos 
INNER JOIN generos ON libros_vendidos.genero = generos.id_Genero 
INNER JOIN usuarios ON libros_vendidos.id_usu_vendedor = usuarios.id
WHERE libros_vendidos.id_usu_vendedor = ?
ORDER BY libros_vendidos.id DESC
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
    SELECT libros_venta.*, generos.nombre_genero 
    FROM libros_venta 
    INNER JOIN generos ON libros_venta.genero = generos.id_genero 
    WHERE libros_venta.id_usuario = ?
    ORDER BY libros_venta.id DESC
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

  <!-- Tabla de Libros Comprados -->
  <div class="tab-content">
    <div class="tab-pane active" id="comprados">
      <table class="table  mt-3 dark-theme custom-text ">
        <thead class="custom-card-border">
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Fecha de compra</th>
            <th scope="col">Valorar</th>
          </tr>
        </thead>
        <tbody class="inf-nav custom-card-border">
          <?php while ($row = $resultLibrosComprados->fetch_assoc()) : ?>
            <tr>
              <td><?php echo htmlspecialchars($row['titulo']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td><a class="custom-h-link" href="../profile/profile.php?id=<?php echo $row['id_usuario']; ?>"><?php echo htmlspecialchars($row['apodo']); ?></a></td>
              <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
              <td>
                <?php if ($row['review'] == 0) : ?>
                  <button class="btn accent valorar custom-text" data-rowid="<?php echo $row['id']; ?>" data-idlibro="<?php echo $row['id_libro_venta']; ?>" data-idusuvendedor="<?php echo $row['id_usu_vendedor']; ?>" data-idusucomprador="<?php echo $userId; ?>">
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
          <span class="pagination-item  d-inline-block p-2  align-middle custom-text">Página <?php echo $pageComprados; ?> de <?php echo $totalPagesComprados; ?></span>
        </ul>
      </nav>
    </div>
    <!-- Paginación Libros Comprados -->

    <!-- Tabla de Libros Vendidos -->
    <div class="tab-pane" id="vendidos">
      <table class="table mt-3 dark-theme custom-text">
        <thead class="custom-card-border">
          <tr>
            <th scope=" col">Título</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Comprador</th>
            <th scope="col">Fecha de compra</th>
          </tr>
        </thead>
        <tbody class="inf-nav custom-card-border">
          <?php while ($row = $resultLibrosVendidos->fetch_assoc()) : ?>
            <tr>
              <td><?php echo htmlspecialchars($row['titulo']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td><a class="custom-h-link" href="../profile/profile.php?id=<?php echo $row['id_usu_comprador']; ?>"><?php echo htmlspecialchars($row['apodo_comprador']); ?></a></td>
              <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <!-- Tabla de Libros Vendidos FIN-->

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
            <span class="pagination-item  d-inline-block p-2  align-middle">Página <?php echo $pageVendidos; ?> de <?php echo $totalPagesVendidos; ?></span>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
    <!-- Paginación Libros en Vendidos -->

    <!-- Tabla Libros en Venta -->
    <div class="tab-pane" id="enventa">
      <table class="table mt-3 dark-theme custom-text">
        <thead class="custom-card-border">
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Editorial</th>
            <th scope="col">Género</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody class="inf-nav custom-card-border">
          <?php while ($row = $resultLibrosEnVenta->fetch_assoc()) : ?>
            <tr>
              <td><a class="custom-h-link" href="../product/product.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['titulo']); ?></a></td>
              <td><?php echo htmlspecialchars($row['editorial']); ?></td>
              <td><?php echo htmlspecialchars($row['nombre_genero']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['precio']); ?></td>
              <td>
                <button class="btn accent custom-text retirar" data-id="<?php echo $row['id']; ?>">
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
            <span class="pagination-item  d-inline-block p-2  align-middle">Página <?php echo $pageEnVenta; ?> de <?php echo $totalPagesEnVenta; ?></span>
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-black text-white">
        <h5 class="modal-title" id="modalValoracionLabel">Valoración</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formValoracion">
        <div class="modal-body">
          <input type="hidden" id="idLibroValorar" name="idLibro">
          <input type="hidden" id="rowId" value="">
          <input type="hidden" id="idUsuarioVendedor" name="idUsuarioVendedor">
          <input type="hidden" id="idUsuarioComprador" name="idUsuarioComprador">

          <div class="form-group mb-3">
            <label for="rating" class="mb-2">Puntuación</label>
            <select id="rating" name="rating" class="form-select">
              <option value="">Selecciona una puntuación</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comentario" class="mb-2">Comentario</label>
            <textarea id="comentario" name="comentario" class="form-control" rows="3" placeholder="Escriba aqui su comentario sobre la venta o el vendedor, o dejelo vacío."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Enviar valoración</button>
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