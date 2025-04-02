<?php
session_start();
include '../includes/config.php';

if (!isset($_GET['pedido_id'])) {
    $_SESSION['error'] = "No se encontró la información del pedido.";
    header("Location: ver_pedidos.php");
    exit();
}

$pedido_id = (int) $_GET['pedido_id'];
$usuario_id = $_SESSION['user_id'] ?? null;

if (!$usuario_id) {
    header("Location: login.php");
    exit();
}

// Obtener datos del pedido
$sql = "SELECT p.id, p.total, p.estado, u.nombre AS nombre_usuario, p.correo, p.direccion, mp.nombre AS metodo_pago 
        FROM pedidos p 
        JOIN metodos_pago mp ON p.metodo_pago_id = mp.id 
        JOIN usuarios u ON p.usuario_id = u.id 
        WHERE p.id = ? AND p.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $pedido_id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$pedido = $result->fetch_assoc();

if (!$pedido) {
    $_SESSION['error'] = "No se encontró el pedido.";
    header("Location: ver_pedidos.php");
    exit();
}

// Obtener detalles de los productos comprados
$sql = "SELECT d.producto_id, d.cantidad, d.precio_unitario, pr.nombre, pr.imagen 
        FROM detalle_pedido d
        JOIN productos pr ON d.producto_id = pr.id
        WHERE d.pedido_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$productos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #353f4a !important;
            padding: 1rem 0;
        }
        .navbar .navbar-brand {
            font-size: 2.3rem;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-size: 1.2rem;
        }
        .container {
            max-width: 800px;
            margin-top: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Supreme Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item" active><a class="nav-link" href="index.php">Inicio</a></li> -->
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
    <div class="card p-4">
        <h2 class="text-center mb-4">Detalles del Pedido</h2>
        <p>Gracias por tu compra, <strong><?php echo htmlspecialchars($pedido['nombre_usuario']); ?></strong>.</p>

        <h5>Datos del Pedido</h5>
        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Número de Pedido:</strong> <?php echo $pedido['id']; ?></li>
            <li class="list-group-item"><strong>Estado:</strong> <?php echo ucfirst($pedido['estado']); ?></li>
            <li class="list-group-item"><strong>Total Pagado:</strong> $<?php echo number_format($pedido['total'], 2); ?></li>
            <li class="list-group-item"><strong>Método de Pago:</strong> <?php echo htmlspecialchars($pedido['metodo_pago']); ?></li>
            <li class="list-group-item"><strong>Enviado a:</strong> <?php echo htmlspecialchars($pedido['direccion']); ?></li>
        </ul>

        <h5>Productos Comprados</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td>
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Producto" width="50"> 
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>$<?php echo number_format($producto['precio_unitario'], 2); ?></td>
                    <td>$<?php echo number_format($producto['cantidad'] * $producto['precio_unitario'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="ver_pedidos.php" class="btn btn-secondary">Volver a Mis Pedidos</a>
            <a href="index.php" class="btn btn-primary">Volver a la Tienda</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>