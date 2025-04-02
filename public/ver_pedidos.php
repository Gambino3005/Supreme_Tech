<?php
session_start();
include '../includes/config.php';

$usuario_id = $_SESSION['user_id'] ?? null;

if (!$usuario_id) {
    header("Location: login.php");
    exit();
}

// Obtener los pedidos del usuario
$sql = "SELECT p.id, p.fecha, p.total, p.estado 
        FROM pedidos p 
        WHERE p.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body 
        { 
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

        .container 
        { max-width: 1000px; margin-top: 30px; 
        }
        .card 
        { 
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
    <h2 class="my-4">Mis Pedidos</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID del Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $pedido['id']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($pedido['fecha'])); ?></td>
                        <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                        <td><?php echo ucfirst($pedido['estado']); ?></td>
                         <td>
                            <a href="ver_detalles_pedido.php?pedido_id=<?php echo $pedido['id']; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-danger">No tienes pedidos realizados.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>