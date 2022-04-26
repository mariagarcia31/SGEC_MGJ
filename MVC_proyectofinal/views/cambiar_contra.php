
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

    <title>Cambio de Contraseña</title>
    <?php include "menu.php";
    
    echo "<style>.menu{display:none}</style>";
    ?>
</head>

<body>

    <div class="login-page">
        <div style="position: relative;text-align:center;">
            <h1>Cambio de contraseña</h1>
        </div>
        <div class="form">
            <form class="login-form" action="?c=cambio_contra&_correo=<?php echo $_GET["correo"] ?>" method="post">
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

</body>

</html>

