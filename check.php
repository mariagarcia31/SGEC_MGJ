<?php 
session_start();

if(isset($_POST["enviar"])){

    $nombre=$_POST["nombre"];
    $contrasena=$_POST["passw"];


    $dbHost     = "localhost";  
    $dbUsername = "root";  
    $dbPassword = "";  
    $dbName     = "sgec";  
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  
    if ($db->connect_error) {  
        die("Connection failed: " . $db->connect_error);  
    }
    $result = $db->query("SELECT * FROM usuarios WHERE correo='$nombre'"); 
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){ 

    if($contrasena==$row['contra']){
        $_SESSION['id']=$row['id'];
        $_SESSION['nombre']=$row['nombre'];
        
        header("location:index.php");
    }else{
        $_SESSION["error"]="Contraseña incorrecta";
        header("location:login.php");
    }
  
}else{
    $_SESSION["error"]="Correo no registrado";
    header("location:login.php");

}

}
else{
    header("location:login.php");
}

?>