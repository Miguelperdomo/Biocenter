<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<h2>Bienvenido Administrador</h2>

<a href="logout.php">Cerrar sesión</a>
