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
        @media screen and (max-width:1200px){
            table{
                width:40%
            }
            body{
            overflow-x: hidden;
        }
        .col-md-2.boton{
                width:40%;
                text-align:center
            }
            .tramos{
                display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    width: 100%;
            }
            
        }

        @media screen and (max-width:890px){
            td{
                padding:0px;
                font-size:12px
            }
            body{
            overflow-x: hidden;
        }
            .header{
                font-size:12px
            }
            .mx-auto{
                font-size:12px
            }
            td h4{
                font-size:12px
            }
            td a{
                font-size:12px
            }
            .btn.btn-info{
                color: #fff;
                background-color: #36b9cc;
                border-color: #36b9cc;
                font-size: 12px !important;
                padding: 3px !important;
            }
            #calendario{
                width: 100%;
                display: flex;
                flex-direction: column;
                align-content: center;
                justify-content: center;
                align-items: center;
            }
            h3{
                font-size: 1.1rem !important;
            }
            .btn.btn-xs{
                font-size: 12px;
            }
            

            
        }

        @media screen and (max-width:690px){
            body{
            overflow-x: hidden;
        }
            .btn.btn-info {

                font-size: 9px !important;
            }
            .table>:not(caption)>*>* {
                padding:0.1rem !important;
            }
            .btn.btn-info {
                font-size: 7px !important;
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
   <div class="col-md-12 "> 
   <a href="?c=principal" title="Cancelar"><button type="button" class="close" style="font-size:3.5em"><i class="bi bi-arrow-return-left"><p style="font-size:small">Ver aulas</p></i></button></a>
    
    <div id="calendario" style="width: 65%;padding:5" class=' mx-auto rounded'> 
    
    <?php if(isset($_GET['id'])){ ?>

           <h1 class='mx-auto' style='color:#202020; background-color:white;'> Reserva para el <?php echo $_GET['id'] ?></h1>
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

<div class="container" style="width: 67%;">
        <div class="row">

        <hr style='color:lightgray'>
    <div class="col-md-12">
    
    <h1 class='mx-auto text-center' style='color:#202020'>Horarios del día: <?php echo date('m/d/Y', strtotime($_GET["date"])); ?></h1><hr style="margin:15px !important">
    
    
    <?php if(isset($_SESSION["msg"])){ 
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);} ?>
    </div>


<div class="tramos" id="fixed">
<?php 

    foreach($horarios as $hora){
?>
    <div class="col-md-2 boton">
        
        <div class="form-group">
        <?php if(in_array($hora, $booking[0])){

        $clave = array_search($hora, $booking[0]);

        echo "<button class='btn btn-danger btn-xs' disabled>$hora<br>Prof. ".$booking[1][$clave]."</button> ";
        ?>
        
        <?php }else{ ?>
        <button class="btn btn-success book" data-timeslot="<?php echo $hora; ?>"><?php echo $hora; ?></button>
        <?php }  ?>
        </div>
    </div>
    <?php } ?>
    
    <h5 class='mx-auto text-center' style='margin-top:7%'><i class="bi bi-circle-fill" style='color:green'> Disponible</i><i class="bi bi-circle-fill" style='color:#df4759; margin-left:4%'> Reservado</i></h5>
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
