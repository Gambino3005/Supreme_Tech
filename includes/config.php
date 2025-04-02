<?php
$host = "localhost";
$user = "root"; // Usuario por defecto en XAMPP
$password = ""; // Contraseña vacía en XAMPP
$dbname = "tienda_online";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
