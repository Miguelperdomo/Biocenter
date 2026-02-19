<?php
session_start();
require "../conection/conexion.php";

// Verificar si el usuario es admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener todas las citas
$citas = $conn->query("SELECT * FROM citas ORDER BY fecha DESC, hora DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Completas</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI';
            display: flex;
            background: #f1f5f9;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 230px;
            background: #0f172a;
            height: 100vh;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: #2563eb;
        }

        /* ===== CONTENIDO ===== */
        .main {
            flex: 1;
            padding: 30px;
        }

        /* ===== TABLA ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        th,
        td {
            padding: 14px;
            text-align: left;
        }

        th {
            background: #0f172a;
            color: white;
        }

        .estado {
            padding: 6px 12px;
            border-radius: 20px;
            color: white;
            font-size: 12px;
        }

        .pendiente {
            background: #f59e0b;
        }

        .confirmada {
            background: #22c55e;
        }

        .cancelada {
            background: #ef4444;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            margin: 2px;
        }

        .accept {
            background: #22c55e;
        }

        .cancel {
            background: #f97316;
        }

        .delete {
            background: #ef4444;
        }

        .btn-new {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 15px;
            box-shadow: 0 5px 15px rgba(37, 99, 235, .3);
            transition: .3s;
        }

        .btn-new:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, .4);
        }

        /* Estilos para el buscador */
        .search-box {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
        }

        .search-box input {
            width: 350px;
            max-width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-size: 15px;
            transition: .3s;
            background: #fff;
        }

        .search-box input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, .25);
        }

    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Biocenter</h2>
        <a href="panel.php">📊 Dashboard</a>
        <a href="citas_completas.php">📅 Citas</a>
        <a href="logout.php">🚪 Cerrar sesión</a>
    </div>

    <div class="main">

        <h1>Gestión de Citas</h1>

        <!-- Buscador -->
        <div class="search-box">
            <input type="text" id="buscarCita" placeholder="🔎 Buscar por nombre, servicio, fecha o estado...">
        </div>

        <table>
            <tr>
                <th>Nombre</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php while($row = $citas->fetch_assoc()): ?>

            <tr>
                <td><?= $row['nombre_completo'] ?></td>
                <td><?= $row['tipo_servicio'] ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora'] ?></td>

                <td>
                    <span class="estado 
                        <?= $row['estado'] == "Pendiente" ? "pendiente" : ($row['estado'] == "Confirmada" ? "confirmada" : "cancelada") ?>">
                        <?= $row['estado'] ?>
                    </span>
                </td>

                <td>
                    <button class="btn accept" onclick="confirmar(<?= $row['id'] ?>, 'confirmar')">Aceptar</button>
                    <button class="btn cancel" onclick="confirmar(<?= $row['id'] ?>, 'cancelar')">Cancelar</button>
                    <button class="btn delete" onclick="confirmar(<?= $row['id'] ?>, 'eliminar')">Eliminar</button>
                </td>
            </tr>

            <?php endwhile; ?>
        </table>

    </div>

    <script>
        const buscador = document.getElementById("buscarCita");

        buscador.addEventListener("keyup", function() {
            let filtro = buscador.value.toLowerCase();
            let filas = document.querySelectorAll("table tr");

            filas.forEach((fila, index) => {
                if (index === 0) return; // saltar encabezado
                let texto = fila.textContent.toLowerCase();

                if (texto.includes(filtro)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });

        function confirmar(id, accion) {
            // Aquí agregas la lógica para confirmar, cancelar o eliminar la cita
            console.log(id, accion); // Solo para prueba
        }
    </script>

</body>

</html>
