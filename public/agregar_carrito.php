<?php
session_start();
include '../includes/config.php';

$usuario_id = $_SESSION['user_id'] ?? null;
$producto_id = $_POST['producto_id'] ?? null;
$cantidad = $_POST['cantidad'] ?? 1;

if (!$usuario_id) {
    echo json_encode(['error' => 'No autenticado']);
    exit();
}

// Verificar si el producto ya está en el carrito
$sql = "SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $producto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Si ya está en el carrito, actualizar la cantidad
    $nueva_cantidad = $row['cantidad'] + $cantidad;
    $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
    $stmt->bind_param("ii", $nueva_cantidad, $row['id']);
} else {
    // Si no está en el carrito, agregarlo
    $stmt = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $usuario_id, $producto_id, $cantidad);
}

$stmt->execute();

// Obtener el nuevo conteo de productos en el carrito
$sql = "SELECT COUNT(*) as total FROM carrito WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$newCount = $row['total'];

// Devuelve el nuevo conteo como JSON
echo json_encode(['newCount' => $newCount]);
exit();
?>