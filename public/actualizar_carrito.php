<?php
session_start();
// include 'includes/config.php';
include '../includes/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito_id = $_POST['carrito_id'];
    $cantidad = intval($_POST['cantidad']);

    if ($cantidad > 0) {
        $query = "UPDATE carrito SET cantidad = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $cantidad, $carrito_id);
        $stmt->execute();
    }

    header("Location: ver_carrito.php");
    exit();
}
?>
