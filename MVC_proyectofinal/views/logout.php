<?php 


header('Location:?c=home');
setcookie("usuario",$_COOKIE['usuario'],time()-1);
setcookie("contrasena",$_COOKIE['contrasena'],time()-1);
session_destroy();
session_unset();
$conn=null;




?>