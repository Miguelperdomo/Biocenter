<?php
require "./conection/conexion.php";
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $tipo_cliente = $_POST['tipo_cliente'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $observaciones = $_POST['observaciones'];

    /* ================= VALIDAR HORARIO ================= */

    $dia = date('N', strtotime($fecha)); // 1=lunes 7=domingo

    if($dia > 5){
        $_SESSION['error']="Solo se permiten citas de lunes a viernes";
        header("Location: ../agendar.php");
        exit();
    }

    if($hora < "07:00" || $hora > "16:00"){
        $_SESSION['error']="Horario permitido: 7AM a 4PM";
        header("Location: ../agendar.php");
        exit();
    }

    /* ================= VALIDAR SI YA EXISTE ================= */

    $sql="SELECT id FROM citas WHERE fecha=? AND hora=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$fecha,$hora);
    $stmt->execute();
    $res=$stmt->get_result();

    if($res->num_rows>0){
        $_SESSION['error']="Ya existe una cita en ese horario";
        header("Location: ../agendar.php");
        exit();
    }

    /* ================= INSERTAR CITA ================= */

    $insert="INSERT INTO citas(
        nombre_completo,
        email,
        telefono,
        tipo_usuario,
        tipo_servicio,
        fecha,
        hora,
        observaciones
    ) VALUES (?,?,?,?,?,?,?,?)";

    $stmt2=$conn->prepare($insert);

    $stmt2->bind_param("ssssssss",
        $nombre,
        $correo,
        $telefono,
        $tipo_cliente,
        $servicio,
        $fecha,
        $hora,
        $observaciones
    );

    if($stmt2->execute()){
        $_SESSION['success']="Cita agendada correctamente";
    } else {
        $_SESSION['error']="Error al registrar la cita";
    }

    header("Location: ../agendar.php");
}
?>
