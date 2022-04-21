<?php session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.php");
}
include "menu1.php";
include "/libs/js/scripts.js"?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<style>
    .container-fluid{
        display:none
    }
    #wrapper{
        top: 0px;
    position: absolute;
    left: 0px;
    right: 0px;
    bottom: 0px;
    }


    
    @media only screen and (max-width: 760px),
(min-device-width: 802px) and (max-device-width: 1020px) {

/* Force table to not be like tables anymore */




/* Hide table headers (but not display: none;, for accessibility) */
th {
    position: absolute;
    top: -9999px;
    left: -9999px;
}

tr {
    border: 1px solid #ccc;
}

td {
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
}



/*
Información de las cabeceras*/
td:nth-of-type(1):before {
    content: "Lunes";
}
td:nth-of-type(2):before {
    content: "Martes";
}
td:nth-of-type(3):before {
    content: "Miercoles";
}
td:nth-of-type(4):before {
    content: "Jueves";
}
td:nth-of-type(5):before {
    content: "Viernes";
}
td:nth-of-type(6):before {
    content: "Sabado";
}
td:nth-of-type(7):before {
    content: "Domingo";
}


}
</style>
    <title>sgec</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <div class="contenedor">
                <?php 
function esFinde($date) {
    return (date('N', strtotime($date)) >= 6);
}

function build_calendar($month, $year) {


        $mysqli = new mysqli('localhost', 'root', '', 'sgec');
        $stmt = $mysqli->prepare("select * from reservas where MONTH(fecha) = ? AND YEAR(fecha)=?");
        $stmt->bind_param('ss', $month, $year);
        $bookings = array();
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $bookings[] = $row['fecha'];
                }
                $stmt->close();
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
        
        $calendar.= " <a href='calendario.php?id=".$idAula."' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Mes actual</a> ";
        
        $calendar.= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."&id=".$idAula."' class='btn btn-xs btn-primary'>Siguiente mes ➜</a></center><br>";
        

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
             $finde= esFinde($date);
             if($date<date('Y-m-d')||$date>$date2||$finde==1){
                 $calendar.="<td><h4>$currentDay</h4> ";
             }
             else{
                 $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='calendario.php?date=".$date."&id=".$idAula."'' class='btn btn-info btn-xs'>Horarios</a>";
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


?>

<body> 
<div class="container bg-white rounded shadow p-1 mb-5 bg-white rounded" style="padding-left:100px">
<div class="card-body">
  </div>
 <div class="container"> 
 <div class="row text-center"> 

 <a href="index.php" title="Cancelar"><button type="button" class="close" style="font-size:3.5em">&times;</button></a>

     <?php if(isset($_GET['id'])){
            echo "<h1 class='mx-auto' style='color:#202020'> Reserva para el ".$_GET['id']."</h1>";
        }?>
 </div> 
  <div class="row"> 
   <div class="col-md-12"> 
    <div id="calendario" style="width: 80%;" class='mx-auto'> 
     <?php 

      if(isset($_GET["month"])){
        $month = $_GET['month']; 
        $year = $_GET['year']; 
        echo build_calendar($month,$year); 
      }
      else{
        $dateComponents = getdate(); 
        $month = $dateComponents['mon']; 
        $year = $dateComponents['year']; 
        echo build_calendar($month,$year); 
      }
     ?> 
    </div> 
   </div> 
  </div> 
 </div> 
 <?php 
 
 if(isset($_GET['date'])){



//PARTE DE RESERVA EN LOS TRAMOS HORARIOS
$duration = 60;
$cleanup = 0;
$start = "08:30";
$end = "14:30";



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

$mysqli = new mysqli('localhost', 'root', '', 'sgec');

    $idAula=$_GET['id'];
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from reservas where fecha = ? AND idAula = ? ");
    $stmt->bind_param('ss', $date, $idAula);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
    }


if(isset($_POST['submit'])){
    $usuario = $_SESSION['id'];
    $grupo = $_POST['grupo'];
    $motivo = $_POST['motivo'];
    $timeslot = $_POST['timeslot'];
    $stmt = $mysqli->prepare("select * from reservas where idAula = ? AND fecha = ? AND hora =? ");
    $stmt->bind_param('sss',$idAula, $date, $timeslot);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Ya reservado</div>";
        }else{
            $stmt = $mysqli->prepare("INSERT INTO reservas (idAula, idUsuario, fecha, grupo, motivo,hora) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('ssssss', $idAula, $usuario, $date, $grupo, $motivo, $timeslot );
            $stmt->execute();
            $msg = " <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva realizada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
            $bookings[] = $timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }
}

$mysqli = new mysqli('localhost', 'root', '', 'sgec');

    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from reservas where idAula = ? AND fecha = ?");
    $stmt->bind_param('ss', $idAula,$date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['hora'];
            }
            $stmt->close();
        }
    }


?>

    <div class="container" style="width: 80%;">
    <h1 class='mx-auto text-center' style='color:#202020'>Horarios del día: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
<div class="col-md-12">
   <?php echo(isset($msg))?$msg:""; ?>
</div>
<?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
    foreach($timeslots as $ts){
?>
<div class="col-md-2">
    <div class="form-group">
       <?php if(in_array($ts, $bookings)){ ?>
       <button class="btn btn-danger"><?php echo $ts; ?></button>
       <?php }else{ ?>
       <button class="btn btn-info book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
       <?php }  ?>
    </div>
</div>
<?php } ?>
</div>
       </div>
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reservado de <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                               <div class="form-group">
                                    <label for="">Franja</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot">
                                </div>
                                <div class="form-group">
                                    <label for="">Grupo</label>
                                    <input required type="text" class="form-control" name="grupo">
                                </div>
                                <div class="form-group">
                                    <label for="">Motivo</label>
                                    <input required type="text" class="form-control" name="motivo">
                                </div>
                                <div class="form-group pull-right">
                                    <button name="submit" type="submit" class="btn btn-info">Reservar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
$(".book").click(function(){
    var timeslot = $(this).attr('data-timeslot');
    $("#slot").html(timeslot);
    $("#timeslot").val(timeslot);
    $("#myModal").modal("show");
});
</script>
    

<?php } ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que desea cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "cerrar sesión" abajo si estás seguro de cerrar la sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</div>
</body>

</html>