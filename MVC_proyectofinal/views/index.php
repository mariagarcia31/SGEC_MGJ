<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">
    <title>Login</title>
   
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background: #537efd;">
        <div>
            <a href="" class="navbar-brand">
                <img src="libs/img/logo_ciudadescolar.jpg" height="68" width="150" style="border-radius:1px" alt="CoolBrand">
            </a>
            <h2 style="color:white; display:inline-block; ">Sistema de Gestión de Espacios Comunes</h2>
        </div>
    </nav>

    <div class="login-page">
        <div style="position: relative;text-align:center;">
            <h1>Iniciar Sesión</h1>
        </div>
        <div class="form">
            <form class="login-form" action="?c=verificar" method="post">
                <input type="email"  name="correo" placeholder="Correo" required>
               <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button>Entrar</button>
            </form>
            <?php if(isset($_SESSION["error"])){ ?>     
                 <div class='alert alert-danger'><?php echo $_SESSION["error"];?></div>                     
            <?php   unset($_SESSION["error"]);
    
        }?>
        </div>
    </div>



    
   


</body>

</html>

