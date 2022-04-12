<?php session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.php");

}

include "menu1.php"?>
<?php

if(!$_GET){
	header('Location: crudaulas.php?pag=1');
}

if ( $_GET['pag']==1){
	?>
	<html><head><style>.anterior{display:none}</style></head></html>
	<?php
}
if(isset($_POST["cancelar"])){ 
	header("Location:crudaulas.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<style>
	input[value="Borrar"]{
		width:100%;
		margin-top:10px
	}
    .container-fluid{
        display:none
    }
	table{
		width:80% !important
	}
	.crud{
		display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    align-content: center;
	}
    #wrapper{
        top: 0px;
    position: absolute;
    left: 0px;
    right: 0px;
    bottom: 0px;
    }
    .crud-html{
        width: 80%;
    right: 0px;
    position: absolute;
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

<body >

				<?php 
$servername="localhost";
$username="root";
$password="";


try{
    //Creamos un objeto PDO para que se conecte a nuestra bbdd
    $conn=new PDO("mysql:host=$servername;dbname=sgec;charset=utf8",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "<br>conectado<br><br>";

    //Capturamos error en caso de error:
}catch(PDOException $e){
    echo "Conexión fallida".$e->getMessage();
}



//BORRAR DE UNO EN UNO
	if(isset($_POST['quitar'])){
		if(isset($_POST['dato'])){
            $sql="DELETE FROM reservas WHERE idAula=:cod";
			$stmt=$conn->prepare($sql);
			$stmt->bindParam(":cod",$_POST['dato']);
			$stmt->execute();
		$sql="DELETE FROM aulas WHERE id=:cod";
			$stmt=$conn->prepare($sql);
			$stmt->bindParam(":cod",$_POST['dato']);
			$stmt->execute();
            			
			
		}

	};

    //AGREGAR AULA
    if(isset($_POST["btnAgregar"])){ 
		
		$nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='aulas';";
		$consulta_nombres=$conn->prepare($nombres);
		$consulta_nombres->execute();
		$resultado_nombres=$consulta_nombres->fetchAll();
		echo "<div class='contenedor' id='container'>
                <form action='' method='post' class='crud' enctype='multipart/form-data'> ";
                    echo "<table class='table bg-white'>";
		foreach($resultado_nombres as $nombre_columna){

			for($i=0;$i<count($nombre_columna)/2;$i++){
                    
					echo "<tr>".$nombre_columna[$i].": <input required type='text' name='dato[]' value=''></input></tr>";
                
				
			}
		}
		echo "<tr><div><input type='submit' class='eliminar-varios' name='agregar-ult' value='Agregar'></input>";
		echo "<a href='crudAulas.php'><input type='button' class='eliminar-varios' name='cancelar' value='Cancelar'></input></a></div></tr>";
		echo "</table></form></div>";
}

//aqui se termina la agregación
if(isset($_POST['agregar-ult'])){

    $mysqli = new mysqli('localhost', 'root', '', 'sgec');
    $id = $_POST['dato'][0];
    $stmt = $mysqli->prepare("select * from aulas where id = ? ");
    $stmt->bind_param('s',$id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            echo "<div class='alert alert-danger'>Ya existe una aula con este nombre</div>";
        }
        else{
            $ubicacion = $_POST['dato'][1];
            $informacion = $_POST['dato'][2];
            $aforo = $_POST['dato'][3];
            $habilitado = $_POST['dato'][4];
            

            $stmt = $mysqli->prepare("INSERT INTO aulas  VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssss', $id, $ubicacion, $informacion, $aforo, $habilitado );
            $stmt->execute();
            echo "<div class='alert alert-success'>Aula creada con exito</div>";
            
            $stmt->close();
            $mysqli->close();
            
        
    }


		
}}






//BORRAR
if(isset($_POST['borrar'])){
	if (empty($_POST['eliminar'])){
		echo '<h1>No se ha seleccionado ningun registro</h1>';
	}else{
		foreach($_POST['eliminar'] as $id_borrar){
			//creamos la consulta que borra todos los contactos con los id que se han pasado y que nos redirige una vez borrados al inicio
            $sql="DELETE FROM reservas WHERE idAula=:cod";
			$stmt=$conn->prepare($sql);
			$stmt->bindParam(":cod",$_POST['dato']);
			$stmt->execute();
            $borrar=$conn->query("DELETE FROM aulas WHERE id='$id_borrar'");
			
		}
	}
};

	//MODIFICAR
	//Mostramos los campos a modificar, se muestran de forma dinámica de forma que el código es independiente de la bbdd
	if(isset($_POST['modificar'])){
		?>
		<html><head><style>#todo{opacity: 0.2;}</style></head></html>
			<?php
		$id = $_POST['dato'];
		$nombres="SELECT * FROM aulas WHERE id=:cod;";
		$consulta_nombres=$conn->prepare($nombres);
		$consulta_nombres->bindParam(':cod',$id);
		$consulta_nombres->execute();
		$resultado_nombres=$consulta_nombres->fetchAll();

		
		echo "<div id='container'><form action='' method='post' class='crud' enctype='multipart/form-data'> ><table>";
		foreach($resultado_nombres as $nombre_columna){
			for($i=0;$i<count($nombre_columna)/2;$i++){
               if($i==0){
				echo "<tr ><input type='text' readonly name='dato[]' value='".$nombre_columna[$i]."'></input></tr>";

			   }
				else{
                    echo "<tr ><input type='text' name='dato[]' value='".$nombre_columna[$i]."'></input></tr>";

                }
			}
		}
		echo "<tr><div><input type='submit'  name='modificar-ult' value='Actualizar'></input>";
		echo "<a href='crudAulas.php'><input type='submit'  name='cancelar' value='Cancelar'></input></a></div></tr>";

		echo "</table></form></div>";
	};
	//Parte de actualización

	if(isset($_POST['modificar-ult'])){

		

			$nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='aulas';";
			$consulta_nombres=$conn->prepare($nombres);
			$consulta_nombres->execute();
			$resultado_nombres=$consulta_nombres->fetchAll();
				foreach($resultado_nombres as $nombre_columna){	
					for($i=0;$i<count($nombre_columna)/2;$i++){
						$nombress[]=$nombre_columna;
					}
				}
	
						for($i=0;$i<count($nombress);$i++){
					
                                
                                $sql="UPDATE aulas SET  ".$nombress[$i][0]."=:date  WHERE id='".$_POST['dato'][0]."';";
                                $stmt=$conn->prepare($sql);
                                $stmt->bindParam(":date",$_POST['dato'][$i]);
                                $stmt->execute();

	
						}

                        
                        echo "<div class='alert alert-success'>Aula modificada con exito</div>";
                        



		


					
	};



	






	//PAGINACIÓN PARTE 1
	//Creamos la consulta para saber cuantos contactos tenemos en total, despues dividimos los contactos que tenemos entre los que queremos que se muestren
	//por pantalla, en este caso 6, y redondeamos y ya tenemos el número de páginas que se van a mostrar
	$sql='SELECT * FROM aulas';
	$sentencia= $conn->prepare($sql);
	$sentencia->execute();
    $resultado=$sentencia->fetchAll();
	$contactos_x_pagina=6;
	$total_contactos_db=$sentencia->rowCount();
	$paginas=$total_contactos_db/$contactos_x_pagina;
	$paginas=ceil($paginas);
?>

<div class="crud-html">
		<?php


			
		
		//crudaulas 2 parte
		//Creamos la consulta para obtener los contactos de 6 en 6
			$iniciar=($_GET['pag']-1)*$contactos_x_pagina;
			$sql_contactos='SELECT * FROM aulas LIMIT :inicar,:ncontactos';
			$sentencia_contactos=$conn->prepare($sql_contactos);
			$sentencia_contactos->bindParam(':inicar',$iniciar,  PDO::PARAM_INT);
			$sentencia_contactos->bindParam(':ncontactos',$contactos_x_pagina,  PDO::PARAM_INT);
			$sentencia_contactos->execute();
			$resultado_contactos=$sentencia_contactos->fetchAll();
			
			//obtenemos todos los nombres de las columnas de nuestra tabla, este código es independiente de la bbdd
			$nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='aulas';";
			$consulta_nombres=$conn->prepare($nombres);
			$consulta_nombres->execute();
			$resultado_nombres=$consulta_nombres->fetchAll();
						echo "
			
			<form method='post' class='crud' >
				<table class='table table-hover bg-white '>
                <thead class='table-info'>
				<tr >
					<td><input type='submit' class='btn btn-danger'  name='borrar' value='Eliminar'></td>";
					//mostramos los nombres de las columnas
						foreach($resultado_nombres as $nombre_columna){	
							for($i=0;$i<count($nombre_columna)/2;$i++){
								echo "<td>".$nombre_columna[$i]."</td>";	
							}
						}
				echo "<td>Acciones</td>
				</tr>                </thead>
";
			
		//para poder mostrar los datos los recorremos con un foreach y creamos los botones de borrar y modificar y como value pasamos el id para poder 
		//utilizarlo luego
			foreach($resultado_contactos as $contacto){	
				echo "<tr>";
				echo "<td><input type='checkbox' name='eliminar[]' value='".$contacto[0]."'/></td>";	
				for($i=0;$i<count($contacto)/2;$i++){
                    if($i==5){
                        echo "<td><img class='img-responsive img-rounded' style='width:50px' src='data:image/jpg;charset=utf8;base64,".base64_encode($contacto[$i])."' /></td>";
                    }else{
                        echo "<td>".$contacto[$i]."</td>";

                    }
				}
						echo"<td class='opciones'>
						<form action='' method='post'>
							<input type='hidden' name='dato' value='".$contacto[0]."'>
							<input type='submit' class='btn btn-warning' value='Modificar' name='modificar'/>
						</form>
						<form action='' method='post'>
							<input type='hidden' name='dato' value='".$contacto[0]."'>
							<input type='submit' class='btn btn-danger'  value='Borrar'  name='quitar'/>
						</form></td>
					 </tr>";
			}	
			echo "</table></form>
            
            <form action='' method='POST'>
            <input type='submit' name='btnAgregar' value='Crear Aula' class='btn btn-info'>
            </form>
            ";
?>

		<!--crudaulas-->
		<div class="contenedor-pag" style="    display: flex;
    align-items: center;
    justify-content: center;">
		<ul class="pagination pagination-lg">
		<!--<li class="<?php echo $_GET['pag']==1 ? 'desactivado' : '' ?>">
				<a href="crudaulas.php?pag=<?php echo $_GET['pag']-1?>"><</a>
			</li>-->
				<!--con un bucle mostramos todas las páginas que hay-->
				<?php for($i=0;$i<$paginas;$i++): ?>
			<li class="page-item" class="<?php echo $_GET['pag']==$i+1 ? 'activado' : ' '?>">
				<a class="page-link" href="crudAulas.php?pag=<?php echo $i+1 ?>">	
					<?php echo $i+1 ?>	
				</a>
			</li>

				<?php endfor ?>

				<!--Para ir a la página siguiente en el enlace ponemos que le lleve a la página actual +1-->
			<!--<li class="<?php echo $_GET['pag']>=$paginas ? 'desactivado' : '' ?>">
				<a href="crudaulas.php?pag=<?php echo $_GET['pag']+1?>">></a>
			</li>		-->		
		</ul>
				</div>
	</div>
               

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

</body>

</html>