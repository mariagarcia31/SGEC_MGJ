<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>

<html lang="en" style="    overflow-x: hidden;">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Vista Semanal</title>
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
            margin-bottom:30% !important;
        }

        .dia{
            font-size:8px !important;
        }
        .hora{
            font-size:8px !important;
            color: #cb4f24  !important; 
        }

        .botonReservar{
            color:white !important;
            height: 16px !important;
        }
        .botonReservado{
            color:white !important;
            height: 30px !important;
        }

        .textoBotonReservar{

            font-size:8px !important;
        }
        
        
        .botonCambiarVista{
            font-size:8px;color:white !important;
        }

        .nombreSemana{
            display:inline-block !important;
            margin-left:2% !important;
            margin-right:2% !important;
            font-size:18px !important;
            color:#cb4f24 !important;
        }

        .flechaCambiarSemana{
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
            margin-bottom:10% !important;
        }

        .dia{
            font-size:14px !important;
        }
        .hora{
            font-size:14px !important;
        }


        .botonReservar{
            color:white !important;
            
        }

        .textoBotonReservar{

            font-size:14px !important;
        }
        
        .botonCambiarVista{
            font-size:15px;color:white !important;
        }

        .nombreSemana{
            display:inline-block !important;
            margin-left:2% !important;
            margin-right:2% !important;
            font-size:25px !important;
            color:#cb4f24 !important;
        }

        .flechaCambiarSemana{
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

        th:first-of-type {
        border-top-left-radius: 15px !important;
        }
        th:last-of-type {
        border-top-right-radius: 15px !important;
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

     <?php 
    
      
        echo $this->crud->build_calendar_diario(); 
      

      if(isset($_SESSION["msg"])){
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
      }

     ?> 
    </div> 
   </div> 
  </div> 

<div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog" style="width: 95%;">
            <div class="modal-content">
                <div >
                <a href="?c=calendarioDiario&date=<?php echo $_GET['date'] ?>&id=<?php echo $_GET['id'] ?>"><button type="button" class="close" style="margin-left:5%;margin-top:2%;">&times;</button></a>
                        
                </div>
                <div class="modal-header">
                <h4 class="modal-title">Reservado del <b><?php echo $_GET['id']?></b> para el día <b><?php echo $_GET['date'] ?></b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="?c=reservaDiaria&id=<?php echo $_GET['id']?>&date=<?php echo $_GET['date'] ?>" method="post">
                               <div class="form-group">
                                    <label for="">Franja</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot" value="<?php echo $_GET['hora']?>">
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
                                    <button name="submit" type="submit" class="btn btn-success">Reservar</button>
                                    <a href="?c=calendarioDiario&date=<?php echo $_GET['date'] ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


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

   

    
    <?php if(isset($_GET['hora'])){ ?>    
    
    <script>

            $("#myModal").modal("show");

    </script>
        
<?php } ?>
</body>

</html>
