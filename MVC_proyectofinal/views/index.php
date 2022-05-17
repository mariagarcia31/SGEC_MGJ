<?php 


if((isset($_COOKIE['contrasena'])) && (isset($_COOKIE['correo']))){
    header ('Location:?c=principal');

}else{

    $contra1="";
    $usu1="";   
}
if(!isset($_SESSION["intentos"])){
    $_SESSION["intentos"]=0;
}

$connection = MySQLi_connect(

    "localhost:33065", //Server host name.
 
    "root", //Database username.
 
    "", //Database password.
 
    "sgec" //Database name or anything you would like to call it.
 
 );

mysqli_set_charset($connection, "utf8");
            $ip = $_SERVER["REMOTE_ADDR"];
            if($ip=="::1"){
                $ip="127.0.0.1";
            }

            $result = mysqli_query($connection, "SELECT COUNT(*) FROM `ip` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
            $count = mysqli_fetch_array($result, MYSQLI_NUM);

            if($count[0] >= 3){
                $_SESSION['intentos'] = 3;
            }
           
?>

<html lang="en" style="    overflow-x: hidden;">

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

    #iniciar{
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
<?php 


        $timeresta=0;


        if(isset($_SESSION["timeBan"]) && $_SESSION["intentos"]>=3){
          
            $timeBan=$_SESSION["timeBan"];
            $timeresta=time()-$timeBan;
            if(($timeresta)<30){
                ?>
                    #correo,#contra,#iniciar {
                        pointer-events: none;
                        
                    }             
                <?php
                //printSrciptBan();
               // header("location:?c=home&ban=1");
            }else{
                unset($_SESSION["timeBan"]);
                
            }
        }


        

       
?>

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

    
    <div class="login-page border" style="padding:0%; margin-top:4%">
        
        <div class="form">
        
            <h2>Iniciar Sesión</h2>
            <hr>
      
            <form style='font-size:14px' class="login-form" action="?c=verificar" method="post" id="formulario" >
                <input type="text"  id="correo" name="correo" placeholder="Correo electrónico o usuario" required >


               <input type="password" id="contra" name="contrasena" placeholder="Contraseña" required>
  
               <div class="custom-control custom-checkbox text-start">
               <input type="checkbox" class="custom-control-input" id="checkbox-1" name="recordar" value="recordar" style="width:5%" > 
               <label class="custom-control-label" for="checkbox-1">Recordar contraseña</label>
        </div>
                <input type="submit" value="Entrar" name="entrar" id="iniciar" dis >
                
            </form>
          




            <a href="?c=recordarContra">He olvidado mi contraseña</a>

            <?php 
            
               if(isset($_SESSION["error"])){     
                    echo $_SESSION["error"];?>                   
               <?php   
                      
                       unset($_SESSION["error"]);
                       if($_SESSION['intentos']>=3){
                          
                          $_SESSION["timeBan"]=time();
                          
                            printSricptBan();
                             
                           } 
                           
                       } 
 
             ?>

           
           
            
        </div>
    </div>
 



    <div class="footer">
       <p>© Copyright 2022 | Sistema de Gestión de Espacios Comunes | IES Ciudad Escolar</p>
</div>
</body>

</html>
