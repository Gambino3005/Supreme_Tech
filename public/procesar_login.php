<?php
session_start();
//include '../config/db.php'; // Conexión a la base de datos
include "../includes/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario
    $stmt = $conn->prepare("SELECT id, nombre, email, contrasena FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar contraseña
        if (password_verify($password, $user['contrasena'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            header("Location: index.php"); // Redirigir a la página principal
            exit();
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    
    $stmt->close();
    $conn->close();
}

if (isset($error)) {
    echo "<script>alert('$error'); window.location.href='login.php';</script>";
}
?>
