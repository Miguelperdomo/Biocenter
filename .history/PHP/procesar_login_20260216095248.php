<?php
session_start();
require "conexion.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $usuario=trim($_POST['usuario']);
    $password=$_POST['password'];

    // CONSULTA PREPARADA (ANTI SQL INJECTION)
    $sql="SELECT * FROM admin WHERE usuario=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$usuario);
    $stmt->execute();
    $resultado=$stmt->get_result();

    if($row=$resultado->fetch_assoc()){

        // VERIFICAR PASSWORD HASH
        if(password_verify($password,$row['password'])){

            session_regenerate_id(true);

            $_SESSION['admin']=$usuario;

            header("Location: panel.php");
            exit();

        }else{
            echo "❌ Contraseña incorrecta";
        }

    }else{
        echo "❌ Usuario no existe";
    }
}
?>
