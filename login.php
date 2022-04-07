
<?php session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Iniciar sesión</title>
    <style>
        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {

            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;

            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #537efd;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

    </style>
</head>

    <body style="background-color:#f8f9fc"> 

    <nav class="navbar navbar-expand-lg navbar-light" style="background: #537efd;">
        <div>
            <a href="" class="navbar-brand">
                <img src="img/logo_ciudadescolar.jpg" height="68" width="150" style="border-radius:1px" alt="CoolBrand">
            </a>
            <h2 style="color:white; display:inline-block; ">Sistema de Gestión de Espacios Comunes</h2>
        </div>
    </nav>

<div class='login-page' style="background: #537efd;width:40%;margin-top:5%;padding: 1% 2% 3% 2%;border-radius:10px">
    <div class=" login-page">
        <div style="position: relative;text-align:center;">
            <h1 style="color:white">Iniciar Sesión</h1>
        </div>
        <div class="form">
            <form class="login-form" action="check.php" method="post">
                <input type="text"  name="nombre" placeholder="Correo" required>
               <input type="password" name="passw" placeholder="Contraseña" required>
               <button type="submit" name="enviar">Entrar</button>
               <?php
                        if(isset($_SESSION["error"])){
                            echo "<div class='alert alert-danger'>".$_SESSION["error"]."</div>";
                            unset($_SESSION["error"]);
                        }
                    ?>  
            </form>
        </div>
    </div>
</div>
    </body>

</html>

