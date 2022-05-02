<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>
<html lang="en">
<head>
  
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../MVC_proyectofinal/libs/css/estilos.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

<style>
  
  </style>
</head>
<body>

  
  

<?php include "menu.php";

    ?>


<body>
  <div class="container">

    <div class="card">
      <img src="libs/img/undraw_profile.svg" alt="Avatar" style="width:50%">
        <h4><b><?php echo $_SESSION['nombre']; ?></b></h4>
        <p><b><?php echo $_SESSION['correo']; ?></b></p> 
       
        <div class="form">
            <form class="login-form" action="?c=cambio_contra&_correo=<?php echo $_SESSION["correo"]?>" method="post">
                <input type="password"  name="contrasena1" placeholder="Contraseña Nueva" required>
               <input type="password" name="contrasena2" placeholder="Confirmar Contraseña" required>
                <button>Confirmar</button>
            </form>
            <?php if(isset($_SESSION["error2"])){ ?>     
                 <div class='alert  '><?php echo $_SESSION["error2"];?></div>                     
            <?php   unset($_SESSION["error2"]);
    
        }?>
        </div>
      </div>
  </div>
</body>
</html>

