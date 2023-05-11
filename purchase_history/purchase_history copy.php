<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<?php
include_once "../includes/dbh.inc.php";
// Libros Comprados
$conn = Connection::getConnection();
$stmt = $conn->prepare("
    SELECT libros_vendidos.*, datos_usuario.nombre, generos.genero AS nombre_genero
    FROM libros_vendidos 
    JOIN datos_usuario ON libros_vendidos.id_usu_vendedor = datos_usuario.id_usuario 
    JOIN generos ON libros_vendidos.genero = generos.id 
    WHERE libros_vendidos.id_usu_comprador = ? AND libros_vendidos.review = 0
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultLibrosComprados = $stmt->get_result();

// Libros Vendidos
$stmt = $conn->prepare("
    SELECT libros_vendidos.*, generos.genero, datos_usuario.nombre 
    FROM libros_vendidos 
    INNER JOIN generos ON libros_vendidos.genero = generos.id 
    INNER JOIN datos_usuario ON libros_vendidos.id_usu_vendedor = datos_usuario.id_usuario
    WHERE libros_vendidos.id_usu_vendidos = ?
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultLibrosVendidos = $stmt->get_result();



?>


<div class="container mb-5 mt-5">
    <h1>Historial de Compras</h1>
    <hr>
<table class="table table-striped mt-3">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">ISBN</th>
                <th scope="col">Autor</th>
                <th scope="col">Género</th>
                <th scope="col">Editorial</th>
                <th scope="col">Estado</th>
                <th scope="col">Precio</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Valorar</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $resultLibrosComprados->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                <td><?php echo htmlspecialchars($row['autor']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre_genero']); ?></td>
                <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td>
                    <button class="btn btn-primary" onclick="location.href='valorar.php?id=<?php echo $row['id']; ?>'">
                        Valorar
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>