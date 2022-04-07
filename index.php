<?php session_start();
if(!isset($_SESSION['nombre'])){

    header("Location:login.php");
}?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>Aulas</title>
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
@media screen and (max-width:690px){
 .navbar-nav.bg-gradient-primary.sidebar.sidebar-dark.accordion{
     z-index:3
 }
    .card.bg-gray{
        margin-top:20% !important;

    }

}

</style>
</head>

<div style="    display: flex;
    flex-direction: row;
    align-items: stretch;
    justify-content: center;flex-wrap: wrap; padding-left:16%;padding-right:16%;margin-top:7%" class="card-wrapper">
<?php 
include "menu.php";
//CONEXIÓN 
$dbHost     = "localhost";  
$dbUsername = "root";  
$dbPassword = "";  
$dbName     = "sgec";  
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  
if ($db->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
}
$result = $db->query("SELECT id, ubicacion, informacion, aforo, habilitado FROM aulas GROUP BY id"); 

//Creamos las "cartas" de cada aula, con su información
if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ ?> 

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
                        <a href="calendario.php?id=<?php echo $row['id']?>"><button type="submit" class="btn btn-info">Reservar</button></a>
                    </div>
            </div>
        </div>



        <?php }  ?>
        
        <?php } ?> 

<?php } ?> 
</div>
</body>
</html>