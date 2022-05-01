
<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Calendario</title>
    <style>
        .row{
            margin:0px !important
        }
        .tramos{
            margin-bottom:100px
        }
        body{
            overflow-x: hidden !important;
        }
        .btn-group-xs>.btn, .btn-xs {
            padding: 1px 5px;
            font-size: 16px !important;
            line-height: 1.5;
            border-radius: 3px;
        }
        a:hover{
            text-decoration:none !important
        }


        .close {
            font-size: 4rem !important;
            margin-top: 50px;
            margin-left: 50px;
            float: left !important;
            background: none;
            border: none;
        }
        .mx-auto{
            text-align:center
        }

        
        @media only screen 
        and (min-device-width: 320px) 
        and (max-device-width: 812px)
         {
            body{
            overflow-x: hidden;
        }
           
        .diaSemana{
            border:none !important; 
            background-color:#cb4f24 !important; 
            color:white !important; 
            width:fit-content !important; 
            font-size:8px !important;
        }
        .calendario{
            width: 100% !important;
            padding:5 !important;
        }

        .dia{
            font-size:8px !important;
        }

        .botonReservar{
            background-color:#cb4f24 !important;
            color:white !important;
            height: 16px !important;
        }

        .textoBotonReservar{

            font-size:8px !important;
        }
        
        .botonCambiarVista{
            font-size:8px;color:white !important;
        }

        .nombreMes{
            display:inline-block !important;
            margin-left:2% !important;
            margin-right:2% !important;
            font-size:18px !important;
            color:#cb4f24 !important;
        }

        .flechaCambiarMes{
            font-size:18px !important;
            color:#212529 !important;
        }

        .nombreAula{
            color:#202020 !important;
            background-color:white !important;
            font-size:20px !important;

        }
        .volver{
            font-size:10px !important;
            color:#202020 !important;
        }
        .container{
            width:50%;
        }
        .boton{
            width: 50%;
        }
        .centrar{
            margin-left:25% !important;
            margin-right:auto !important;
        }

        }


      

          
        @media screen 
        and (min-device-width: 813px) 
        and (max-device-width: 1600px) 
        and (-webkit-min-device-pixel-ratio: 1) { 
            body{
            overflow-x: hidden;
        }
           
        .diaSemana{
            border:none !important; 
            background-color:#cb4f24 !important; 
            color:white !important; 
            width:fit-content !important; 
            font-size:16px !important;
        }
        .calendario{
            width: 75% !important;
            padding:5 !important;
        }

        .dia{
            font-size:14px !important;
        }

        .botonReservar{
            background-color:#cb4f24 !important;
            color:white !important;
            
        }

        .textoBotonReservar{

            font-size:14px !important;
        }
        
        .botonCambiarVista{
            font-size:15px;color:white !important;
        }

        .nombreMes{
            display:inline-block !important;
            margin-left:2% !important;
            margin-right:2% !important;
            font-size:25px !important;
            color:#cb4f24 !important;
        }

        .flechaCambiarMes{
            font-size:25px !important;
            color:#212529 !important;
        }

        .nombreAula{
            color:#202020 !important;
            background-color:white !important;
            font-size:35px !important;

        }
        .volver{
            font-size:17px !important;
            color:#202020 !important;
        }
        .container{
            width:90%;
        }
        .boton{
            width: 30%;
        }
        .reservado{
            margin-left:auto;
        }
        }





        
        

    </style>
<script>
 /** Change the style **/
 function overStyle(object){
    object.style.backgroundColor = "#E8E8E8";
    // Change some other properties ...
 }

 /** Restores the style **/
 function outStyle(object){
    object.style.backgroundColor = "white";
    // Restore the rest ...
 }
</script>

</head>
<body>
    
