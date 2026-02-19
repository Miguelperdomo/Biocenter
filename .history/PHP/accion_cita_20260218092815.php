<?php
require "../conection/conexion.php";

$id = $_POST['id'];
$accion = $_POST['accion'];

if($accion=="confirmar"){
    $estado="Confirmada";
}

if($accion=="cancelar"){
    $estado="Cancelada";
}

if($accion=="eliminar"){
    $estado="Cancelada";
}

$conn->query("UPDATE citas SET estado='$estado' WHERE id=$id");

header("Location: ./panel.php?msg=$estado");
exit();
?>
