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
body{margin:0;font-family:'Segoe UI';display:flex;background:#f1f5f9;}
.sidebar{width:230px;background:#0f172a;height:100vh;color:white;padding:20px;}
.sidebar a{display:block;color:white;text-decoration:none;padding:12px;margin:10px 0;border-radius:6px;}
.sidebar a:hover{background:#2563eb;}
.main{flex:1;padding:30px;}

.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:30px;}
.card{background:white;padding:20px;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,.1);}
.card h3{margin:0;font-size:30px;}

table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
th,td{padding:12px;text-align:left;}
th{background:#0f172a;color:white;}

.estado{
    padding:6px 10px;
    border-radius:20px;
    color:white;
    font-size:12px;
}
.pendiente{background:#f59e0b;}
.confirmada{background:#22c55e;}
.cancelada{background:#ef4444;}

.btn{padding:6px 10px;border:none;border-radius:6px;color:white;cursor:pointer;}
.accept{background:#22c55e;}
.cancel{background:#ef4444;}
.delete{background:#64748b;}


/* ================= RESPONSIVE PANEL ================= */

@media(max-width: 900px){

    body{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        height:auto;
        display:flex;
        justify-content:space-around;
        align-items:center;
        padding:10px;
    }

    .sidebar h2{
        display:none;
    }

    .sidebar a{
        margin:0;
        font-size:14px;
        padding:10px;
    }

    .main{
        padding:15px;
    }

    .cards{
        grid-template-columns:1fr 1fr;
        gap:10px;
    }

}



/* ================= TABLA RESPONSIVE ================= */

@media(max-width:700px){

    .cards{
        grid-template-columns:1fr;
    }

    table{
        display:block;
        overflow-x:auto;
        white-space:nowrap;
    }

    th,td{
        font-size:14px;
        padding:10px;
    }

}

/* ================= BOTONES MOVIL ================= */

@media(max-width:500px){

    .btn{
        display:block;
        width:100%;
        margin-bottom:5px;
    }

}



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

<button type="button" class="btn delete" onclick="abrirModal(<?=$row['id']?>,'eliminar')">
Eliminar
</button>

<button type="button" class="btn delete" onclick="abrirModal(<?=$row['id']?>,'eliminar')">
Eliminar
</button>

<button class="btn delete" onclick="confirmarAccion(<?=$row['id']?>,'eliminar')">
Eliminar
</button>

<form id="formAccion" method="POST" action="./accion_cita.php">
<input type="hidden" name="id" id="idCita">
<input type="hidden" name="accion" id="tipoAccion">
</form>


</td>

</tr>
<div id="modalConfirm" class="modal">
  <div class="modal-content">
    <h2 id="tituloConfirm"></h2>
    <p id="textoConfirm"></p>

    <button class="btn accept" onclick="ejecutarAccion()">SI</button>
    <button class="btn delete" onclick="cerrarConfirm()">Cancelar</button>
  </div>
</div>

<div id="modalResult" class="modal">
  <div class="modal-content">
    <h2 id="tituloResult"></h2>
    <p id="textoResult"></p>
    <button onclick="cerrarResult()">Aceptar</button>
  </div>
</div>


<?php endwhile; ?>

</table>

</div>
</body>

<script>

function abrirModal(id, accion){

    document.getElementById("citaId").value = id;
    document.getElementById("accionTipo").value = accion;

    let titulo = "";
    let texto = "";

    if(accion=="confirmar"){
        titulo = "Confirmar Cita";
        texto = "¿Deseas CONFIRMAR esta cita?";
    }

    if(accion=="cancelar"){
        titulo = "Cancelar Cita";
        texto = "¿Seguro deseas CANCELAR esta cita?";
    }

    if(accion=="eliminar"){
        titulo = "Eliminar Cita";
        texto = "Esta acción marcará la cita como cancelada.";
    }

    document.getElementById("modalTitle").innerText = titulo;
    document.getElementById("modalText").innerText = texto;

    document.getElementById("modalConfirm").style.display="flex";
}

function closeModal(){
    document.getElementById("modalConfirm").style.display="none";
}

</script>

</html>
