<?php
session_start();
require "conection/conexion.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/* CONTADORES */
$hoy = date("Y-m-d");

$citasHoy = $conn->query("SELECT COUNT(*) total FROM citas WHERE fecha='$hoy'")->fetch_assoc()['total'];
$pendientes = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Pendiente'")->fetch_assoc()['total'];
$confirmadas = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Confirmada'")->fetch_assoc()['total'];
$canceladas = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Cancelada'")->fetch_assoc()['total'];

/* LISTAR CITAS */
$citas = $conn->query("SELECT * FROM citas ORDER BY fecha DESC, hora DESC");
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI';
    display:flex;
    background:#f1f5f9;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:230px;
    background:#0f172a;
    height:100vh;
    color:white;
    padding:20px;
}

.sidebar h2{
    text-align:center;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    transition:.3s;
}

.sidebar a:hover{
    background:#2563eb;
}

/* ===== CONTENIDO ===== */
.main{
    flex:1;
    padding:30px;
}

/* ===== TARJETAS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.card h3{
    margin:0;
    font-size:30px;
}

/* ===== TABLA ===== */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

th,td{
    padding:15px;
    text-align:left;
}

th{
    background:#0f172a;
    color:white;
}

tr:nth-child(even){
    background:#f8fafc;
}

/* ===== BOTONES ===== */
.btn{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    color:white;
}

.accept{ background:#22c55e; }
.cancel{ background:#ef4444; }
.delete{ background:#64748b; }

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Biocenter</h2>

    <a href="#">📊 Dashboard</a>
    <a href="#">📅 Citas</a>
    <a href="logout.php">🚪 Cerrar sesión</a>
</div>

<!-- CONTENIDO -->
<div class="main">

<h1>Panel Administrador</h1>

<!-- TARJETAS -->
<div class="cards">

<div class="card">
    <p>Citas Hoy</p>
    <h3>12</h3>
</div>

<div class="card">
    <p>Pendientes</p>
    <h3>5</h3>
</div>

<div class="card">
    <p>Confirmadas</p>
    <h3>6</h3>
</div>

<div class="card">
    <p>Canceladas</p>
    <h3>1</h3>
</div>

</div>

<!-- TABLA -->
<h2>Citas agendadas</h2>

<table>
<tr>
<th>Nombre</th>
<th>Fecha</th>
<th>Hora</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<tr>
<td>Juan Perez</td>
<td>2026-02-20</td>
<td>10:00</td>
<td>Pendiente</td>
<td>
<button class="btn accept">Aceptar</button>
<button class="btn cancel">Cancelar</button>
<button class="btn delete">Eliminar</button>
</td>
</tr>

</table>

</div>

</body>
</html>
