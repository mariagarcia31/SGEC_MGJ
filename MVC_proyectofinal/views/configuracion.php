
<html lang="en">
<head>
  
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="libs/css/estilos.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

<style>
   .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  padding:50px;
  display: flex;
    justify-content: center;
    align-items:center !important;
    margin-top:50px !important
}
.card img{
  width:100px
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.container{
  display: flex;
    justify-content: center;
    margin-bottom:100px
}
form{
  display: flex;
    flex-direction: column;
    align-items: center;

}
input{
  margin:10px !important
}
.form{
  box-shadow:none !important
}
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

