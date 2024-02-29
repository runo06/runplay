<?php
$servername = "127.0.0.1:33065";
$username = "root";
$password = "";
$dbname = "runplay";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>