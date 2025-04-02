<?php
session_start();
include "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["telefono"]);
    $direccion = trim($_POST["direccion"]);
    $ciudad = trim($_POST["ciudad"]);
    $estado = trim($_POST["estado"]);
    //$codigo_postal = trim($_POST["codigo_postal"]);
    $pais = trim($_POST["pais"]);
    //$fecha_nacimiento = trim($_POST["fecha_nacimiento"]);
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_BCRYPT); // Encriptar contraseña

    // Validación básica
    if (empty($nombre) || empty($email) || empty($contrasena) || empty($direccion) || empty($ciudad) || empty($estado) || empty($pais)) {
        $_SESSION['error'] = "Todos los campos obligatorios deben ser completados.";
        header("Location: registro.php");
        exit();
    }

    // Verificar si el usuario ya existe
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Este correo ya está registrado.";
        header("Location: registro.php");
        exit();
    }

    // Insertar usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, telefono, direccion, ciudad, estado, pais, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $nombre, $email, $telefono, $direccion, $ciudad, $estado, $pais, $contrasena);

    if ($stmt->execute()) {
        $_SESSION['registro_exito'] = "Usuario registrado correctamente. ¡Bienvenido!";
        header("Location: registro_exitoso.php"); // Redirigir a la nueva página
        exit();
    } else {
        $_SESSION['error'] = "Error al registrar usuario. Inténtalo de nuevo.";
        header("Location: registro.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>