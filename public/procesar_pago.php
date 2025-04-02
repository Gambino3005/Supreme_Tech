<?php
session_start();
include '../includes/config.php';

$usuario_id = $_SESSION['user_id'] ?? null;

if (!$usuario_id) {
    header("Location: login.php");
    exit();
}

// Verificar que se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['nombre'], $_POST['correo'], $_POST['direccion'], $_POST['metodo_pago'])) {
    $_SESSION['error'] = "Ocurrió un error al procesar el pago.";
    header("Location: confirmar_compra.php");
    exit();
}

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$direccion = trim($_POST['direccion']);
$metodo_pago_id = (int) $_POST['metodo_pago'];

// Validación básica
if (empty($nombre) || empty($correo) || empty($direccion) || $metodo_pago_id <= 0) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: confirmar_compra.php");
    exit();
}

// Validar el formato del correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "El correo electrónico no es válido.";
    header("Location: confirmar_compra.php");
    exit();
}

// Obtener productos del carrito
$sql = "SELECT c.producto_id, c.cantidad, p.precio 
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

// Insertar el pedido en la base de datos
$estado = "pendiente";
$stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, total, estado, metodo_pago_id, correo, direccion) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("idsiss", $usuario_id, $total, $estado, $metodo_pago_id, $correo, $direccion);

// $estado = "pendiente";
// $stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, total, estado, metodo_pago_id, nombre, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("idsiiss", $usuario_id, $total, $estado, $metodo_pago_id, $nombre, $correo, $direccion);

if (!$stmt->execute()) {
    $_SESSION['error'] = "Error al procesar el pedido: " . $stmt->error;
    header("Location: confirmar_compra.php");
    exit();
}

$pedido_id = $stmt->insert_id;

// Insertar los detalles del pedido
foreach ($productos as $producto) {
    $stmt = $conn->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $pedido_id, $producto['producto_id'], $producto['cantidad'], $producto['precio']);
    $stmt->execute();
}

// Vaciar el carrito después del pago
$stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

// Redirigir a la página de confirmación con el ID del pedido
header("Location: confirmacion_pedidos.php?pedido_id=$pedido_id");
exit();
?>