<?php
session_start();
//include 'includes/config.php';
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito_id = $_POST['carrito_id'];

    $query = "DELETE FROM carrito WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $carrito_id);
    $stmt->execute();

    header("Location: ver_carrito.php");
    exit();
}
?>
