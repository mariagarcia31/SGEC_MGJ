<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">
    <title>Login</title>
    <style>

        .footer{
            background-color: #212529; /* Black*/
            position:fixed;
            bottom:0px;
            left:0px;
            right:0px;
            padding:7px;
            text-align:center;
            z-index:4;
            color:white
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background: #212529;justify-content: left;">
        <div>
            <a href="https://www.educa2.madrid.org/web/centro.ies.ciudadescolar.madrid" target="_blank" class="navbar-brand" style="display:inline-block;">
                <img src="libs/img/logo_ciudadescolar.png" height="70" width="140" style="border-radius:1px; margin-left:5%;display:inline-block;" alt="CoolBrand">
            </a>
            <h4 style="color:rgba(255, 255, 255, 0.9); display:inline-block;"> Sistema de Gestión de Espacios Comunes</h4>
        </div>
    </nav>

    <div class="login-page border" style="padding:0%; margin-top:4%">
        
        <div class="form">
        
            <h2>Iniciar Sesión</h2>
            <hr>
        
            <form class="login-form" action="?c=verificar" method="post">
                <input type="email"  name="correo" placeholder="Correo" required>
               <input type="password" name="contrasena" placeholder="Contraseña" required>
               <br>
               <br>
                <button >Entrar</button>
            </form>
            <?php if(isset($_SESSION["error"])){ ?>     
                 <div class='alert  '><?php echo $_SESSION["error"];?></div>                     
            <?php   unset($_SESSION["error"]);
    
        }?>
        </div>
    </div>



    <div class="footer">
       <p>© Copyright 2022 | Sistema de Gestión de Espacios Comunes | IES Ciudad Escolar</p>
</div>
</body>

</html>

