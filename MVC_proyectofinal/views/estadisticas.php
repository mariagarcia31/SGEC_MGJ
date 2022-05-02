<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



 
$dataPoints = array();
$dataPoints2 = array();
$dataPoints3 = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=sgec;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select idAula AS "Aula",  COUNT(id) AS "Cantidad" from reservas GROUP BY idAula'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("label"=> $row->Aula, "y"=> $row->Cantidad));
    }


    $handle = $link->prepare('select grupo AS "Familia",  COUNT(id) AS "Cantidad" from reservas GROUP BY grupo;'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach($result as $row){
        array_push($dataPoints2, array("label"=> $row->Familia, "y"=> $row->Cantidad));
    }


        
    $handle = $link->prepare("
        select CONCAT(DATE_FORMAT(fecha, '%M', 'es_ES'), ' ', year(fecha)) AS 'Mes',count(id) AS 'Cantidad'
        from reservas
        group by year(fecha),month(fecha)
        order by year(fecha),month(fecha);"); 
                                    
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    
    foreach($result as $row){
            array_push($dataPoints3, array("y"=> $row->Cantidad, "label"=> $row->Mes));
        }


    if(isset($_POST['fechaInicio'])){

        $fechaInicio=$_POST['fechaInicio'];
        $fechaFinal=$_POST['fechaFinal'];

            $handle = $link->prepare("SELECT COUNT(id) AS 'Cantidad' from reservas WHERE fecha >= '$fechaInicio' AND fecha <= '$fechaFinal';"); 
            $handle->execute(); 
            $result = $handle->fetchAll(PDO::FETCH_ASSOC);
        
            
        }
    
        else{}  
    


	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	
?>


<html lang="en">
<head>
  
    <title>Estadísticas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../MVC_proyectofinal/libs/css/estilos.css">

<script>
window.onload = function() {
    
 
var chart = new CanvasJS.Chart("chartContainer1", {
	theme: "light1",
	animationEnabled: true,
	
	data: [{
		type: "doughnut",
		indexLabel: "{label} - {y}",
		yValueFormatString: "#,##",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
	theme: "light1",
	animationEnabled: true,
	
	data: [{
		type: "doughnut",
		indexLabel: "{label} - {y}",
		yValueFormatString: "#,##",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 



var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	theme: "light2",
	
	axisY: {
		title: "Reservas (por mes)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## reservas",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart3.render();
 
}
</script>

</head>
<body>

<?php include "menu.php";?>
<?php if(isset($_POST['fechaInicio'])){?>
    <script type="text/javascript">
   $(document).ready(function(){
     var divLoc = $('#chartContainer4').offset();
     $('html, body').animate({scrollTop: divLoc.top}, "medium");
 });
 </script>
 <?php }else{}?>
<div class="container mt-5">


    <div class="row rounded  mx-auto p-3" style="border:5px solid #212529; margin-bottom:10%;width:100%;">

        <div class="rounded" style="background-color:#212529;margin-bottom:3%;">
            <h1 class="text-center" style="color:#F0F0F0" >Número de reservas por Aula</h1>
        </div>

        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
    </div>



    <div class="row rounded  mx-auto p-3" style="border:5px solid #212529; margin-bottom:10%;width:100%;">

        <div class="rounded"  style="background-color:#212529;margin-bottom:3%;">
            <h1 class="text-center" style="color:#F0F0F0" >Número de reservas por Grupo Profesional</h1>
        </div>

        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
    </div>



    <div class="row rounded  mx-auto p-3" style="border:5px solid #212529; margin-bottom:10%;width:100%;">

        <div  class="rounded" style="background-color:#212529;margin-bottom:3%;">
            <h1 class="text-center" style="color:#F0F0F0" >Número de reservas por Mes</h1>
        </div>

        <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
    </div>




    <div class="row rounded  mx-auto p-3" style="border:5px solid #212529; margin-bottom:10%;width:100%;">

        <div class="rounded" style="background-color:#212529;margin-bottom:3%;">
            <h1 class="text-center" style="color:#F0F0F0" >Número de reservas entre dos fechas </h1>
        </div>
        
        <form class="mx-auto" method="post" action="">
            <div class="form-row mx-auto border pb-4 rounded">
                
                <h3 style="display:inline-block;margin-left: 3%;">Desde: </h3>
                <input type="date" id="date1" class="form-control" style="width:25%;display:inline-block;margin-left: 1%;" placeholder="Desde" name="fechaInicio" required>
                
                <h3 style="display:inline-block;margin-left: 3%;">Hasta: </h3>
                <input type="date" id="date2" class="form-control"style="width:25%;display:inline-block;margin-left: 1%;" placeholder="Hasta" name="fechaFinal" required>
                
                <button type="submit" class="btn btn-primary" style="margin-left:3%"><i class="bi bi-search"></i> Buscar</button>
                
            </div>
        </form>

        <div id="chartContainer4" style="height: 250px; width: 100%;">
        <?php 

        if(isset($_POST['fechaInicio'])){
            echo "<b><h1 class='text-center'style='margin-top:5%;'>";
            print_r($result[0]['Cantidad']);
            echo " Reservas";
            echo "</h1></b>";
            echo "<h3 class='text-center'> Desde el ".$_POST['fechaInicio']." hasta el ".$_POST['fechaFinal'];
            echo "</h3>";

        }
        else{}
        
        ?>
    
        </div>
    </div>

</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>



const picker = document.getElementById('date2');
picker.addEventListener('input', function(e){
  const fechainicio = document.getElementById("date1").value;
  const fechafin = document.getElementById("date2").value;
    const date1 = new Date(fechainicio);
    const date2 = new Date(fechafin);

if (date1>date2){
    e.preventDefault();
    this.value = '';
    swal({
        title: "La fecha de inicio debe ser inferior a la fecha final.",
          text: "",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'

        });  
}
  
});

</script>

</body>
</html>