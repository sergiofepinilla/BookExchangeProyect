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
    WHERE libros_vendidos.id_usu_comprador = ? AND libros_vendidos.review = 0
    LIMIT ? OFFSET ?
");
$stmt->bind_param("iii", $userId, $perPage, $startComprados);
$stmt->execute();
$resultLibrosComprados = $stmt->get_result();

// Para Libros Comprados Count
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
$stmt->bind_param("iii", $userId, $perPage, $startEnVenta);
$stmt->execute();
$resultLibrosEnVenta = $stmt->get_result();

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
        <!-- Código de la tabla de libros comprados -->
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
        <?php while($row = $resultLibrosComprados->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
                <td>
                    <button class="btn btn-primary" onclick="location.href='valorar.php?id=<?php echo $row['id']; ?>'">
                        Valorar
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Código de la tabla de libros comprados -->
    <hr>
    <table class="table table-striped mt-3">
      <!-- Resto del código de la tabla de libros comprados -->
      <!-- Código de la paginación -->
      <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($pageComprados > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?pageComprados=<?php echo $pageComprados-1; ?>">Anterior</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Anterior</a>
        </li>
    <?php endif; ?>

    <?php if ($pageComprados < $totalPagesComprados): ?>
        <li class="page-item">
            <a class="page-link" href="?pageComprados=<?php echo $pageComprados+1; ?>">Siguiente</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Siguiente</a>
        </li>
    <?php endif; ?>
  </ul>
</nav>
    </table>
  </div>

  <div class="tab-pane" id="vendidos">
        <!-- Código de la tabla de libros vendidos -->
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
        <?php while($row = $resultLibrosVendidos->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
                <td>
                    <button class="btn btn-primary" onclick="location.href='valorar.php?id=<?php echo $row['id']; ?>'">
                        Valorar
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Código de la tabla de libros vendidos -->
    <hr>
    <table class="table table-striped mt-3">
      <!-- Resto del código de la tabla de libros vendidos -->
      <!-- Código de la paginación -->
      <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($pageVendidos > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?pageVendidos=<?php echo $pageVendidos-1; ?>">Anterior</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Anterior</a>
        </li>
    <?php endif; ?>

    <?php if ($pageVendidos < $totalPagesVendidos): ?>
        <li class="page-item">
            <a class="page-link" href="?pageVendidos=<?php echo $pageVendidos+1; ?>">Siguiente</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Siguiente</a>
        </li>
    <?php endif; ?>
  </ul>
</nav>
    </table>
  </div>

  <div class="tab-pane" id="enventa">
    <!-- Código de la tabla de libros en venta -->
    <hr>
    <table class="table table-striped mt-3">
      <!-- Resto del código de la tabla de libros en venta -->
      <!-- Código de la paginación -->
      <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if ($pageEnVenta > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?pageEnVenta=<?php echo $pageEnVenta-1; ?>">Anterior</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Anterior</a>
        </li>
    <?php endif; ?>

    <?php if ($pageEnVenta < $totalPagesEnVenta): ?>
        <li class="page-item">
            <a class="page-link" href="?pageEnVenta=<?php echo $pageEnVenta+1; ?>">Siguiente</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">Siguiente</a>
        </li>
    <?php endif; ?>
  </ul>
</nav>
    </table>
  </div>
</div>

</div>
<script>
$(function() {
  // Al cargar la página, comprueba si hay un tab guardado en la localStorage
  let activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    // Si hay un tab guardado, actívalo
    $('.nav-link[href="' + activeTab + '"]').tab('show');
  }

  // Cuando cambies de tab, guarda el nuevo tab en la localStorage
  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
});
</script>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>
