<?php
session_start();

session_destroy();

session_start();
$_SESSION['success']="Sesión cerrada correctamente";

header("Location: ../login.php");
exit();
?>
