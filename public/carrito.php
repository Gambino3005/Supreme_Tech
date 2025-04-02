<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $idProducto = $_POST['idProducto'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $cantidad = $_POST['cantidad'] ?? 1;
    
    switch ($accion) {
        case 'agregar':
            if ($idProducto) {
                if (isset($_SESSION['carrito'][$idProducto])) {
                    $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
                } else {
                    $_SESSION['carrito'][$idProducto] = [
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'cantidad' => $cantidad
                    ];
                }
            }
            break;
        
        case 'eliminar':
            if ($idProducto && isset($_SESSION['carrito'][$idProducto])) {
                unset($_SESSION['carrito'][$idProducto]);
            }
            break;
        
        case 'actualizar':
            if ($idProducto && isset($_SESSION['carrito'][$idProducto])) {
                $_SESSION['carrito'][$idProducto]['cantidad'] = $cantidad;
            }
            break;
        
        case 'vaciar':
            $_SESSION['carrito'] = [];
            break;
    }
}

header('Location: ver_carrito.php');
exit();
