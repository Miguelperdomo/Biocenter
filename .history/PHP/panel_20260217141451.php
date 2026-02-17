<?php
session_start();
require "../conection/conexion.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
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

</style>
</head>

<body>

<div class="sidebar">
<h2>Biocenter</h2>
<a href="#">📊 Dashboard</a>
<a href="#">📅 Citas</a>
<a href="logout.php">🚪 Cerrar sesión</a>
</div>

<div class="main">

<h1>Panel Administrador</h1>

<!-- CONTADORES -->
<div class="cards">
<div class="card"><p>Citas Hoy</p><h3><?=$citasHoy?></h3></div>
<div class="card"><p>Pendientes</p><h3><?=$pendientes?></h3></div>
<div class="card"><p>Confirmadas</p><h3><?=$confirmadas?></h3></div>
<div class="card"><p>Canceladas</p><h3><?=$canceladas?></h3></div>
</div>

<h2>Citas agendadas</h2>

<table>
<tr>
<th>Nombre</th>
<th>Servicio</th>
<th>Fecha</th>
<th>Hora</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php while($row=$citas->fetch_assoc()): ?>

<tr>
<td><?=$row['nombre_completo']?></td>
<td><?=$row['tipo_servicio']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['hora']?></td>

<td>
<span class="estado 
<?=
$row['estado']=="Pendiente"?"pendiente":
($row['estado']=="Confirmada"?"confirmada":"cancelada")
?>">
<?=$row['estado']?>
</span>
</td>

<td>

<form action="PHP/accion_cita.php" method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="hidden" name="accion" value="confirmar">
<button class="btn accept">Aceptar</button>
</form>

<form action="PHP/accion_cita.php" method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="hidden" name="accion" value="cancelar">
<button class="btn cancel">Cancelar</button>
</form>

<form action="PHP/accion_cita.php" method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="hidden" name="accion" value="eliminar">
<button class="btn delete">Eliminar</button>
</form>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>
</body>
</html>
