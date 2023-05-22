<?php require_once "../header/header.php"; ?>
<?php require_once "../navbar/navbar.php"; ?>
<?php
if (!isset($_SESSION["user"]) || $userType != 2) {
    echo '<img src="../assets/img/403.png" alt="forbidden" class="bg-danger w-100">';
    include_once "../footer/footer.php";
    exit();
}
include_once "../includes/dbh.inc.php";
?>

<div class="container">
    <div class="col m-3 ">
        <!-- TABLA PRODUCTOS-->
        <table class="table table-bordered border-danger">
            <thead class="bg bg-danger border border-dark">
                <tr>
                    <?php if ($_GET["admin"] == "users") { ?>
                        <th>idUsuario</th>
                        <th>Apodo</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    <?php } elseif ($_GET["admin"] == "products") { ?>
                        <th>Producto ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <!-- TABLA USUARIOS -->
                <?php if ($_GET["admin"] == "users") {

                    $query = "SELECT US.id as id, US.apodo as apodo,
                        US.correo as correo
                        FROM usuarios US
                        WHERE us.tipo != 2;";
                    $conn = Connection::getConnection();
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["apodo"]; ?></td>
                            <td><?php echo $row["correo"]; ?></td>
                            <td>
                                <a href="../includes/deleteUser.inc.php?id=<?php echo $row[
                                    "id"
                                ]; ?>">
                                    <i class="bi bi-trash btn btn-danger border border-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    <?php
                } elseif ($_GET["admin"] == "products") {
                    $query = "SELECT * FROM libros_venta";
                    $conn = Connection::getConnection();
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <?php if (isset($_GET["pId"])) {
                                if ($_GET["pId"] == $row["id"]) { ?>
                                    <form action="../includes/updateProduct.inc.php" method="POST">
                                        <td>
                                            <input type="number" name="pQuantity" value="<?php echo $row[
                                                "cantidad"
                                            ]; ?>">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" name="pPrice" value="<?php echo $row[
                                                "precio"
                                            ]; ?>" autofocus>
                                            <input type="number" name="id" value="<?php echo $row[
                                                "id"
                                            ]; ?>" class="d-none">
                                        </td>
                                        <td>
                                            <a href="../includes/deleteProduct.inc.php?id=<?php echo $row[
                                                "id"
                                            ]; ?>">
                                                <i class="bi bi-trash btn btn-danger border border-danger"></i>
                                            </a>
                                        </td>
                                    </form>


                                <?php } else { ?>
                                    <td><?php echo $row["cantidad"]; ?></td>
                                    <td><?php echo $row["precio"]; ?></td>
                                    <td>
                                        <a href="../includes/deleteProduct.inc.php?id=<?php echo $row[
                                            "id"
                                        ]; ?>">
                                            <i class="bi bi-trash btn btn-danger border border-danger"></i>
                                        </a>
                                        <a href="admin.php?admin=products&pId=<?php echo $row[
                                            "id"
                                        ]; ?>">
                                            <i class="bi bi-pencil btn btn-success border border-danger"></i>
                                        </a>

                                    </td>
                                <?php }
                            } else {
                                 ?>
                                <td><?php echo $row["cantidad"]; ?></td>
                                <td><?php echo $row["precio"]; ?></td>
                                <td>
                                    <a href="../includes/deleteProduct.inc.php?id=<?php echo $row[
                                        "id"
                                    ]; ?>">
                                        <i class="bi bi-trash btn btn-danger border border-danger"></i>
                                    </a>
                                    <a href="admin.php?admin=products&pId=<?php echo $row[
                                        "id"
                                    ]; ?>">
                                        <i class="bi bi-pencil btn btn-success border border-danger"></i>
                                    </a>
                                </td>
                            <?php
                            } ?>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "../footer/upper_footer.php"; ?>
<script src="../navbar/navbar.js"></script>
<?php require_once "../footer/footer_links.php"; ?>
