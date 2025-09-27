<?php
session_start();
require_once '../config/Database.php';

$db = new Database();
$conn = $db->conectar();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($password, $usuario['password'])) {
    $_SESSION['usuario'] = $usuario['nombre'];
    header("Location: ../index.php");
} else {
    echo "<script>alert('Credenciales incorrectas'); window.location='login.php';</script>";
}