<?php
session_start();
include '../includes/config.php';

$usuario_id = $_SESSION['user_id'] ?? null;

if (!$usuario_id) {
    header("Location: login.php");
    exit();
}

// Obtener productos del carrito
$sql = "SELECT c.producto_id, c.cantidad, p.nombre, p.precio 
        FROM carrito c 
        JOIN productos p ON c.producto_id = p.id 
        WHERE c.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$productos = [];

while ($row = $result->fetch_assoc()) {
    $subtotal = $row['precio'] * $row['cantidad'];
    $total += $subtotal;
    $productos[] = $row;
}

// Si el carrito está vacío, redirigir al carrito
if (count($productos) === 0) {
    $_SESSION['error'] = "Tu carrito está vacío.";
    header("Location: ver_carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; }
        .navbar {
            background-color: #353f4a !important;
            padding: 0rem 0;
        }
        .navbar .navbar-brand {
            font-size: 2.5rem;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-size: 1.2rem;
        }
        /* .navbar { background-color: #353f4a !important; font-size: 1.2rem;  }
        .navbar .navbar-brand { font-size: 2.0rem; }
        .navbar-brand, .nav-link { color: white !important; } */
        .container { max-width: 1000px; margin-top: 30px; }
        .card { border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .btn-primary { background-color: #28a745; border: none; }
        .btn-primary:hover { background-color: #218838; }
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
        <div class="card p-4">
            <h2 class="text-center mb-4">Confirmar Compra</h2>
            <form action="procesar_pago.php" method="POST">
                <h5>Detalles de Facturación</h5>
                <div class="mb-3">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="correo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" required>
                </div>

                <h5>Método de Pago</h5>
                <div class="mb-3">
                    <select class="form-select" name="metodo_pago" id="metodo_pago" required>
                        <option value="">Seleccione un método</option>
                        <option value="1">Tarjeta de Crédito/Débito</option>
                        <option value="2">PayPal</option>
                    </select>
                </div>

                <div id="tarjeta_info" class="mb-3" style="display: none;">
                    <label class="form-label">Número de Tarjeta</label>
                    <input type="text" class="form-control" name="numero_tarjeta" pattern="\d{16}" maxlength="16" placeholder="Ingrese el número de tarjeta (16 dígitos)">
                </div>

                

                <div id="paypal_info" class="mb-3" style="display: none;">
                    <label class="form-label">Correo de PayPal</label>
                    <input type="email" class="form-control" name="correo_paypal" placeholder="Ingrese su correo de PayPal">
                </div>

                <h5>Resumen de la Compra</h5>
                <ul class="list-group mb-3">
                    <?php foreach ($productos as $producto) : ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($producto['nombre']) ?> 
                            <span class="float-end">$<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item fw-bold">Total <span class="float-end">$<?= number_format($total, 2) ?></span></li>
                </ul>
                
                <button type="submit" class="btn btn-primary w-100">Confirmar Pago</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('metodo_pago').addEventListener('change', function() {
            var tarjetaInfo = document.getElementById('tarjeta_info');
            var paypalInfo = document.getElementById('paypal_info');

            tarjetaInfo.style.display = 'none';
            paypalInfo.style.display = 'none';

            if (this.value == '1') {
                tarjetaInfo.style.display = 'block'; // Mostrar información de tarjeta
            } else if (this.value == '2') {
                paypalInfo.style.display = 'block'; // Mostrar información de PayPal
            }
        });
    </script>
    
</body>
</html>