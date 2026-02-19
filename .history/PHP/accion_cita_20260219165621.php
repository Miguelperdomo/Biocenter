<?php
require "../conection/conexion.php";

$id=$_POST['id'];
$accion=$_POST['accion'];

if($accion=="confirmar"){
$conn->query("UPDATE citas SET estado='Confirmada' WHERE id=$id");
}

if($accion=="cancelar"){
$conn->query("UPDATE citas SET estado='Cancelada' WHERE id=$id");
}

if($accion=="eliminar"){
$conn->query("DELETE FROM citas WHERE id=$id");
}

header("Location: panel.php");
?>
