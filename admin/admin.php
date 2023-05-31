<?php
require_once '../header/header.php';
require_once '../navbar/navbar.php';

if (!isset($_SESSION['user']) || $userType !== 2) {
    echo '<script>window.location.href = "../home/home.php";</script>';
    echo '<img src="../assets/img/403.png" alt="forbidden" class="dark-theme w-100">';
    require_once "../footer/upper_footer.php";
    echo '<script src="../navbar/navbar.js"></script>';
    require_once "../footer/footer_links.php";
    exit();
}

include_once "../includes/dbh.inc.php";

// Página Actual de Pestañas
$pageUsuarios = isset($_GET['pageUsuarios']) ? (int)$_GET['pageUsuarios'] : 1;
$pageVendidos = isset($_GET['pageVendidos']) ? (int)$_GET['pageVendidos'] : 1;
$pageEnVenta = isset($_GET['pageEnVenta']) ? (int)$_GET['pageEnVenta'] : 1;
$perPage = 10; // Limitamos los resultados a 10 por página

// Inicio de Pestañas
$startComprados = ($pageUsuarios > 1) ? ($pageUsuarios * $perPage) - $perPage : 0;
$startVendidos = ($pageVendidos > 1) ? ($pageVendidos * $perPage) - $perPage : 0;
$startEnVenta = ($pageEnVenta > 1) ? ($pageEnVenta * $perPage) - $perPage : 0;

// Usuarios
$conn = Connection::getConnection();
$stmt = $conn->prepare("
     SELECT usuarios.*, datos_usuario.*
    FROM usuarios
    JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario
    WHERE tipo != 2
    ORDER BY id DESC
    LIMIT ? OFFSET ?
    ");

$stmt->bind_param("ii", $perPage, $startComprados);
$stmt->execute();
$resultLibrosComprados = $stmt->get_result();

// Usuarios Count 
$stmtCountComprados = $conn->prepare("
        SELECT COUNT(*) as total 
        FROM usuarios 
        WHERE tipo != 2;
    ");

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
    ORDER BY libros_vendidos.id DESC
    LIMIT ? OFFSET ?
    ");
$stmt->bind_param("ii", $perPage, $startVendidos);
$stmt->execute();
$resultLibrosVendidos = $stmt->get_result();

// Libros Vendidos Count
$stmtCountVendidos = $conn->prepare("
        SELECT COUNT(*) as total 
        FROM libros_vendidos 
    ");
$stmtCountVendidos->execute();
$resultCountVendidos = $stmtCountVendidos->get_result();
$totalVendidos = $resultCountVendidos->fetch_assoc()['total'];

$totalPagesVendidos = ceil($totalVendidos / $perPage);

// Libros En Venta
$stmtEnVenta = $conn->prepare("
        SELECT libros_venta.*, generos.nombre_genero 
        FROM libros_venta 
        INNER JOIN generos ON libros_venta.genero = generos.id_genero 
        ORDER BY libros_venta.id DESC
        LIMIT ? OFFSET ?
    ");
$stmtEnVenta->bind_param("ii", $perPage, $startEnVenta);
$stmtEnVenta->execute();
$resultLibrosEnVenta = $stmtEnVenta->get_result();

//Libros en Venta Count
$stmtCountEnVenta = $conn->prepare("
        SELECT COUNT(*) as total 
        FROM libros_venta 
    ");

$stmtCountEnVenta->execute();
$resultCountEnVenta = $stmtCountEnVenta->get_result();
$totalEnVenta = $resultCountEnVenta->fetch_assoc()['total'];

$totalPagesEnVenta = ceil($totalEnVenta / $perPage);
?>
<div class="container mb-5 mt-5">
    <h1>Gestionar Usuarios y Libros</h1>
    <ul class="nav nav-tabs mt-5">
        <li class="nav-item">
            <a class="nav-link active" href="#comprados" data-bs-toggle="tab">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendidos" data-bs-toggle="tab">Libros Vendidos</a>
        <li class="nav-item">
            <a class="nav-link" href="#enventa" data-bs-toggle="tab">Libros en Venta</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="comprados">
            <!-- Tabla de Usuarios -->
            <table class="table mt-3 dark-theme custom-text">
                <thead class="custom-card-border">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apodo</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="inf-nav custom-card-border">
                    <?php while ($row = $resultLibrosComprados->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><a class="custom-h-link" href="../profile/profile.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['apodo']); ?></td>
                            <td><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td>
                                <i class="bi bi-trash-fill delete-user text-danger ms-2 me-3" data-id="<?php echo $row['id']; ?>" style="cursor:pointer;"></i>
                                <i class="bi bi-lock-fill block-user text-warning " data-id="<?php echo $row['id']; ?>" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- Tabla de Usuarios -->
            <!-- Paginación Usuarios -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($pageUsuarios > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pageUsuarios=<?php echo $pageUsuarios - 1; ?>">Anterior</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item disabled">
                            <a class="page-link">Anterior</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($pageUsuarios < $totalPagesComprados) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pageUsuarios=<?php echo $pageUsuarios + 1; ?>">Siguiente</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item disabled">
                            <a class="page-link">Siguiente</a>
                        </li>
                    <?php endif; ?>
                    <span class="pagination-item custom-text d-inline-block p-2  align-middle">Página <?php echo $pageUsuarios; ?> de <?php echo $totalPagesComprados; ?></span>
                </ul>
            </nav>
            <!-- Paginación Usuarios -->
        </div>
        <div class="tab-pane" id="vendidos">
            <!-- Tabla de Libros Vendidos -->
            <table class="table mt-3 dark-theme custom-text">
                <thead class="custom-card-border">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Género</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Comprador</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Fecha de compra</th>
                    </tr>
                </thead>
                <tbody class="inf-nav custom-card-border">
                    <?php while ($row = $resultLibrosVendidos->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($row['autor']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_genero']); ?></td>
                            <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                            <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio']); ?></td>
                            <td><a class="custom-h-link" href="../profile/profile.php?id=<?php echo $row['id_usu_comprador']; ?>"><?php echo htmlspecialchars($row['apodo_comprador']); ?></a></td>
                            <td><a class="custom-h-link" href="../profile/profile.php?id=<?php echo $row['id_usu_vendedor']; ?>"><?php echo htmlspecialchars($row['apodo']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- Tabla de Libros Vendidos -->
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
                        <span class="pagination-item custom-text d-inline-block p-2  align-middle">Página <?php echo $pageVendidos; ?> de <?php echo $totalPagesVendidos; ?></span>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- Paginación Libros en Vendidos -->
        </div>
        <div class="tab-pane" id="enventa">
            <!-- Tabla Libros en Venta -->
            <table class="table mt-3 dark-theme custom-text">
                <thead class="custom-card-border">
                    <tr>
                        <th scope="col">Id</th>
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
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><a class="custom-h-link" href="../product/product.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['titulo']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_genero']); ?></td>
                            <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio']); ?></td>
                            <td>
                                <button class="btn custom-text accent retirar" data-id="<?php echo $row['id']; ?>">
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
                        <span class="pagination-item custom-text d-inline-block p-2  align-middle">Página <?php echo $pageEnVenta; ?> de <?php echo $totalPagesEnVenta; ?></span>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- Paginación Libros en Venta -->
        </div>
    </div>
</div>
<?php require_once '../footer/upper_footer.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
<script src="admin.js"></script>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>