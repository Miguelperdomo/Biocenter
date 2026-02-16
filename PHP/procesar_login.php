<?php
session_start();
require "../conection/conexion.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql="SELECT * FROM admin WHERE usuario=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$usuario);
    $stmt->execute();
    $resultado=$stmt->get_result();

    if($row=$resultado->fetch_assoc()){

        if(password_verify($password,$row['password'])){

            session_regenerate_id(true);
            $_SESSION['admin']=$usuario;

            header("Location: panel.php");
            exit();

        } else {
            $_SESSION['error']="Contraseña incorrecta";
            header("Location: ../login.php");
            exit();
        }

    } else {
        $_SESSION['error']="Usuario no existe";
        header("Location: ../login.php");
        exit();
    }
}
?>