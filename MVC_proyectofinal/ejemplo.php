<?php

class Precio{

    public function conexion(){
        try{
            $conexion=new PDO("mysql:host=127.0.0.1:33065;dbname=sgec","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
   
        }
    }
   
    function verificarUsuario($correo,$contrasena){
        try{

            $sql="SELECT ValidarCorreo(:email)";
            $consulta=$this->conexion()->prepare($sql);
            $consulta->bindParam(":email",$correo);
            $consulta->execute();
            $verif1=$consulta->fetch();

            
            if($verif1[0]==1){

                $sql="SELECT ValidarUsuario(:email,:contra)";
                $consulta2=$this->conexion()->prepare($sql);
                $consulta2->bindParam(":email",$correo);
                $consulta2->bindParam(":contra",$contrasena);
                $consulta2->execute();
                $verif2=$consulta2->fetch();

                if($verif2[0]==1){
                    return "Existe";
                }else{
                    return "No Existe";
                }
              
               
            }else{
                return "no sirve";
            }
      


            /*
            $sql="SELECT * FROM usuarios WHERE correo =:email;";

            $consulta=$this->conexion->prepare($sql);
            $consulta->bindParam(":email",$correo);
            $consulta->execute();
            $resultado=$consulta->fetch();

            if($resultado>0 && $resultado["contra"]==$contrasena){
        
                return true;

            }else{
                return false;
            }  */

        }catch(PDOException $e){
                return $e;
        }
    
    
    }
    
    function v_contra($correo){

        $sql="CALL BuscarId(:email)";
        $consulta=$this->conexion()->prepare($sql);
        $consulta->bindParam(":email",$correo);
        $consulta->execute();
        $verif1=$consulta->fetch();

        if($verif1[1]==1){
            return true;
           
        }else{
            return false;
        }
    }

  
    function contraNueva($correo,$contraN,$contraN2){

        try{
            $sql="CALL BuscarId(:email)";
            $consulta=$this->conexion()->prepare($sql);
            $consulta->bindParam(":email",$correo);
            $consulta->execute();
            $verif1=$consulta->fetch();

            if($contraN == $contraN2){

                $sql="CALL cambiarContra($verif1[0],'$contraN')";
                /*$sql="UPDATE usuarios
                set contra=$contraN, c_contra=1
                where id_usuario=$verif1[0];";
                */
                $con=$this->conexion()->prepare($sql);
                $con->execute();
                return true;
                
            }else{
                return false;
            }

           

        }catch(PDOException $e){
            return $e;
        }
    }





    function book($month,$year){
      
        $bookings = array();

        $sql="SELECT * from reservas where MONTH(fecha) = :mes AND YEAR(fecha)=:ano";

        $consulta=$this->conexion()->prepare($sql);
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
        return $bookings;
    }
    function crudMiReservas($opc,$iteams_pagina=null,$offset=null){

        if($opc==1){
            
            $count=2;
            return $count;
        }
        elseif($opc==2){
           
           $dia="jueves"; 
          $hola = $iteams_pagina  + $offset;
          return array($dia,$hola);        
          
        }
    }
       

}



$precio=new Precio();

$dia=$precio->crudMiReservas(2,2,3);
echo $dia[1];

exit();
print_r($precio->contraNueva("josue@hotmail.com","gerardo","gerardo"));

/*
?>

<form class="login-form" action="" method="post">
    <input type="text" name="correo">
                <input type="password"  name="contrasena1" placeholder="Contraseña Nueva" required>
               <input type="password" name="contrasena2" placeholder="Confirmar Contraseña" required>
                <button>Confirmar</button>
            </form>

<?php
print_r($precio->contraNueva($_POST["correo"],$_POST["contrasena1"],$_POST["contrasena2"]));
?>
*/

function buildCalendar($month,$year){

    $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d'); 
    $calendar = "<table class='table table-bordered' border=1>"; 
    $calendar .= "<center><h2>$monthName $year</h2>"; 
    $calendar .= "<tr>"; 
    // Create the calendar headers 
    foreach($daysOfWeek as $day) { 
        if($day=="Saturday" || $day=="Sunday"){
            $calendar .= "<th class='header' style='display: none;'>$day</th>"; 
        }else{
            $calendar .= "<th class='header'>$day</th>"; 
        }
       
    } 
 
  
   // Create the rest of the calendar
   // Initiate the day counter, starting with the 1st. 
   $currentDay = 1;
   $calendar .= "</tr><tr>";
   // The variable $dayOfWeek is used to 
   // ensure that the calendar 
   // display consists of exactly 7 columns.
   if($dayOfWeek > 0) { 
       for($k=0;$k<$dayOfWeek;$k++){ 
           $calendar .= "<td class='empty'></td>"; 
       } 
   }
   $month = str_pad($month, 2, "0", STR_PAD_LEFT);
   while ($currentDay <= $numberDays) { 
       //Seventh column (Saturday) reached. Start a new row. 
       if ($dayOfWeek == 7) { 
           $dayOfWeek = 0; 
           $calendar .= "</tr><tr>"; 
       } 
       $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT); 
       $date = "$year-$month-$currentDayRel"; 
       $dayname = strtolower(date('l', strtotime($date))); 
       $eventNum = 0; 
       $today = $date==date('Y-m-d')? "today" : "";
       $calendar.="<td><h4>$currentDay</h4>"; 
       $calendar .="</td>"; 
       //Increment counters 
       $currentDay++; 
       $dayOfWeek++; 
   } 
   //Complete the row of the last week in month, if necessary 
   if ($dayOfWeek != 7) { 
       $remainingDays = 7 - $dayOfWeek; 
       for($l=0;$l<$remainingDays;$l++){ 
           $calendar .= "<td class='empty'></td>"; 
       } 
   } 
   
    $calendar .= "</tr>"; 
    $calendar .= "</table>";
    echo $calendar;
   

}

?>
<body> 

     <?php 
      $dateComponents = getdate(); 
      $month = $dateComponents['mon']; 
      $year = $dateComponents['year']; 
      echo buildCalendar($month,$year); 
     ?> 
    <h1 style="display: none;"></h1>
</body>

<?php







$email = 'jossue@hotmail.com';
 
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email valido";
} else {
    echo 'Email no valido';
}

?>