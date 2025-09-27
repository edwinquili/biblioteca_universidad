<?php
require_once '../config/Database.php';

$db = new Database();
$conn = $db->conectar();

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nombre, $email, $password]);

echo "<script>alert('Registro exitoso'); window.location='login.php';</script>";