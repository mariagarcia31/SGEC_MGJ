<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
include("conexion.php");

function printSricptBan(){
    ?>
        <script>  
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Has alcanzado el límite de intentos para iniciar sesión (3), por lo que debes esperar 30 segundos para intentarlo nuevamente',
                footer: ''
            })
            window.onload = updateClock;
            var totalTime = 30;
            function updateClock() {
   
            if(totalTime==0){
                $('#correo').attr('readonly', false);
                $('#contra').attr('readonly', false);
                $('#iniciar').removeAttr('disabled');
            }else{

                $('#correo').attr('readonly', true);
                $('#contra').attr('readonly', true);
                $('#iniciar').attr('disabled', 'disabled');
                totalTime-=1;
                setTimeout("updateClock()",1000);
                
            }
            }
                        
            </script>
    <?php
}


class Crud extends Conexion{

    private $conexion;


    function __construct()
    {
      
        $this->conexion=parent::conexion();
    }
    function recordarContra($correo){
        $sql="SELECT * FROM usuarios WHERE correo = '$correo';";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        $resultado=$consulta->fetch();
        if($resultado!=null){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $contra= substr(str_shuffle($permitted_chars), 0, 10);
            $sql="UPDATE usuarios SET contra = '$contra', confirmacion=0 WHERE correo = '$correo';";
            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->From = "mail@gmail.com"; 
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com"; 
            $mail->Port = 587;
            $mail->Username ='sgec.iesciudadescolar@gmail.com';
            $mail->Password = 'Mariagerardoyjossue1'; 
            $mail->AddAddress($correo);
            $mail->Subject = "Cambio de contrasena";
            $mail->Body = "Hola ".$resultado[1].",\n\nSu contraseña temporal es: ".$contra."\n\nPara activar su cuenta debe ingresar en nuestra web utilizando esta contraseña y seguidamente se le pedirá ingresar una nueva contraseña.\n\n\nIES Ciudad Escolar - Sistema de Gestión de Espacios Comunes";
            $mail->Send();
            return true;
        }
       
    }

    function enviarCorreo($asunto,$cuerpo,$correo){

        $mail = new PHPMailer();
        $mail->IsSMTP();
        
        $mail->From = "mail@gmail.com"; 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com"; 
        $mail->Port = 587;
        $mail->Username ='sgec.iesciudadescolar@gmail.com';
        $mail->Password = 'Mariagerardoyjossue1'; 
        $mail->AddAddress($correo);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->Send();
       

    }

    function verificarUsuario($correo,$contrasena){
        try{

            if (filter_var($correo, FILTER_VALIDATE_EMAIL) || $correo) {
                
                
                $_SESSION['correo']=$correo;

                $sql="SELECT * FROM usuarios WHERE (correo ='$correo' or usuario='$correo')";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                $verif3=$consulta->fetch();

                

                
                $sql="SELECT count(*) FROM usuarios WHERE (usuario='$correo' or correo ='$correo') and contra='$contrasena'";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                $verif4=$consulta->fetch();
                

                if($verif4[0]>0){
                    $idSesion =$verif3["id"];
                    $nombre =$verif3["nombre"];
                    $_SESSION['id']=$idSesion;
                    $_SESSION['nombre']=$nombre;


                    $rol =$verif3["rol"];
                 

                    $sql="SELECT * FROM roles WHERE id ='$rol'";
                    $consulta=$this->conexion->prepare($sql);
                    $consulta->execute();
                    $verif4=$consulta->fetch(); 
                
                    $_SESSION['crudRoles']=$verif4['crud_roles'];
                    $_SESSION['crudUsuarios']=$verif4['crud_usuarios'];
                    $_SESSION['crudAulas']=$verif4['crud_aulas'];
                    $_SESSION['crudReservas']=$verif4['crud_reservas'];
                    $_SESSION['crudGrupos']=$verif4['crud_grupos'];
                    $_SESSION['actualizarBBDD']=$verif4['actualizar_bbdd'];
                    $_SESSION['estadisticas']=$verif4['estadisticas'];
                    $_SESSION['crudFestivos']=$verif4['crud_festivos'];
                    $_SESSION['crudConfiguracion']=$verif4['crud_configuracion'];

                    $_SESSION['contra']=$contrasena;
                    $_SESSION['correo']=$correo;

              

                    return true;
                    
                }
                else if($verif3>0 && (password_verify($contrasena,$verif3["contra"]))){

                    $idSesion =$verif3["id"];
                    $nombre =$verif3["nombre"];

                    $_SESSION['id']=$idSesion;
                    $_SESSION['nombre']=$nombre;


                    $rol =$verif3["rol"];

                    $sql="SELECT * FROM roles WHERE id ='$rol'";
                    $consulta=$this->conexion->prepare($sql);
                    $consulta->execute();
                    $verif4=$consulta->fetch();
                
                    $_SESSION['crudRoles']=$verif4['crud_roles'];
                    $_SESSION['crudUsuarios']=$verif4['crud_usuarios'];
                    $_SESSION['crudAulas']=$verif4['crud_aulas'];
                    $_SESSION['crudReservas']=$verif4['crud_reservas'];
                    $_SESSION['crudGrupos']=$verif4['crud_grupos'];
                    $_SESSION['actualizarBBDD']=$verif4['actualizar_bbdd'];
                    $_SESSION['estadisticas']=$verif4['estadisticas'];
                    $_SESSION['crudFestivos']=$verif4['crud_festivos'];
                    $_SESSION['crudConfiguracion']=$verif4['crud_configuracion'];

                    $_SESSION['contra']=$contrasena;
                    $_SESSION['correo']=$correo;
                    
                    //$_SESSION["cambiado"]="ok";


                    return true;
                }else{
                    return false;
                }

            } else {
               return false;
            }

        }catch(PDOException $e){
                return $e;
        }
    }


    function verificarContra($correo){
        try{
            $sql="SELECT verificarContra(:email)";
            $consulta=$this->conexion->prepare($sql);
            $consulta->bindParam(":email",$correo);
            $consulta->execute();
            $verif1=$consulta->fetch();

            if($verif1[0]==1){
                return true;
            
            }else{
                return false;
            }
        }catch(PDOException $e){
            return $e;
        }
    }


