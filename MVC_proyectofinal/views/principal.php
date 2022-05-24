<?php 

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}




include "menu.php"?>

<html lang="en" style="    overflow-x: hidden;">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>SGEC</title>
    <link rel="stylesheet" href="libs/css/estilos.css">

<style>
    hr{
        color:white
    }
    .card {

    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    transition: all 0.6s ease;
    
    user-select: none;
    overflow: hidden
}


.card:hover{

    cursor: pointer;
    transform: scale(1.035);
    box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 10px
    
}

.active, .accordion:hover {
    background-color: white; 
}

.busqueda:hover {
    background-color:#D8D8D8; 
}

#search:focus{
    outline: none !important;
}
@media screen 
        and (min-device-width: 320px) 
        and (max-device-width: 812px) 
        and (-webkit-min-device-pixel-ratio: 1) { 
        
        .barra{
            width: 90% !important;
        }
        .resultadosBusqueda{
            width: 60% !important;
            position: absolute;
            z-index: 90;
            margin-left: 30px;
            top: 39px;

        }

        #search{
            width: 70% !important;
            margin-bottom: 8% !important;
        }
        .vistaDiaria{
            float:left !important;
            margin-left: 9% !important;
        }
       
    }

@media screen 
        and (min-device-width: 813px) 
        and (max-device-width: 1600px) 
        and (-webkit-min-device-pixel-ratio: 1) { 
        
        .barra{
            width: 30% !important;
        }

        .resultadosBusqueda{
            width: 18% !important;
        }

      
    }


    a:link, a:visited, a:active, a:hover {
    text-decoration:none;
}
a:hover{
    text-decoration:none !important;
}

    </style>
</head>

<?php 
 $contador=0; 
 $aulas=$this->crud->obtieneTodos("aulas");
 $cuantasAulas=count($aulas);
 ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<body style="font-size:12px !important">
    



  
  


<section class="pt-5 pb-5 mt-5 ml-5 mr-5">

    <div class="container">
        
        <div class="row">
            
       <?php include "barraBusqueda/barra.php"; ?>
            <div class="col-12" >
            
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">

                        

                               
                                    
    <?php  foreach($this->crud->obtieneTodos("aulas") as $row){ 
        $contador++;
        if ($contador==1){
         ?>
        <div class="carousel-item active">
        <div class="row">
        

        <?php }

        else if ($contador==4||$contador==7||$contador==10||$contador==13||$contador==16||$contador==19||$contador==22||$contador==25||$contador==28||$contador==31){ ?>
        <div class="carousel-item">
        <div class="row ">
       
        <?php }?>
        
     
        
            <div class="col-md-4 mb-4 mt-1 p-5">
            <?php if($row['habilitado']==0) {?>
                <a href="?c=principal">

                                <?php } else{?>
                                    <a href="?c=calendario&id=<?php echo $row['id']?>">
                                <?php } ?>
                <div class="card mt-2 " style="border-radius: 1.2rem;" >
                    <div class="card text-white bg-info mb-0" style="border:none !important;">
                        <div class="card-header" style="border:none !important;">

                            <h1 class="card-title" style="text-align:center;margin-top:2%"><?php echo $row['id']; ?></h1>
                        </div>
                    </div>
                    <img alt="imagen de aula" class="img-fluid"  src="<?=$row['imagen']?>" style="height:250px !important; width:100%">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item " style="font-size:1.3rem" >• Aforo: <?php echo $row['aforo']; ?></li>
                        <li class="list-group-item " style="font-size:1.3rem">• Herramientas: <?php echo $row['informacion']; ?></li>
                        <li class="list-group-item " style="font-size:1.3rem">• Ubicación: <?php echo $row['ubicacion']; ?></li>
                    </ul>
                    
                    <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <?php if($row['habilitado']==0) {?>
                                <button type="submit" class="btn btn-secondary" style="font-size:1.4rem" disabled>No disponible</button>
                                <?php } else{?>
                                    <a href="?c=calendario&id=<?php echo $row['id']?>"><button type="submit" class="btn btn-info" style="font-size:1.4rem" >Reservar</button></a>
                                <?php } ?>
                                
                            </div>
                    </div>
                </div>
                                </a>
            </div>
        
        <?php if ($contador==$cuantasAulas||$contador==3||$contador==6||$contador==9||$contador==12||$contador==15||$contador==18||$contador==21||$contador==24||$contador==27||$contador==30||$contador==33||$contador==36||$contador==39){?>
        
        
        </div>
        </div>
        
        <?php }?>

                

        <?php } ?> 

       

        </div>
        <div class="row ">
        <div class="col-9 mx-auto" style="display: flex;align-items: center;justify-content: center; margin-top:-2%; margin-bottom:100px">
                <a style="border-radius:100%;"  href="#carouselExampleIndicators2" role="button" data-slide="prev" style="width:100%;">
                <i class="bi bi-chevron-left " style="font-size:30px; color:#212529;"></i>
                </a>

                <a  style="border-radius:20%; margin-left:5%" href="#carouselExampleIndicators2" role="button" data-slide="next" style="width:100%;">
                <i class="bi bi-chevron-right" style="font-size:30px; color:#212529;"></i>
                </a>

                
        </div>
        </div>
        
        </div>
        </div>
        </div>
        </div>
        </section>
        
        
    
             
    
</body>
</html>