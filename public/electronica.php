<?php
session_start();
include '../includes/config.php';

// Obtener la cantidad de productos en el carrito desde la base de datos
$usuario_id = $_SESSION['user_id'] ?? null;
$carrito_count = 0;

if ($usuario_id) {
    $sql = "SELECT COUNT(*) as total FROM carrito WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $carrito_count = $row['total'];
}

$sql = "SELECT * FROM productos where categoria_id = 3 or categoria_id = 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supreme Tech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        .card-img-top {
            width: 100%; /* Hace que la imagen ocupe todo el ancho disponible */
            /*height:;  Altura fija para todas las imágenes */
            object-fit: cover; /* Ajusta la imagen para que llene el espacio sin deformarse */
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }
        .cart-icon {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" >
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
                    <li class="nav-item">
    <a class="nav-link cart-icon" href="ver_carrito.php">
        Carrito 🛒
        <span class="cart-count" style="display: <?= $carrito_count > 0 ? 'inline' : 'none' ?>;">
            <?= $carrito_count > 0 ? $carrito_count : '0' ?>
        </span>
    </a>
</li>
                    <li class="nav-item"><a class="nav-link" href="ver_pedidos.php">Mis Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Electronica y accesorios</h2>
        <div class="row">
            <?php while ($producto = $result->fetch_assoc()) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../assets/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                            <p><strong>$<?php echo number_format($producto['precio'], 2); ?></strong></p>
                            <form action="agregar_carrito.php" method="POST" class="add-to-cart-form">
                                <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                <input type="number" name="cantidad" class="form-control mb-2" value="1" min="1">
                                <button type="submit" class="btn btn-primary w-100">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer class="footer mt-5 py-4  text-white">
    <div class="container">
        <div class="row">
            <!-- Sección de contacto -->
            <div class="col-md-4" style="text-align: left;">
                <h5>Contacto</h5>
                <p><i class="bi bi-envelope"></i> support@supremetech.com</p>
                <p><i class="bi bi-telephone"></i> +1 800 555 1234</p>
                <p><i class="bi bi-geo-alt"></i> 123 Tech Street, Santo Domingo, Rep. Dom.</p>
            </div>

            <!-- Sección de enlaces útiles -->
            <div class="col-md-4">
                <h5>Enlaces útiles</h5>
                <ul class="list-unstyled">
                    <li><a href="politica_privacidad.php" class="text-white">Política de Privacidad</a></li>
                    <li><a href="terminos.php" class="text-white">Términos y Condiciones</a></li>
                    <li><a href="preguntas_frecuentes.php" class="text-white">Preguntas Frecuentes</a></li>
                    <li><a href="contacto.php" class="text-white">Contáctanos</a></li>
                </ul>
            </div>

            <!-- Sección de redes sociales -->
            <div class="col-md-4 text-center">
                <h5>Síguenos</h5>
                <a href="https://facebook.com" class="text-white mx-2"><i class="bi bi-facebook fs-3"></i></a>
                <a href="https://twitter.com" class="text-white mx-2"><i class="bi bi-twitter fs-3"></i></a>
                <a href="https://instagram.com" class="text-white mx-2"><i class="bi bi-instagram fs-3"></i></a>
                <a href="https://linkedin.com" class="text-white mx-2"><i class="bi bi-linkedin fs-3"></i></a>
            </div>
        </div>

        <div class="text-center mt-3">
            <p>&copy; 2025 Supreme Tech - Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
<!-- Agregar Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Evitar redirección al agregar al carrito
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita la redirección
            const formData = new FormData(this);

            fetch('agregar_carrito.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Suponiendo que el servidor devuelve un JSON
                }
                throw new Error('Error al agregar al carrito');
            })
            .then(data => {
                // Actualizar el contador del carrito
                const cartCount = document.querySelector('.cart-count');
                if (data.newCount !== undefined) {
                    cartCount.textContent = data.newCount; // Actualiza el contador
                    cartCount.style.display = 'inline'; // Asegúrate de que el contador sea visible
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
</body>
</html>