
<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/Exception.php';
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/PHPMailer.php';
        require 'C:/xampp/htdocs/SGEC_MGJ/PHPMailer/src/SMTP.php';
    ?>
<head>


    <title>Cambio de Datos</title>
    <link rel="stylesheet" href="libs/cssc/login&check.css">

</head>

<body>
            <h1>Recordar contraseña</h1>

            <form class="login-form" action="?c=recordarContra" method="POST">
            <input type="text" name="correo" placeholder="Correo electrónico" required>    

                <input type="submit" value="enviar" name="enviar">
            </form>


</body>

</html>
<?php


        ?>