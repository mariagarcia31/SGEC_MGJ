<?php
 
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

    if(isset($_POST['fechaInicio'])){

        $handle = $link->prepare("SELECT COUNT(id) AS 'Cantidad' from reservas WHERE fecha >= '2022-04-26' AND fecha <= '2022-04-26';"); 
        $handle->execute(); 
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    
        foreach($result as $row){
            array_push($dataPoints2, array("label"=> $row->Familia, "y"=> $row->Cantidad));
        }
    }

    else{

        
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
    }


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
<script>
window.onload = function() {
    
 
var chart = new CanvasJS.Chart("chartContainer1", {
	theme: "light1",
	animationEnabled: true,
	title: {
		text: "Número de reservas por Aula"
	},
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
	title: {
		text: "Número de reservas por Familia Profesional"
	},
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
	title: {
		text: "Número de reservas por mes"
	},
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
<div class="container mt-5">
<div class="row rounded p-5 mx-auto" style="border:5px solid #212529; margin-bottom:10%;width:90%;">
<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
</div>

<div class="row rounded p-5 mx-auto" style="border:5px solid #212529; margin-bottom:10%; width:90%;">
<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
</div>

<div class="row rounded p-5 mx-auto" style="border:5px solid #212529; margin-bottom:10%; width:90%;">
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
</div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>