    function contraNueva($correo,$contraN,$contraN2){

        try{
            $sql="SELECT * FROM usuarios WHERE correo='$correo' OR usuario='$correo';";
            $con=$this->conexion->prepare($sql);
            $con->execute();
            $consult=$con->fetchAll(PDO::FETCH_ASSOC);
            if($consult[0]!=NULL){
                if($contraN == $contraN2){
                    $expresion='/^\\S*(?=\\S{8,})(?=\\S*[\\+|\\|\\-|\\/])(?=\\S[a-z])(?=\\S*[A-Z])(?=\\S*[\\d])\\S*$/';

                    if(preg_match($expresion, $contraN)){
                        $contra=password_hash("$contraN", PASSWORD_DEFAULT);
                        $sql="CALL cambiarContra('$correo','$contraN')";
                        $con=$this->conexion->prepare($sql);
                        $con->execute();
                        
                        return true;
                        
                    }else{
                        return false;
                    }
                  
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
            

        }catch(PDOException $e){
            return $e;
        }
    }

    
    
    function obtieneTodos($tabla){
        try{
            $sql='SELECT * FROM '.$tabla;

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            return $consult;

        }catch(PDOException){
           
            return [];
        }
      
      
    }
    function obtieneRoles(){
        try{
            $sql='SELECT id,nombre FROM roles';

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            return $consult;

        }catch(PDOException){
           
            return [];
        }
      
      
    }

    function esFinde($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    function maximoDiasSiguientes(){
        $comprobar="SELECT valor FROM `configuracion` WHERE id = 1";
        $consulta_comprobar=$this->conexion()->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetch();
       
        return $resultado_comprobar['valor'];

    }
    

    function build_calendar($month, $year){
        
        $maximoDiasSiguientes=$this->maximoDiasSiguientes();
        $bookings = array();

        $sql="SELECT * from reservas where MONTH(fecha) = :mes AND YEAR(fecha)=:ano";

        $consulta=$this->conexion->prepare($sql);
        $consulta->bindParam(":mes",$month);
        $consulta->bindParam(":ano",$year);

        if($consulta->execute()){
            
            $consult=$consulta->fetchALL(PDO::FETCH_ASSOC);
            
            if(count($consult)>0){
               foreach($consult as $x){

                    $bookings[]= $x["fecha"];
               }            
            }
        }


        if(isset($_GET['id'])){
            $idAula=$_GET['id'];
        }
           
        // creamos el array con los días de la semana
        $daysOfWeek = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo');
    
        // saber cual es el primer día del mes
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    
        // cuantos dias tiene el mes
        $numberDays = date('t',$firstDayOfMonth);

        $dateComponents = getdate($firstDayOfMonth);
    
    
        //nombre del mes
        $monthName = $dateComponents['month'];
    
        $mesesES=array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $mesesEN=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        for($i=0;$i<count($mesesEN);$i++){

            if ($monthName==$mesesEN[$i]){

                $monthName = $mesesES[$i];
            }
        }
        //numero de la semana del primer día del mes
        $dayOfWeek = $dateComponents['wday'];
        
        //cremaos el calendario
        $calendar = "<div class='table-responsive' style='border:none;'>";
        
        $calendar .= "<table class=' table table-bordered border' style='width:100%;border:1px solid white !important'>";
        
        
        $calendar.= "<a href='?c=calendario&month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."&id=".$idAula."' ><i class='bi bi-chevron-left flechaCambiarMes'></i></a>";   
        $calendar .= "<h3 class='nombreMes'>$monthName $year</h3>";
        $calendar.= "<a href='?c=calendario&month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."&id=".$idAula."' ><i class='bi bi-chevron-right flechaCambiarMes'></i></a><br>";
        
        $calendar.= "<a href='?c=calendarioSemanal&id=".$idAula."' ><button class='btn btn-secondary'><i class='bi bi-calendar-week botonCambiarVista'> Vista semanal</i></button></a><br><br>";


        $calendar .= "<tr>";
    
        // Creamos las cabeceras
        foreach($daysOfWeek as $day) {
            $calendar .= "<th class='diaSemana'><b>$day</b></th>";
        } 
        
        // creamos el resto del calendario
        $currentDay = 2;
        $calendar .= "</tr><tr>";
    
         
    
        if($dayOfWeek > 0) { 
            for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 
            }
        }
        
         
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
        
        while ($currentDay <= $numberDays) {
             //cuando es domingo hacemos una nueva fila
             if ($dayOfWeek == 7) {
                 $dayOfWeek = 0;
                 $calendar .= "</tr><tr>";
             }
            
             $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
             $date = "$year-$month-$currentDayRel";
             $date2 = date('Y-m-d', strtotime("+$maximoDiasSiguientes day"));
             $finde= $this->esFinde($date);
             $festivo= $this->esFestivo($date);
             if($festivo){
                $calendar.="<td><h4 class='dia' style='color:#B8B8B8'>Festivo<br>$festivo</h4></td> ";
            }
             else if($date<date('Y-m-d')||$date>$date2||$finde==1){
                 $calendar.="<td><h4 class='dia' style='color:#D8D8D8;'>$currentDay</h4> ";
             }

             else{
                 
                 $calendar.="<td onMouseOver='overStyle(this)' onMouseOut='outStyle(this)'><h4 class='dia'>$currentDay</h4><a href='?c=calendario&date=".$date."&id=".$idAula."&month=$month&year=$year' class='btn btn-xs botonReservar' onClick='scroll(0, 100);' ><p class='textoBotonReservar'><b>Horarios</b></p></a>";
             }
             $calendar .="</td>";
             $currentDay++;
             $dayOfWeek++;
         }
         
         //pintamos los ultimos dias del mes si el mes no acaba en domingo
         if ($dayOfWeek != 7) { 
            $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 
            }
         }
         
        $calendar .= "</tr>";
        $calendar .= "</table>";
        $calendar .= "</div>";
        
        return $calendar;
    }

    function build_calendar_semanal(){
        $maximoDiasSiguientes=$this->maximoDiasSiguientes();
        $dt = new DateTime;
        if (isset($_GET['year']) && isset($_GET['week'])) {
            $dt->setISODate($_GET['year'], $_GET['week']);
        } else {
            $dt->setISODate($dt->format('o'), $dt->format('W'));
        }
        $year = $dt->format('o');
        $week = $dt->format('W');
        $horarios=array('08:30AM - 09:30AM', '09:30AM - 10:30AM', '10:30AM - 11:30AM', '11:30AM - 12:30AM', '12:30AM - 13:30PM', '13:30PM - 14:30PM');              
        $daysOfWeek = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo');
        $dateTime=$dt;
        $dateTime->setISODate($year,$week);
        $primerDiaSemana=$dateTime->format('Y-m-d');

        if(isset($_GET['id'])){
            $idAula=$_GET['id'];
        }
           
        $calendar = "<div class='table-responsive' style='border:none;'>";
        $calendar .= "<table class=' table table-bordered border' style='width:100%;border:1px solid white !important'>";
        
        
        
        $calendar.= "<a href='?c=calendarioSemanal&id=".$idAula."&week=".($week-1)."&year=".$year."'><i class='bi bi-chevron-left flechaCambiarSemana'></i></a>";   
        $calendar .= "<h3 class='nombreSemana'>Semana del $primerDiaSemana</h3>";
        $calendar.= "<a href='?c=calendarioSemanal&id=".$idAula."&week=".($week+1)."&year=".$year."'><i class='bi bi-chevron-right flechaCambiarSemana'></i></a><br>";
        $calendar.= "<a href='?c=calendario&id=".$idAula."' ><button class='btn btn-secondary'><i class='bi bi-calendar-week botonCambiarVista'> Vista mensual</i></button></a><br><br>";


        $calendar .= "<tr>";
        $calendar .= "<th  class='diaSemana' >Horarios</th>";
        
        $hoy = date('Y-m-d');
        
        /*SI SE QUIERE CAMBIAR EL MAXIMO DE DÍAS SIGUIENTES ENTRE LOS QUE SE PUEDE RESERVAR */
        $maximoDiasSiguientes = date('Y-m-d', strtotime("+$maximoDiasSiguientes day"));



        // Creamos las cabeceras
        foreach($daysOfWeek as $day) {
            $fecha = $dt->format('Y-m-d');
            $calendar .= "<th class='diaSemana'>$day<p>$fecha</p></th>";
            $dt->modify('+1 day');
        } 
        $dt = new DateTime;
        if (isset($_GET['year']) && isset($_GET['week'])) {
            $dt->setISODate($_GET['year'], $_GET['week']);
        } else {
            $dt->setISODate($dt->format('o'), $dt->format('W'));
        }
    $dt->setISODate($dt->format('o'), $dt->format('W'));
    $week = $dt->format('W');
 
        $calendar .= "</tr>";

        
        foreach($horarios as $hora) {

            $calendar.="<tr><td><h4 class='hora'>$hora</h4></td> ";

            while ($week == $dt->format('W')){

                $fecha = $dt->format('Y-m-d');
                $finde= $this->esFinde($fecha);
                $festivo= $this->esFestivo($fecha);
                $booking=$this->seteaDate2($_GET['id'],$fecha);

                if($festivo){
                    $calendar.="<td><h4 class='dia' style='color:#B8B8B8'>Festivo<br>$festivo</h5></td> ";
                }

                else if($fecha<$hoy||$fecha>$maximoDiasSiguientes||$finde==1){
                    $calendar.="<td><h4 class='dia' style='color:#D8D8D8'></h4></td> ";
                }


                else if(in_array($hora, $booking[0])){

                    $clave = array_search($hora, $booking[0]);
    
                    $calendar.="<td><a class='btn btn-danger botonReservado' disabled><p class='textoBotonReservar'>Reservado<br>Prof. ".$booking[1][$clave]."</p></a></td> ";
                    
                 }

                else{
                    $calendar.="<td onMouseOver='overStyle(this)' onMouseOut='outStyle(this)'><a href='?c=calendarioSemanal&date=".$fecha."&id=".$idAula."&hora=".$hora."&week=".$week."&year=".$year."' class='btn btn-success btn-xs botonReservar' ><p class='textoBotonReservar'>Reservar</p></a></td>";

                }

                $dt->modify('+1 day');
            
            } 
    
            $calendar.="</tr>";
            
                $dt = new DateTime;
                if (isset($_GET['year']) && isset($_GET['week'])) {
                    $dt->setISODate($_GET['year'], $_GET['week']);
                } else {
                    $dt->setISODate($dt->format('o'), $dt->format('W'));
                }
            $dt->setISODate($dt->format('o'), $dt->format('W'));
            $week = $dt->format('W');
        }
        $calendar .= "</table>";
        $calendar.="</div>";
        
        return $calendar;
    }








    function build_calendar_diario(){
        $maximoDiasSiguientes=$this->maximoDiasSiguientes();
        $aulas=array();
        $datos=$this->aulasDisponibles();

        foreach($datos as $aula){
            foreach($aula as $nombre){
                array_push($aulas, $nombre);
            }
        }

        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
        $next_date = date('Y-m-d', strtotime($date .' +1 day'));
                // Define key-value array
        $days_dias = array(
            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'
            );
            
            //lookup dia based on day name
            $dia =  $days_dias[date('l', strtotime($date))];

        $horarios=array('08:30AM - 09:30AM', '09:30AM - 10:30AM', '10:30AM - 11:30AM', '11:30AM - 12:30AM', '12:30AM - 13:30PM', '13:30PM - 14:30PM');              
 
        $calendar = "<div class='table-responsive' style='border:none;'>";
        $calendar .= "<table class=' table table-bordered border' style='width:100%;;border:1px solid white !important'>";
        
        
        
        $calendar.= "<a href='?c=calendarioDiario&date=".$prev_date."'><i class='bi bi-chevron-left flechaCambiarSemana'></i></a>";   
        $calendar .= "<h3 class='nombreSemana'>Horarios del día  $dia $date</h3>";
        $calendar.= "<a href='?c=calendarioDiario&date=".$next_date."'><i class='bi bi-chevron-right flechaCambiarSemana'></i></a><br>";


        $calendar .= "<tr>";
        $calendar .= "<th  class='diaSemana' >Horarios</th>";
        
        $hoy = date('Y-m-d');
        
        /*SI SE QUIERE CAMBIAR EL MAXIMO DE DÍAS SIGUIENTES ENTRE LOS QUE SE PUEDE RESERVAR */
        $maximoDiasSiguientes = date('Y-m-d', strtotime("+$maximoDiasSiguientes day"));



        // Creamos las cabeceras
        foreach($aulas as $nombre) {
            
            $calendar .= "<th class='diaSemana'>$nombre</th>";
            
        } 

 
        $calendar .= "</tr>";

        
        foreach($horarios as $hora) {

            $calendar.="<tr><td><h4 class='hora'>$hora</h4></td> ";

            foreach($aulas as $nombre){
                
                
                $finde= $this->esFinde($date);
                $festivo= $this->esFestivo($date);
                $booking=$this->seteaDate2($nombre, $date);

                if($festivo){
                    $calendar.="<td><h4 class='dia' style='color:#B8B8B8'>Festivo<br>$festivo</h5></td> ";
                }

                else if($date<$hoy||$date>$maximoDiasSiguientes||$finde==1){
                    $calendar.="<td><h4 class='dia' style='color:#D8D8D8'></h4></td> ";
                }


                else if(in_array($hora, $booking[0])){

                    $clave = array_search($hora, $booking[0]);
    
                    $calendar.="<td><a class='btn btn-danger botonReservado' disabled><p class='textoBotonReservar'>Reservado<br>Prof. ".$booking[1][$clave]."</p></a></td> ";
                    
                 }

                else{
                    $calendar.="<td onMouseOver='overStyle(this)' onMouseOut='outStyle(this)'><a href='?c=calendarioDiario&date=".$date."&id=".$nombre."&hora=".$hora."' class='btn btn-success btn-xs botonReservar' ><p class='textoBotonReservar'>Reservar</p></a></td>";

                }
            
            } 
    
            $calendar.="</tr>";
            
        }
        $calendar .= "</table>";
        $calendar.="</div>";
        
        return $calendar;
    }




    function seteaDate1($id,$fecha){

        $sql="SELECT * from reservas where fecha = :fecha AND idAula = :id ";

        $consulta=$this->conexion->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->bindParam(":fecha",$fecha);
        if($consulta->execute()){
            $consult=$consulta->fetchALL(PDO::FETCH_ASSOC);
            return $consult;
        }
     
    }
    function seteaDate2($id,$fecha){
        $datos = array();
        $bookings = array();
        $nombres = array();
       
        $sql="SELECT * from reservas where idAula = :id AND fecha = :fecha";
        $consulta=$this->conexion->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->bindParam(":fecha",$fecha);

        if($consulta->execute()){
            
            $consult=$consulta->fetchALL(PDO::FETCH_ASSOC);
            
            if(count($consult)>0){
               foreach($consult as $x){

                    $bookings[]= $x["hora"];
                    $idReservaUsuario=$x["idUsuario"];
                    $comprobar="SELECT nombre FROM `usuarios` WHERE id = '$idReservaUsuario'";
                    $consulta_comprobar=$this->conexion->prepare($comprobar);
                    $consulta_comprobar->execute();
                    $resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);
                    $nombres[]= $resultado_comprobar['nombre'];
                   
               }      
               
            }
             
        }
        $datos[0]=$bookings;
        $datos[1]=$nombres;
        return $datos;
    }