<?php include "menu.php"?>







  <div class="row"> 
  <a href="?c=principal" title="Cancelar" ><button type="button" class="close"><i class="bi bi-arrow-return-left volver"> Ver aulas</i></button></a>

   <div class="col-md-12 "> 
    
    <div id="calendario" class='mx-auto rounded calendario'> 
    
    <?php if(isset($_GET['id'])){ ?>

           <h1 class='mx-auto nombreAula'> Reserva para el <?php echo $_GET['id'] ?></h1>
     <?php 
    }
      if(isset($_GET["month"])){
        $month = $_GET['month']; 
        $year = $_GET['year']; 
        echo $this->crud->build_calendar($month,$year); 
      }
      else{
        $dateComponents = getdate(); 
        $month = $dateComponents['mon']; 
        $year = $dateComponents['year']; 
        echo $this->crud->build_calendar($month,$year); 
      }
     ?> 
    </div> 
   </div> 
  </div> 
 </div> 

 <?php if(isset($_GET['date'])){


     $this->crud->seteaDate1($_GET['id'],$_GET['date']);
     $booking=$this->crud->seteaDate2($_GET['id'],$_GET['date']);
     $horarios=array('08:30AM - 09:30AM', '09:30AM - 10:30AM', '10:30AM - 11:30AM', '11:30AM - 12:30AM', '12:30AM - 13:30PM', '13:30PM - 14:30PM');              


     
?>
<script type="text/javascript">
   $(document).ready(function(){
     var divLoc = $('#fixed').offset();
     $('html, body').animate({scrollTop: divLoc.top}, "medium");
 });
 </script>

<div class="container" >
        <div class="row">

        <hr style='color:lightgray'>
    <div class="col-md-12">
    
    <h1 class='mx-auto text-center nombreAula' style='color:#202020'>Horarios del día: <?php echo date('m/d/Y', strtotime($_GET["date"])); ?></h1><hr style="margin:15px !important">
    
    
    <?php if(isset($_SESSION["msg"])){ 
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);} ?>
    </div>


<div class="tramos centrar" id="fixed">
<?php 

    foreach($horarios as $hora){
?>
    <div class="col-lg-2 boton">
        
        <div class="form-group">
        <?php if(in_array($hora, $booking[0])){

        $clave = array_search($hora, $booking[0]);

        echo "<button class='btn btn-danger reservado' disabled>$hora<br>Prof. ".$booking[1][$clave]."</button> ";
        ?>
        
        <?php }else{ ?>
        <button class="btn btn-success book" data-timeslot="<?php echo $hora; ?>"><?php echo $hora; ?></button>
        <?php }  ?>
        </div>
        
    </div>
    
    <?php } ?>
    <div class="col-lg-2 boton mx-auto">
    <h5 class='text-center float-left' style='margin-top:7%'><i class="bi bi-circle-fill" style='color:green'> Disponible</i><br><br><i class="bi bi-circle-fill" style='color:#df4759;'> Reservado</i></h5>
        </div>
    </div>
       </div>
        </div>
<div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog" style="position:absolute; top:20px; left: calc(50% - 250px)">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reservado de <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="?c=reserva&id=<?php echo $_GET['id']?>&date=<?php echo $_GET['date'] ?>&month=<?php echo $_GET['month']?>&year=<?php echo $_GET['year']?>" method="post">
                               <div class="form-group">
                                    <label for="">Franja</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot">
                                </div>
                                <div class="form-group">
                                    <label for="">Grupo</label>
                                  
                                    <?php 
                                    $gruposDisponibles=$this->crud->gruposDisponibles();

                                    echo '<select class="form-control" name="grupo" required>';
                    
                                    foreach($gruposDisponibles as $nombresGrupos){
                                        foreach($nombresGrupos as $nombreGrupo){
                    
                                            if($nombreGrupo==$nombre_columna[$i]){
                    
                                                echo '<option value="'.$nombreGrupo.'" selected>'.$nombreGrupo.'</option>';
                                            }
                                            else{
                                                echo '<option value="'.$nombreGrupo.'">'.$nombreGrupo.'</option>';
                                            }
                                            
                                        }
                                    }
                                    echo '</select>';
                                    
                                    ?>
                                    
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
               

    <!-- Bootstrap core JavaScript-->
    <script src="libs/vendor/jquery/jquery.min.js"></script>
    <script src="libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="libs/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="libs/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="libs/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="libs/js/demo/chart-area-demo.js"></script>
    <script src="libs/js/demo/chart-pie-demo.js"></script>
    

</body>

</html>
