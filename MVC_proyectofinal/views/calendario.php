<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendario</title>
</head>
<body>
    
<?php include "menu.php"?>

<div class="container bg-white rounded shadow p-1 mb-5 bg-white rounded" style="padding-left:100px">
<div class="card-body">
  </div>
 <div class="container"> 
 <div class="row text-center"> 

 <a href="?c=principal" title="Cancelar"><button type="button" class="close" style="font-size:3.5em">&times;</button></a>
    
 </div> 
  <div class="row"> 
   <div class="col-md-12"> 
    <div id="calendario" style="width: 80%;" class='mx-auto'> 
    
    <?php if(isset($_GET['id'])){ ?>

           <h1 class='mx-auto' style='color:#202020'> Reserva para el <?php echo $_GET['id'] ?></h1>
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

    //PARTE DE RESERVA EN LOS TRAMOS HORARIOS
    $duration = 60;
    $cleanup = 0;
    $start = "08:30";
    $end = "14:30";

     $this->crud->seteaDate1($_GET['id'],$_GET['date']);
     $booking=$this->crud->seteaDate2($_GET['id'],$_GET['date']);

     
?>

    

<div class="container" style="width: 80%;">
        <div class="row">


    <div class="col-md-12">
    <h1 class='mx-auto text-center' style='color:#202020'>Horarios del día: <?php echo date('m/d/Y', strtotime($_GET["date"])); ?></h1><hr>

    <?php if(isset($_SESSION["msg"])){ 
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);} ?>
    </div>



<?php $timeslots = $this->crud->timeslots($duration, $cleanup, $start, $end); 

    foreach($timeslots as $ts){
?>
    <div class="col-md-2">
        
        <div class="form-group">
        <?php if(in_array($ts, $booking)){ ?>
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
                            <form action="?c=reserva&id=<?php echo $_GET['id']?>&date=<?php echo $_GET['date'] ?>" method="post">
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
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    






                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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