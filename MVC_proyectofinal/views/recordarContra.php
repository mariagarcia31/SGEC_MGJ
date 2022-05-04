
<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/Exception.php';
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/PHPMailer.php';
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/SMTP.php';
    ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">

    <title>Cambio de Datos</title>

</head>

<body>

    <div class="login-page">
        <div style="position: relative;text-align:center;">
            <h1>Recordar contraseña</h1>
        </div>
        <div class="form">
            <form class="login-form" action="" method="post">
            <input type="text" name="correo" placeholder="Correo electrónico" required>    

                <input type="submit" value="enviado" name="enviar">
            </form>
        </div>
    </div>

</body>

</html>
<?php

if(isset($_POST["enviado"])){

    $mail = new PHPMailer();
    $mail->IsSMTP();
    
    $mail->From = "mail@gmail.com"; 
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com"; 
    $mail->Port = 587;
    $mail->Username ='sgec.ciudadescolar@gmail.com';
    $mail->Password = 'Mariagerardoyjossue1'; 
    $mail->AddAddress("mariagarcia.daw@ciudadescolarfp.es");
    $mail->Subject = "prueba";
    $mail->Body = "prueba";
    $mail->Send();
}
?>