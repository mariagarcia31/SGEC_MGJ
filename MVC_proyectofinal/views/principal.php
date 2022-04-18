
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>Principal</title>
    <style>
    .card-body{
        display: flex;
    align-items: flex-end;
    justify-content: center;
    }
    .card-header{
    background-color:#537efd !important
}
.bg-gray{
    background-color: lightgray !important;
}
@media screen and (max-width:650px){
    .card-wrapper{
        display: flex;
    flex-direction: row;
    align-items: stretch;
    justify-content: center;flex-wrap: wrap; padding-left:16%;padding-right:16%;margin-top:35% !important
    }
}
</style>
</head>

<?php include "menu.php"?>
<body>

    <div class="container" >

    <div style="display: flex;
    flex-direction: row;
    align-items: stretch;
    justify-content: center;flex-wrap: wrap; padding-left:16%;padding-right:16%;margin-top:7%" class="card-wrapper">
    <?php  foreach($this->crud->obtieneTodos("aulas") as $row){  ?>
        <?php if ($row['habilitado']==0){ ?>

                <div class="card bg-gray" style="width: 18rem; margin-left:5%; margin-top:1%;margin-bottom:5%">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                    <h2 class="card-title" style="text-align:center"><?php echo $row['id']; ?></h2>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-gray">• Aforo: <?php echo $row['aforo']; ?></li>
                    <li class="list-group-item bg-gray">• Herramientas: <?php echo $row['informacion']; ?></li>
                    <li class="list-group-item bg-gray">• Ubicación: <?php echo $row['ubicacion']; ?></li>
                </ul>
                <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-info" disabled>No disponible</button>
                        </div>
                </div>
                </div>



                <?php } else{ ?>

                <div class="card" style="width: 18rem; margin-left:5%; margin-top:1%;margin-bottom:5%">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                    <h2 class="card-title" style="text-align:center"><?php echo $row['id']; ?></h2>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">• Aforo: <?php echo $row['aforo']; ?></li>
                    <li class="list-group-item">• Herramientas: <?php echo $row['informacion']; ?></li>
                    <li class="list-group-item">• Ubicación: <?php echo $row['ubicacion']; ?></li>
                </ul>
                <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <a href="?c=calendario&id=<?php echo $row['id']?>"><button type="submit" class="btn btn-info">Reservar</button></a>
                        </div>
                </div>
                </div>



            <?php }  ?>

        <?php } ?> 

            
    </div>
    
 
    
</body>
</html>