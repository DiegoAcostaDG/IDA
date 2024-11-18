<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_usuarios";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$correo_electronico = $_POST['correo_electronico'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Preparar y bindear
$stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena);

// Ejecutar
if ($stmt->execute()) {
    echo "Nuevo registro creado exitosamente";
    // Redirigir a inicio.html después del registro exitoso
    header("Location: inicio.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>


