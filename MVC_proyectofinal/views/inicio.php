<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra'])){
    if(isset($_SESSION["cambiado"])){
        header('Location:?c=principal');
    }else{

    }
        
}else{
    header('Location:?c=home');
    die() ;
}



?>
<html lang="es" style="    overflow-x: hidden;">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

    <title>Nueva contraseña</title>
    <?php include "menu.php";
    
    echo "<style>.menu{display:none}</style>";
    ?>
</head>

<body style="font-size:12px !important">

    <div class="login-page">
        <div style="position: relative;text-align:center;">
            
        </div>
        <div class="form" style="padding-top:3%;">
        <?php echo $_SESSION['usuario'];?>
        <h3>Primer inicio de sesión</h3>
        <hr class="my-4" style="background-color:gray;">
            
      
            <form style='font-size:14px' class="login-form" action="?c=primer_inicio" method="post">
            <input type="mail" value="" name="correo1" placeholder="Correo" required>
            <input type="mail" value="" name="correo2" placeholder="Confirmar correo" required>
            <input type="password" value="" name="contrasena1" placeholder="Contraseña Nueva" required>
               <input type="password" value="" name="contrasena2" placeholder="Confirmar Contraseña" required>
                <button>Confirmar</button>
                <hr>
                <br>
                <p>Recuerde que la contraseña debe incluir al menos 8 caracteres, una mayúscula, un número y un caracter especial (+,-,/ o \).</p>

            </form>
            <?php if(isset($_SESSION["error2"])){ ?>     
                 <?php echo $_SESSION["error2"];?>               
            <?php   unset($_SESSION["error2"]);
    
        }?>
        </div>
    </div>

</body>

</html>