    function esFestivo($date){

        $comprobar="SELECT nombre, fechaInicio, fechaFinal FROM festivos GROUP BY nombre;";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
        $fechaComparar = strtotime($date);

        foreach($resultado_comprobar as $festivo){

            
            $inicioFestivo = strtotime($festivo['fechaInicio']);
            $finalFesitvo = strtotime($festivo['fechaFinal']);

            if($fechaComparar==$inicioFestivo||$fechaComparar==$finalFesitvo){
            return $festivo['nombre'];
            
            }

            else if($fechaComparar>$inicioFestivo and $fechaComparar<$finalFesitvo){

                return $festivo['nombre'];
            }

           

        }
        
    }
   


    function reservar($usuario,$grupo,$motivo,$timeslot,$idAula,$date){

        $sql="SELECT * from reservas where idAula = :idaula AND fecha = :fecha AND hora =:hora ";
        $consulta=$this->conexion->prepare($sql);
        $consulta->bindParam(":idaula",$idAula);
        $consulta->bindParam(":fecha",$date);
        $consulta->bindParam(":hora",$timeslot);

        if($consulta->execute()){
            
            $consult=$consulta->fetchALL(PDO::FETCH_ASSOC);
            
            if(count($consult)>0){
                 return false;        
            }else{
                $sql="INSERT INTO reservas (idAula, idUsuario, fecha, grupo, motivo,hora) VALUES (:idaula,:usuario,:fecha,:grupo,:motivo,:hora)";
                $consulta=$this->conexion->prepare($sql);
                $consulta->bindParam(":idaula",$idAula);
                $consulta->bindParam(":usuario",$usuario);
                $consulta->bindParam(":fecha",$date);
                $consulta->bindParam(":grupo",$grupo);
                $consulta->bindParam(":motivo",$motivo);
                $consulta->bindParam(":hora",$timeslot);
                $consulta->execute();
                return true;
                //$bookings[] = $timeslot;
             
            
            }
       
        }
      
    }

