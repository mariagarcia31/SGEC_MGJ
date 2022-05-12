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
<html lang="en" style="    overflow-x: hidden;">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

    <title>Cambio de Datos</title>
    <?php include "menu.php";
    
    echo "<style>.menu{display:none}</style>";
    ?>
</head>

<body style="font-size:12px !important">

    <div class="login-page">
        <div style="position: relative;text-align:center;">
            <h1>Cambio de datos</h1>
            <p>Recuerda que la contraseña debe incluir al menos 8 caracteres, una mayúscula, un número y un caracter especial (+,-,/ o \).</p>
        </div>
        <div class="form">
            <form style='font-size:14px' class="login-form" action="?c=cambio_contra&correo=<?php echo $_GET["correo"]?>" method="post">
            <input type="password" value="" name="contrasena1" placeholder="Contraseña Nueva" required>
               <input type="password" value="" name="contrasena2" placeholder="Confirmar Contraseña" required>
                <button>Confirmar</button>
            </form>
            <?php if(isset($_SESSION["error2"])){ ?>     
                 <?php echo $_SESSION["error2"];?>               
            <?php   unset($_SESSION["error2"]);
    
        }?>
        </div>
    </div>

</body>

</html>

