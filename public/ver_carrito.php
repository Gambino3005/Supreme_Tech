<?php
session_start();
include '../includes/config.php';

$usuario_id = $_SESSION['user_id'] ?? null;

if (!$usuario_id) {
    header("Location: login.php");
    exit();
    
    //echo "<div class='alert alert-danger text-center'>Debe iniciar sesión para ver su carrito.</div>";
    exit;
}

// Consulta para obtener productos en el carrito del usuario
$query = "SELECT c.id AS carrito_id, p.id, p.nombre, p.precio, p.imagen, c.cantidad 
          FROM carrito c 
          JOIN productos p ON c.producto_id = p.id
          WHERE c.usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$carrito = [];
$total = 0;

while ($row = $result->fetch_assoc()) {
    $subtotal = $row['precio'] * $row['cantidad'];
    $total += $subtotal;
    $carrito[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>

<style>
    .navbar {
        background-color: #353f4a !important;
        padding: 1rem 0;
    }
    .navbar .navbar-brand {
        font-size: 2.5rem;
    }
    .navbar-brand, .nav-link {
        color: white !important;
        font-size: 1.2rem;
    }
    .card {
        transition: transform 0.3s;
    }
    .card:hover {
        transform: scale(1.05);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Supreme Tech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li> -->
                <li class="nav-item"><a class="nav-link" href="computadoras.php">Computadores</a></li>
                    <li class="nav-item"><a class="nav-link" href="celulares.php">Celulares</a></li>
                    <li class="nav-item"><a class="nav-link" href="electronica.php">Electrónica</a></li>
                    <li class="nav-item"><a class="nav-link" href="ver_pedidos.php">Mis Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="my-4">Carrito de Compras</h2>
    
    <?php if (empty($carrito)): ?>
        <p class="text-center text-danger">No hay productos en el carrito.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $item): ?>
                    <tr>
                        <td>
                            <img src="<?= $item['imagen'] ?>" alt="<?= $item['nombre'] ?>" width="80"> 
                            <?= $item['nombre'] ?>
                        </td>
                        <td>$<?= number_format($item['precio'], 2) ?></td>
                        <td>
                            <form action="actualizar_carrito.php" method="POST">
                                <input type="hidden" name="carrito_id" value="<?= $item['carrito_id'] ?>">
                                <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" class="form-control w-50">
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Actualizar</button>
                            </form>
                        </td>
                        <td>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
                        <td>
                            <form action="eliminar_carrito.php" method="POST">
                                <input type="hidden" name="carrito_id" value="<?= $item['carrito_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end">
            <p class="fw-bold">Total: $<?= number_format($total, 2) ?></p>
            <a href="confirmar_compra.php" class="btn btn-success">Finalizar Compra</a>
        </div>
    <?php endif; ?>

    <!-- <div class="text mt-4" style=" margin-bottom: 20px; margin-top: 20px;">
                <a href="ver_pedidos.php" class="btn btn-secondary">Ver mis pedidos</a>
    </div> -->

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>