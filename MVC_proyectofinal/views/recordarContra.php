
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
        .close {
            font-size: 1rem !important;
            margin-top: 50px;
            margin-left: 50px;
            float: left !important;
            background: none;
            border: none;
        }
    </style>
</head>

<body style="font-size:12px !important">

    <nav class="navbar navbar-expand-lg navbar-light" style="background: #212529;justify-content: left;">
        <div>
            <a href="https://www.educa2.madrid.org/web/centro.ies.ciudadescolar.madrid" target="_blank" class="navbar-brand" style="display:inline-block;">
                <img src="libs/img/logo_ciudadescolar.png" height="70" width="140" style="border-radius:1px; margin-left:5%;display:inline-block;" alt="CoolBrand">
            </a>
            <h4 style="color:rgba(255, 255, 255, 0.9); display:inline-block;"> Sistema de Gestión de Espacios Comunes</h4>
        </div>
    </nav>
    <a href="?c=principal" title="Cancelar" style='font-size:14px'><button type="button" class="close"><i class="bi bi-arrow-return-left volver"> Volver a Inicio de sesión</i></button></a>

    <div class="login-page border" style="padding:0%; margin-top:4%">

        <div class="form">
            <h2>Cambiar contraseña</h2>
            <hr>
            

            <form style='font-size:14px' class="login-form" action="?c=enviarContraNueva" method="POST">
            <input type="text" name="correo" placeholder="Correo electrónico" required>    

               <button type="submit">Enviar</button>
               
               <p class="mt-4"><small>Se le enviará un correo a la dirección ingresada con una nueva contraseña, la cual debe utilizar para iniciar sesión y se le pedirá cambiarla por una personal.</small></p>
            </form>

            <?php 
            
               if(isset($_SESSION["error"])){     
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
               }?> 
    </div>
    </div>

</body>

</html>
