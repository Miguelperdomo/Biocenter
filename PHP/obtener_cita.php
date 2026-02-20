<?php
require "../conection/conexion.php";

// Obtener ID de la cita
$id = $_GET['id'];

// Consultar la cita en la base de datos
$result = $conn->query("SELECT * FROM citas WHERE id = $id");

// Verificar si la cita existe
if ($result->num_rows > 0) {
    $cita = $result->fetch_assoc();
    // Enviar los datos de la cita como JSON
    echo json_encode($cita);
} else {
    echo json_encode(['error' => 'Cita no encontrada']);
}
?>