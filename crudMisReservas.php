<?php session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.php");
}?>
<?php

if(!$_GET){
	header('Location: crudMisReservas.php?pag=1');
}

if ( $_GET['pag']==1){
	?>
	<html><head><style>.anterior{display:none}</style></head></html>
	<?php
}
if(isset($_POST["cancelar"])){ 
	header("Location:crudMisReservas.php");
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">sgec</div>
            </a>

                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="far fa-calendar-alt"></i>
                    <span>Reservar</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="crudMisReservas.php">
                    <i class="far fa-eye"></i>
                    <span>Mis Reservas</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="crudReservas.php">
                    <i class="far fa-eye"></i>
                    <span>Gestionar Reservas</span></a>
            </li>

                        <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="crudAulas.php">
                    <i class="far fa-eye"></i>
                    <span>Gestionar Aulas</span></a>
            </li>

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
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
		$sql="DELETE FROM reservas WHERE id=:cod";
			$stmt=$conn->prepare($sql);
			$stmt->bindParam(":cod",$_POST['dato']);
			$stmt->execute();
		
			
		}

	};
//BORRAR
if(isset($_POST['borrar'])){
	if (empty($_POST['eliminar'])){
		echo '<h1>No se ha seleccionado ningun registro</h1>';
	}else{
		foreach($_POST['eliminar'] as $id_borrar){
			//creamos la consulta que borra todos los contactos con los id que se han pasado y que nos redirige una vez borrados al inicio
			$borrar=$conn->query("DELETE FROM reservas WHERE id='$id_borrar'");
			
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
		$nombres="SELECT * FROM reservas WHERE id=:cod;";
		$consulta_nombres=$conn->prepare($nombres);
		$consulta_nombres->bindParam(':cod',$id);
		$consulta_nombres->execute();
		$resultado_nombres=$consulta_nombres->fetchAll();

		
		echo "<div id='container' ><form action='' method='post' ><table>";
		foreach($resultado_nombres as $nombre_columna){
			for($i=0;$i<count($nombre_columna)/2;$i++){
               if($i==0||$i==2){
				echo "<tr ><input type='text' readonly name='dato[]' value='".$nombre_columna[$i]."'></input></tr>";

			   }
				elseif($i==6){                    
					echo "
                    <select name='dato[]'>  ";
                    if($nombre_columna[6]=='08:30AM - 09:30AM'){
                        echo "<option selected value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";


                    }
                    elseif($nombre_columna[6]=='09:30AM - 10:30AM'){
                        echo "<option value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option selected value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";
                    }
                    elseif($nombre_columna[6]=='10:30AM - 11:30AM'){
                        echo "<option value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option selected value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";
                    }
                    elseif($nombre_columna[6]=='11:30AM - 12:30PM'){
                        echo "<option value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option selected value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";
                    }
                    elseif($nombre_columna[6]=='12:30PM - 13:30PM'){
                        echo "<option value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option selected value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";
                    }
                    elseif($nombre_columna[6]=='13:30PM - 14:30PM'){
                        echo "<option value='08:30AM - 09:30AM'>08:30AM - 09:30AM</option>";
                        echo "<option value='09:30AM - 10:30AM'>09:30AM - 10:30AM</option>";
                        echo "<option value='10:30AM - 11:30AM'>10:30AM - 11:30AM</option>";
                        echo "<option value='11:30AM - 12:30PM'>11:30AM - 12:30PM</option>";
                        echo "<option value='12:30PM - 13:30PM'>12:30PM - 13:30PM</option>";
                        echo "<option selected value='13:30PM - 14:30PM'>13:30PM - 14:30PM</option>";
                    }
                    echo" </select>
                    </tr>";

                }else{
                    echo "<tr ><input type='text' name='dato[]' value='".$nombre_columna[$i]."'></input></tr>";

                }
			}
		}
		echo "<tr><div><input type='submit'  name='modificar-ult' value='Actualizar'></input>";
		echo "<input type='submit'  name='cancelar' value='Cancelar'></input></div></tr>";

		echo "</table></form></div>";
	};
	//Parte de actualización

	if(isset($_POST['modificar-ult'])){
		$comprobar="SELECT * FROM reservas WHERE fecha='".$_POST['dato'][3]."' AND  idAula='".$_POST['dato'][1]."' AND  hora='".$_POST['dato'][6]."';";
		$consulta_comprobar=$conn->prepare($comprobar);
		$consulta_comprobar->execute();
		$resultado_comprobar=$consulta_comprobar->fetchAll();
		if(count($resultado_comprobar)>0){

			echo "<div class='alert alert-danger'>Ya existe una reserva con este día, hora y aula</div>";


		}
        else{
			$nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
			$consulta_nombres=$conn->prepare($nombres);
			$consulta_nombres->execute();
			$resultado_nombres=$consulta_nombres->fetchAll();
				foreach($resultado_nombres as $nombre_columna){	
					for($i=0;$i<count($nombre_columna)/2;$i++){
						$nombress[]=$nombre_columna;
					}
				}
	
						for($i=0;$i<count($nombress);$i++){
							
							$sql="UPDATE reservas SET  ".$nombress[$i][0]."=:date  WHERE id=".$_POST['dato'][0].";";
							$stmt=$conn->prepare($sql);
							$stmt->bindParam(":date",$_POST['dato'][$i]);
							$stmt->execute();
							
	
						}
                        echo "<div class='alert alert-success'>Tu reserva ha sido modificada con éxito</div>";
		}


					
	};



	






	//PAGINACIÓN PARTE 1
	//Creamos la consulta para saber cuantos contactos tenemos en total, despues dividimos los contactos que tenemos entre los que queremos que se muestren
	//por pantalla, en este caso 6, y redondeamos y ya tenemos el número de páginas que se van a mostrar
	$sql='SELECT * FROM reservas';
	$sentencia= $conn->prepare($sql);
	$sentencia->execute();
    $resultado=$sentencia->fetchAll();
	$contactos_x_pagina=6;
	$total_contactos_db=$sentencia->rowCount();
	$paginas=$total_contactos_db/$contactos_x_pagina;
	$paginas=ceil($paginas);
?>


	<body>
		<?php


			
		
		//crudMisReservas 2 parte
		//Creamos la consulta para obtener los contactos de 6 en 6
        $usuario = $_SESSION['id'];
			$iniciar=($_GET['pag']-1)*$contactos_x_pagina;
			$sql_contactos='SELECT * FROM reservas  WHERE idUsuario = '.$usuario.' LIMIT :inicar,:ncontactos';
			$sentencia_contactos=$conn->prepare($sql_contactos);
			$sentencia_contactos->bindParam(':inicar',$iniciar,  PDO::PARAM_INT);
			$sentencia_contactos->bindParam(':ncontactos',$contactos_x_pagina,  PDO::PARAM_INT);
			$sentencia_contactos->execute();
			$resultado_contactos=$sentencia_contactos->fetchAll();
			
			//obtenemos todos los nombres de las columnas de nuestra tabla, este código es independiente de la bbdd
			$nombres="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sgec' AND `TABLE_NAME`='reservas';";
			$consulta_nombres=$conn->prepare($nombres);
			$consulta_nombres->execute();
			$resultado_nombres=$consulta_nombres->fetchAll();
						echo "
			
			<form method='post' class='crud ' >
				<table class='table table-hover bg-white'>
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
					echo "<td>".$contacto[$i]."</td>";
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
			echo "</table></form>";
?>

		<!--crudMisReservas-->
		<div class="contenedor-pag" style="    display: flex;
    align-items: center;
    justify-content: center;">
		<ul class="pagination pagination-lg">
		<!--<li class="<?php echo $_GET['pag']==1 ? 'desactivado' : '' ?>">
				<a href="crudMisReservas.php?pag=<?php echo $_GET['pag']-1?>"><</a>
			</li>-->
				<!--con un bucle mostramos todas las páginas que hay-->
				<?php for($i=0;$i<$paginas;$i++): ?>
			<li class="page-item" class="<?php echo $_GET['pag']==$i+1 ? 'activado' : ' '?>">
				<a class="page-link" href="crudMisReservas.php?pag=<?php echo $i+1 ?>">	
					<?php echo $i+1 ?>	
				</a>
			</li>

				<?php endfor ?>

				<!--Para ir a la página siguiente en el enlace ponemos que le lleve a la página actual +1-->
			<!--<li class="<?php echo $_GET['pag']>=$paginas ? 'desactivado' : '' ?>">
				<a href="crudMisReservas.php?pag=<?php echo $_GET['pag']+1?>">></a>
			</li>		-->		
		</ul>
				</div>
	</div>
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