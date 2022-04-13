<?php

include("conexion.php");

class Crud extends Conexion{

    private $conexion;


    function __construct()
    {
      
        $this->conexion=parent::conexion();
    }



    function verificarUsuario($correo,$contrasena){
        try{

            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
               
                $sql="SELECT ValidarUsuario(:email,:contra)";
                $consulta=$this->conexion->prepare($sql);
                $consulta->bindParam(":email",$correo);
                $consulta->bindParam(":contra",$contrasena);
                $consulta->execute();
                $verif2=$consulta->fetch();
   

                if($verif2[0]==1){

                    $sql="SELECT id, nombre, rol FROM usuarios WHERE correo ='$correo'";
                    $consulta=$this->conexion->prepare($sql);
                    $consulta->execute();
                    $verif3=$consulta->fetch();

                    $idSesion =$verif3[0];
                    $nombre =$verif3[1];

                    $_SESSION['id']=$idSesion;
                    $_SESSION['nombre']=$nombre;
                    

                    $rol =$verif3[1];

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

            if($contraN == $contraN2){

                $sql="CALL cambiarContra('$correo','$contraN')";
                $con=$this->conexion->prepare($sql);
                $con->execute();
                return true;
                
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


    function esFinde($date) {
        return (date('N', strtotime($date)) >= 6);
    }
    

    function build_calendar($month, $year){
        

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
    
        //numero de la semana del primer día del mes
        $dayOfWeek = $dateComponents['wday'];
    
        //cremaos el calendario
         
        $datetoday = date('Y-m-d');
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h3>$monthName $year</h3>";
        
        $calendar.= " <a href='?c=calendario&id=".$idAula."' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Mes actual</a> ";
        
        $calendar.= "<a href='?c=calendario&month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."&id=".$idAula."' class='btn btn-xs btn-primary'>Siguiente mes ➜</a></center><br>";
        

        $calendar .= "<tr>";
    
        // Creamos las cabeceras
        foreach($daysOfWeek as $day) {
            $calendar .= "<th  class='header'>$day</th>";
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
             $today = $date==date('Y-m-d')? "today" : "";
             $date2 = date('Y-m-d', strtotime("+14 day"));
             $finde= $this->esFinde($date);
             if($date<date('Y-m-d')||$date>$date2||$finde==1){
                 $calendar.="<td><h4>$currentDay</h4> ";
             }
             else{
                 $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='?c=calendario&date=".$date."&id=".$idAula."'' class='btn btn-info btn-xs'>Horarios</a>";
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
        return $calendar;
    }



    function timeslots($duration, $cleanup, $start, $end){

        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval("PT".$duration."M");
        $cleanupInterval = new DateInterval("PT".$cleanup."M");
        $slots = array();
        
        for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);
            if($endPeriod>$end){
                break;
            }
            
            $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
            
        }
        
        return $slots;
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

        $bookings = array();
        $sql="SELECT * from reservas where idAula = :id AND fecha = :fecha";
        $consulta=$this->conexion->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->bindParam(":fecha",$fecha);

        if($consulta->execute()){
            
            $consult=$consulta->fetchALL(PDO::FETCH_ASSOC);
            
            if(count($consult)>0){
               foreach($consult as $x){

                    $bookings[]= $x["hora"];
               }            
            }
        }
        return $bookings;
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

                   
            $sql="SELECT * FROM reservas WHERE idUsuario ='$idUsuario' ORDER BY id ASC LIMIT ".$iteams_pagina." OFFSET ".$offset."";

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return array($consult,$keys);
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

        $comprobar="SELECT * FROM reservas WHERE fecha='".$indic[3]."' AND  idAula='".$indic[1]."' AND  hora='".$indic[6]."';";
		$consulta_comprobar=$this->conexion->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetchAll();
		if(count($resultado_comprobar)>0){
            return false;
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


    /*------------------------------------------------------------------------- */

    function obtenerTablas(){
        
        $sql='SHOW TABLES FROM protectora_animales';
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        $consult=$consulta->fetchAll(PDO::FETCH_COLUMN);
        return $consult; 
    }
    
    function obtieneCampos($tabla){
        try{
            $sql='SELECT * FROM '.$tabla;

            $consulta=$this->conexion->prepare($sql);
            $consulta->execute();
            $consult=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $keys=array_keys($consult[0]);
            return $keys;

        }catch(PDOException){
            return [];
        }
      
        
    }


  

    function obtieneDeId($tabla,$id){
        try{
            $sql='SELECT * FROM '.$tabla.' WHERE  id='.$id;
            $ver=$this->conexion->prepare($sql);
            $ver->execute();
            $_ver=$ver->fetchAll(PDO::FETCH_ASSOC);
            return $_ver;  

        }catch(PDOException $e){
            echo "<tr><td style='text-align:center'><h1>Fallo</h1></td></tr>";
            return [];
        }
      
       
      
    
    }
/*
    function borrar($tabla,$id){

        if($this->obtieneDeId($tabla,$id)==null){

            echo "No existe ese Id";

        }else{
            $sql='DELETE FROM '.$tabla.' WHERE  id='.$id;
            $borrar=$this->conexion->prepare($sql);
            $borrar->execute();
           
        }
    }

*/












    function crear($tabla){

        try{
            $sql="INSERT INTO ".$tabla."(";
            foreach($this->obtieneCampos($tabla) as $indice){
    
                $sql.=$indice.",";
            }
            $sql=trim($sql,",");
            $sql.=") VALUES( ";
            foreach($this->obtieneCampos($tabla) as $indice){
                
                $sql.="'$_POST[$indice]'".",";
            }
    
            $sql=trim($sql,",");
            $sql.=")";
            
            $añadir=$this->conexion->prepare($sql);
    
            $añadir->execute();

        }catch(PDOException){
          
           return null;
            
           
        }
      
    
    }
 

 
}




?>