    /**********************CRUDS**************************** */
    function crudMiReservas($opc,$iteams_pagina=null,$offset=null){
        $idUsuario = $_SESSION['id'];   
        if($opc==1){

            $sql="SELECT count(*) FROM reservas WHERE idUsuario ='$idUsuario'";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT id,idAula as 'Aula', fecha as 'Fecha', hora as 'Hora', grupo as 'Grupo', motivo as 'Motivo', fecha_creacion as 'Fecha creación' FROM reservas WHERE idUsuario ='$idUsuario' ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }




    
    function crudReservas($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM reservas";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT reservas.id,  usuarios.nombre as 'Nombre', usuarios.primerApellido as 'Apellido', reservas.grupo, reservas.idAula as' Aula', reservas.fecha, reservas.hora, reservas.motivo, reservas.fecha_creacion
            FROM reservas
            inner join usuarios
            on reservas.idUsuario=usuarios.id LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }


    function crudUsuarios($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM usuarios";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT usuarios.id, usuarios.nombre as 'Nombre', usuarios.primerApellido as'1º apellido', usuarios.segundoApellido as '2º apellido', usuarios.usuario, usuarios.correo, usuarios.puesto, usuarios.confirmacion, usuarios.rol, roles.nombre as 'Rol'
            FROM usuarios 
            INNER JOIN roles
            on usuarios.rol=roles.id
            ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }


    function crudRoles($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM roles";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT id, nombre as 'Nombre', crud_roles as 'Gestionar roles', crud_usuarios as 'Gestionar usuarios', crud_aulas as 'Gestionar aulas', crud_grupos as 'Gestionar grupos', crud_festivos as 'Gestionar festivos', estadisticas as 'Gestionar estadísticas', crud_configuracion as 'Gestionar configuracion'
             FROM roles ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }



    function crudFestivos($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM festivos";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT * FROM festivos ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }


    function crudGrupos($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM grupos";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT * FROM grupos ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }

    function crudConfiguracion($opc,$iteams_pagina=null,$offset=null){
        if($opc==1){

            $sql="SELECT count(*) FROM configuracion";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT * FROM configuracion ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }

    /***************************FIN CRUDS************************ */

/*************************************  MODELO DE MIS RESERVAS   ********************************/
    
    function borrarUnoaUno($selec){
            
        $sql="DELETE FROM reservas WHERE  id=$selec";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        return true;
            
    }

    function borrar($selec){
      
        if(empty($selec)){
           
            return false;
        }
        else{
          
            foreach($selec as $valores){
                $sql="DELETE FROM reservas WHERE  id=$valores";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                
            }
            return true;
        }
        
        }  
 
    


   


    function modif($id){

         
        $nombres="SELECT * FROM reservas WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }

    function actualizar($indic){

        $comprobar="SELECT * FROM reservas WHERE id='".$indic[0]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

        $resultado = array_diff($resultado_comprobar, $indic);

        if(empty($resultado)){
            return 3;
		}

      
            $comprobar="SELECT * FROM reservas WHERE fecha='".$indic[3]."' AND  idAula='".$indic[1]."' AND  hora='".$indic[6]."';";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado_comprobar)>0){

                if($resultado_comprobar[0]['idUsuario']===$_SESSION['id']){
                    $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE reservas SET  ".$nombress[$i][0]."=:date  WHERE id=".$indic[0].";";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":date",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                    


                    return true;
                }

                else{
                    return false;
                }
            }
            else{
                $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE reservas SET  ".$nombress[$i][0]."=:date  WHERE id=".$indic[0].";";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":date",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                return true;
            }      
        
    }

    function aulasDisponibles(){

        $comprobar="SELECT id FROM `aulas` WHERE habilitado = 1 GROUP BY id";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
       
        return $resultado_comprobar;

    }

    function gruposDisponibles(){

        $comprobar="SELECT nombre FROM `grupos` GROUP BY nombre";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
       
        return $resultado_comprobar;

    }
    /*************************************  FIN MODELO DE MIS RESERVAS   ********************************/










    /*************************************  MODELO DE RESERVAS   ********************************/
    
    function borrarUnoaUnoReservas($selec){
            
        $sql="DELETE FROM reservas WHERE  id=$selec";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        return true;
            
    }

    function borrarReservas($selec){
      
        if(empty($selec)){
           
            return false;
        }
        else{
          
            foreach($selec as $valores){
                $sql="DELETE FROM reservas WHERE  id=$valores";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                
            }
            return true;
        }
        
        }  
 
    


   


    function modifReservas($id){

         
        $nombres="SELECT * FROM reservas WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }

    function actualizarReservas($indic){

        $comprobar="SELECT * FROM reservas WHERE id='".$indic[0]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

        $resultado = array_diff($resultado_comprobar, $indic);

        if(empty($resultado)){
            return 3;
		}

      
            $comprobar="SELECT * FROM reservas WHERE fecha='".$indic[3]."' AND  idAula='".$indic[1]."' AND  hora='".$indic[6]."';";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado_comprobar)>0){

                if($resultado_comprobar[0]['idUsuario']===$_SESSION['id']){
                    $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE reservas SET  ".$nombress[$i][0]."=:date  WHERE id=".$indic[0].";";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":date",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                    


                    return true;
                }

                else{
                    return false;
                }
            }
            else{
                $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE reservas SET  ".$nombress[$i][0]."=:date  WHERE id=".$indic[0].";";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":date",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                return true;
            }      
        
    }

    function aulasDisponiblesReservas(){

        $comprobar="SELECT id FROM `aulas` WHERE habilitado = 1 GROUP BY id";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
       
        return $resultado_comprobar;

    }

    function gruposDisponiblesReservas(){

        $comprobar="SELECT nombre FROM `grupos` GROUP BY nombre";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
       
        return $resultado_comprobar;

    }
    /*************************************  FIN MODELO DE RESERVAS   ********************************/




    /*************************************  MODELO DE AULAS   ********************************/
    function borrarUnoaUnoAulas($selec){
            
        $sql="DELETE FROM aulas WHERE  id='$selec'";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        return true;
            
    }

    function borrarAulas($selec){
      
        if(empty($selec)){
           
            return false;
        }
        else{
          
            foreach($selec as $valores){
                $sql="DELETE FROM aulas WHERE  id='$valores'";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                
            }
            return true;
        }
        
        }  
 
    


    function crudAulas($opc,$iteams_pagina=null,$offset=null){
         
        if($opc==1){

            $sql="SELECT count(*) FROM aulas";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $count=$consulta->fetch(PDO::FETCH_NUM);
            
            return $count;
        }
        elseif($opc==2){

                   
            $sql="SELECT id, id as 'Nombre', ubicacion as 'Ubicación', informacion as'Información', aforo as 'Aforo', habilitado as 'Habilitado', imagen FROM aulas ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
        }
       
        

    }

    function modifAulas($id){

         
        $nombres="SELECT * FROM aulas WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }

    function actualizarAulas($indic, $imagen){

        $comprobar="SELECT * FROM aulas WHERE id='".$indic[0]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

        $resultado = array_diff($resultado_comprobar, $indic);

        if(empty($resultado)){
            return false;
		}
        

            
                $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='aulas';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
                    
                    for($i=0;$i<count($nombress)-1;$i++){
                        
                        $sql="UPDATE aulas SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":data",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }

                    $sql="SELECT imagen FROM aulas WHERE id='".$indic[0]."';";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->execute();
                        $resultado_imagen=$stmt->fetch(PDO::FETCH_ASSOC);

                    if(empty($resultado_imagen['imagen'])){
                        
                        $defecto= $resultado_comprobar['imagen'];

                        $query = "UPDATE aulas SET imagen ='$defecto' WHERE id='".$indic[0]."';";
                       
                        $statement= $this->conexion->prepare($query);
                        $statement->execute();

                        }
                    
                    else{

                        // Prepared statement
                        $query = "UPDATE aulas SET imagen = (?)  WHERE id='".$indic[0]."';";
                    
                        $statement = $this->conexion->prepare($query);
                    

                            $filename = $imagen['name'];
                        
                            // Location
                            $target_file = 'libs/img/upload/'.$filename;
                        
                            // file extension
                            $file_extension = pathinfo(
                                $target_file, PATHINFO_EXTENSION);
                                
                            $file_extension = strtolower($file_extension);
                        
                            // Valid image extension
                            $valid_extension = array("png","jpeg","jpg");
                        
                            if(in_array($file_extension, $valid_extension)) {
                    
                                // Upload file
                                if(move_uploaded_file($imagen['tmp_name'],$target_file)) {
                    
                                    // Execute query
                                    $statement->execute(array($target_file));
                                    
                                }
                            }

                    }
        
                return true;
            }      
        
    

    function crearAulas($indic, $imagen){

            $comprobar="SELECT * FROM aulas WHERE id='".$indic[0]."';";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            $resultado_comprobar=$consulta_comprobar->fetchAll();
            if(count($resultado_comprobar)>0){
                return false;
			}
            
			else{
                $id = $indic[0];
				$ubicacion = $indic[1];
				$informacion =$indic[2];
				$aforo = $indic[3];
				$habilitado = $indic[4];
				
                $comprobar="INSERT INTO  aulas (id, ubicacion, informacion, aforo, habilitado) VALUES ('$id','$ubicacion','$informacion',$aforo,$habilitado);";
                $consulta_comprobar=$this->conexion->prepare($comprobar);
                $consulta_comprobar->execute();

                if(empty($imagen['name'])){

                    $query = "UPDATE aulas SET imagen = 'libs/img/upload/aulaDefecto.jpeg' WHERE id='".$indic[0]."';";
                   
                    $statement= $this->conexion->prepare($query);
                    $statement->execute();

                    }
                
                else{

                    // Prepared statement
                    $query = "UPDATE aulas SET imagen = (?)   WHERE id='".$indic[0]."';";
                
                    $statement = $this->conexion->prepare($query);
                

                        $filename = $imagen['name'];
                    
                        // Location
                        $target_file = 'libs/img/upload/'.$filename;
                    
                        // file extension
                        $file_extension = pathinfo(
                            $target_file, PATHINFO_EXTENSION);
                            
                        $file_extension = strtolower($file_extension);
                    
                        // Valid image extension
                        $valid_extension = array("png","jpeg","jpg");
                    
                        if(in_array($file_extension, $valid_extension)) {
                
                            // Upload file
                            if(move_uploaded_file($imagen['tmp_name'],$target_file)) {
                
                                // Execute query
                                $statement->execute(array($target_file));
                                
                            }
                        }

                }
                
                return true;

				
			
		}


			
	}

    

     /*************************************  FIN MODELO DE AULAS   ********************************/



     


     

    /*************************************  MODELO DE ROLES   ********************************/
    function borrarUnoaUnoRoles($selec){
            
        $sql="DELETE FROM roles WHERE  id='$selec'";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        return true;
            
    }

    function borrarRoles($selec){
      
        if(empty($selec)){
           
            return false;
        }
        else{
          
            foreach($selec as $valores){
                $sql="DELETE FROM roles WHERE  id='$valores'";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                
            }
            return true;
        }
        
        }  
 
    


    

        function modifRoles($id){

         
            $nombres="SELECT * FROM roles WHERE id=:cod;";
            $consulta_nombres=$this->conexion->prepare($nombres);
            $consulta_nombres->bindParam(':cod',$id);
            $consulta_nombres->execute();
            $resultado_nombres=$consulta_nombres->fetchAll();
    
            return $resultado_nombres;
        }
    

    function actualizarRoles($indic){
        $comprobar="SELECT * FROM roles WHERE id='".$indic[0]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

        $resultado = array_diff($resultado_comprobar, $indic);

       /*SI DEJO ESTO LA ACTUALIZACIÓN NO VA
        if(empty($resultado)){
            return false;
		}
        */
           
                $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='roles';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE roles SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":data",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                return true;
            
            }      
        

    function crearRoles($indic){

				$nombre = $indic[0];
				$crud_roles =$indic[1];
				$crud_usuarios = $indic[2];
				$crud_aulas = $indic[3];
                $crud_reservas = $indic[4];
				$crud_grupos = $indic[5];
                $crud_festivos = $indic[6];
                $estadisticas = $indic[7];
                $configuracion = $indic[8];
				
                $comprobar="INSERT INTO  roles VALUES ('','$nombre',$crud_roles,$crud_usuarios,$crud_aulas, $crud_reservas, $crud_grupos, $crud_festivos, $estadisticas, $configuracion);";
                $consulta_comprobar=$this->conexion->prepare($comprobar);
                $consulta_comprobar->execute();
                
                return true;

	}

    

     /*************************************  FIN MODELO DE ROLES   ********************************/






    /*************************************  MODELO DE USUARIOS   ********************************/
    function borrarUnoaUnoUsuarios($selec){
            
        $sql="DELETE FROM usuarios WHERE  id='$selec'";
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        return true;
            
    }

    function borrarUsuarios($selec){
      
        if(empty($selec)){
           
            return false;
        }
        else{
          
            foreach($selec as $valores){
                $sql="DELETE FROM usuarios WHERE  id='$valores'";
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute();
                
            }
            return true;
        }
        
        }  
 
    


    

        function modifUsuarios($id){

         
            $nombres="SELECT * FROM usuarios WHERE id=:cod;";
            $consulta_nombres=$this->conexion->prepare($nombres);
            $consulta_nombres->bindParam(':cod',$id);
            $consulta_nombres->execute();
            $resultado_nombres=$consulta_nombres->fetchAll();
    
            return $resultado_nombres;
        }
    

    function actualizarUsuarios($indic){
        $comprobar="SELECT * FROM usuarios WHERE id='".$indic[0]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

        $resultado = array_diff($resultado_comprobar, $indic);

       /*SI DEJO ESTO LA ACTUALIZACIÓN NO VA
        if(empty($resultado)){
            return false;
		}
        */
           
                $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='usuarios';";
                $consulta_nombres=$this->conexion->prepare($nombres);
                $consulta_nombres->execute();
                $resultado_nombres=$consulta_nombres->fetchAll();
                    foreach($resultado_nombres as $nombre_columna){	
                        for($i=0;$i<count($nombre_columna)/2;$i++){
                            $nombress[]=$nombre_columna;
                        }
                    }
        
                    for($i=0;$i<count($nombress);$i++){
                        
                        $sql="UPDATE usuarios SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                        $stmt=$this->conexion->prepare($sql);
                        $stmt->bindParam(":data",$indic[$i]);
                        $stmt->execute();
                        
                        
                    }
                return true;
            
            }      
        

    function crearUsuarios($indic){

            $comprobar="SELECT * FROM usuarios WHERE id='".$indic[0]."';";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            $resultado_comprobar=$consulta_comprobar->fetchAll();
            if(count($resultado_comprobar)>0){
                return false;
			}
            
			else{
				$nombre = $indic[1];
				$correo =$indic[2];
                $primerApellido=$indic[3];
                $segundoApellido=$indic[4];
                $usuario=$indic[5];
                $puesto=$indic[6];
                $contra=$indic[7];
				$confirmacion = $indic[8];
                $rol = $indic[9];
				

                $comprobar="INSERT INTO  usuarios VALUES (null,'$nombre','$correo','$primerApellido','$segundoApellido','$usuario','$puesto','$contra','$confirmacion', '$rol');";
                $consulta_comprobar=$this->conexion->prepare($comprobar);
                $consulta_comprobar->execute();
                
                return true;

				
			
		}


			
	}

    function cargarUsuarios(){
        
        $filename=$_FILES["file"]["name"];
        $info = new SplFileInfo($filename);
        $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
      
         if($extension === 'csv' || $extension==='txt'){
            $filename = $_FILES['file']['tmp_name'];
            $open = fopen($filename, "r");
            while (!feof($open)){
                $getTextLine = fgets($open);
                $explodeLine = explode(",",$getTextLine);
                list($nombre,$primerApellido,$segundoApellido,$usuario,$puesto) = $explodeLine;
                /*Lo que hacemos es con utf8_encode mostrar todo con tildes y con la función trim eliminamos las comillas dobles si las hubiera
                porque en el csv de prueba venía con comillas dobles entonces si existen las elimina*/
                $nombre1=utf8_encode(trim($nombre,'"'));
                $primerApellido1=utf8_encode(trim($primerApellido,'"'));
                $segundoApellido1=utf8_encode(trim($segundoApellido,'"'));
                $usuario1=utf8_encode(trim($usuario,'"'));
                $puesto1=utf8_encode(trim($puesto,'"'));
                $puestoDef=explode("-", $puesto1);
                $correo=$usuario1."@ciudadescolarfp.es";
                echo "hola";
                echo $getTextLine[0];
                // Eliminamos la cabecera
                if($nombre=="Nombre" || $nombre=="" || $nombre=='"Nombre"'){
                    continue;
                }else{
                    $qry = "SELECT * from usuarios where correo='".$correo."' ; ";
                    $consulta= $this->conexion->prepare($qry);
                    $consulta->execute();
                    $resultado_nombres=$consulta->fetchAll();
                    if($resultado_nombres==null){
                        $qry = "INSERT INTO usuarios (nombre,correo, primerApellido, segundoApellido, usuario, puesto,contra, confirmacion, rol) values('$nombre1','$correo','$primerApellido1','$segundoApellido1','$usuario1','".$puestoDef[0]."','$usuario1','0','2'); ";
                        $consulta=$this->conexion->prepare($qry);
                        $consulta->execute();
                    }
    
                }
            }
            
            fclose($open);
            return true;    
        }else{
            return false;
        }
        
         
    }
        
       
    
    


     /*************************************  FIN MODELO DE USUARIOS   ********************************/





/*************************************  MODELO DE GRUPOS   ********************************/
function borrarUnoaUnoGrupos($selec){
            
    $sql="DELETE FROM grupos WHERE  id='$selec'";
    $consulta=$this->conexion->prepare($sql);
    $consulta->execute();
    return true;
        
}

function borrarGrupos($selec){
  
    if(empty($selec)){
       
        return false;
    }
    else{
      
        foreach($selec as $valores){
            $sql="DELETE FROM grupos WHERE  id='$valores'";
            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            
        }
        return true;
    }
    
    }  






    function modifGrupos($id){

     
        $nombres="SELECT * FROM grupos WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }


function actualizarGrupos($indic){
   /* $comprobar="SELECT * FROM grupos WHERE id='".$indic[0]."';";
    $consulta_comprobar=$this->conexion->prepare($comprobar);
    $consulta_comprobar->execute();
    $resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

    $resultado = array_diff($resultado_comprobar, $indic);

   SI DEJO ESTO LA ACTUALIZACIÓN NO VA
    if(empty($resultado)){
        return false;
    }
    */
       
            $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='grupos';";
            $consulta_nombres=$this->conexion->prepare($nombres);
            $consulta_nombres->execute();
            $resultado_nombres=$consulta_nombres->fetchAll();
                foreach($resultado_nombres as $nombre_columna){	
                    for($i=0;$i<count($nombre_columna)/2;$i++){
                        $nombress[]=$nombre_columna;
                    }
                }
    
                for($i=0;$i<count($nombress);$i++){
                    
                    $sql="UPDATE grupos SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                    $stmt=$this->conexion->prepare($sql);
                    $stmt->bindParam(":data",$indic[$i]);
                    $stmt->execute();
                    
                    
                }
            return true;
        
        }      
    

function crearGrupos($indic){

        $comprobar="SELECT * FROM grupos WHERE nombre='".$indic[0]."';";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll();
        if(count($resultado_comprobar)>0){
            return false;
        }
        
        else{
            $nombre = $indic[0];
            $departamento =$indic[1];
           
            

            
            $comprobar="INSERT INTO  grupos VALUES ('','$nombre','$departamento');";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            
            return true;

            
        
    }


        
}



 /*************************************  FIN MODELO DE GRUPOS   ********************************/



/*************************************  MODELO DE FESTIVOS   ********************************/
function borrarUnoaUnoFestivos($selec){
            
    $sql="DELETE FROM festivos WHERE  id='$selec'";
    $consulta=$this->conexion->prepare($sql);
    $consulta->execute();
    return true;
        
}

function borrarFestivos($selec){
  
    if(empty($selec)){
       
        return false;
    }
    else{
      
        foreach($selec as $valores){
            $sql="DELETE FROM festivos WHERE  id='$valores'";
            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            
        }
        return true;
    }
    
    }  






    function modifFestivos($id){

     
        $nombres="SELECT * FROM festivos WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }


function actualizarFestivos($indic){
    $comprobar="SELECT * FROM festivos WHERE id='".$indic[0]."';";
    $consulta_comprobar=$this->conexion->prepare($comprobar);
    $consulta_comprobar->execute();
    $resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

    $resultado = array_diff($resultado_comprobar, $indic);

   /*SI DEJO ESTO LA ACTUALIZACIÓN NO VA
    if(empty($resultado)){
        return false;
    }
    */
       
            $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='festivos';";
            $consulta_nombres=$this->conexion->prepare($nombres);
            $consulta_nombres->execute();
            $resultado_nombres=$consulta_nombres->fetchAll();
                foreach($resultado_nombres as $nombre_columna){	
                    for($i=0;$i<count($nombre_columna)/2;$i++){
                        $nombress[]=$nombre_columna;
                    }
                }
    
                for($i=0;$i<count($nombress);$i++){
                    
                    $sql="UPDATE festivos SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                    $stmt=$this->conexion->prepare($sql);
                    $stmt->bindParam(":data",$indic[$i]);
                    $stmt->execute();
                    
                    
                }
            return true;
        
        }      
    

function crearFestivos($indic){

        $comprobar="SELECT * FROM festivos WHERE Nombre='".$indic[0]."';";
        $consulta_comprobar=$this->conexion->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetchAll();
        if(count($resultado_comprobar)>0){
            return false;
        }
        
        else{
            
            $nombre = $indic[0];
            $fechainicio =$indic[1];
            $fechafin =$indic[2];
            
                $comprobar="INSERT INTO  festivos (Nombre, fechaInicio, fechaFinal) VALUES ('$nombre','$fechainicio','$fechafin');";
                $consulta_comprobar=$this->conexion->prepare($comprobar);
                $consulta_comprobar->execute();
                
                return true;
            

            


            
        
    }


        
}



 /*************************************  FIN MODELO DE FESTIVOS   ********************************/




/*************************************  MODELO DE CONFIGURACION   ********************************/
function borrarUnoaUnoConfiguracion($selec){
            
    $sql="DELETE FROM configuracion WHERE  id='$selec'";
    $consulta=$this->conexion->prepare($sql);
    $consulta->execute();
    return true;
        
}

function borrarConfiguracion($selec){
  
    if(empty($selec)){
       
        return false;
    }
    else{
      
        foreach($selec as $valores){
            $sql="DELETE FROM configuracion WHERE  id='$valores'";
            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            
        }
        return true;
    }
    
    }  






    function modifConfiguracion($id){

     
        $nombres="SELECT * FROM configuracion WHERE id=:cod;";
        $consulta_nombres=$this->conexion->prepare($nombres);
        $consulta_nombres->bindParam(':cod',$id);
        $consulta_nombres->execute();
        $resultado_nombres=$consulta_nombres->fetchAll();

        return $resultado_nombres;
    }


function actualizarConfiguracion($indic){
    $comprobar="SELECT * FROM configuracion WHERE id='".$indic[0]."';";
    $consulta_comprobar=$this->conexion->prepare($comprobar);
    $consulta_comprobar->execute();
    $resultado_comprobar=$consulta_comprobar->fetch(PDO::FETCH_ASSOC);

    $resultado = array_diff($resultado_comprobar, $indic);

   /*SI DEJO ESTO LA ACTUALIZACIÓN NO VA
    if(empty($resultado)){
        return false;
    }
    */
       
            $nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='configuracion';";
            $consulta_nombres=$this->conexion->prepare($nombres);
            $consulta_nombres->execute();
            $resultado_nombres=$consulta_nombres->fetchAll();
                foreach($resultado_nombres as $nombre_columna){	
                    for($i=0;$i<count($nombre_columna)/2;$i++){
                        $nombress[]=$nombre_columna;
                    }
                }
    
                for($i=0;$i<count($nombress);$i++){
                    
                    $sql="UPDATE configuracion SET  ".$nombress[$i][0]."=:data  WHERE id='".$indic[0]."';";
                    $stmt=$this->conexion->prepare($sql);
                    $stmt->bindParam(":data",$indic[$i]);
                    $stmt->execute();
                    
                    
                }
            return true;
        
        }      
    

function crearConfiguracion($indic){

            $nombre = $indic[1];
            $valor =$indic[2];

            $comprobar="INSERT INTO  configuracion VALUES ('','$nombre','$valor');";
            $consulta_comprobar=$this->conexion->prepare($comprobar);
            $consulta_comprobar->execute();
            
            return true;
        
}



 /*************************************  FIN MODELO DE CONFIGURACION ********************************/
















}








?>