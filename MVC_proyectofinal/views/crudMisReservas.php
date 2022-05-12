
<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>

<html lang="en" style="    overflow-x: hidden;">
<head>
  
    <title>Gestionar mis reservas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".alert").delay( 2200 ).fadeOut(1100);
  });


</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<!--JS below-->

</head>
<body style="font-size:12px !important">

<?php include "menu.php";


$count=$this->crud->crudMiReservas(1);

if($count[0]==0){
    echo '<div class="container" style="margin-top:60px;margin-right:80px">
    <div class="row">
    <div class="col-md-12 ">
    <h1 class="display-1" style="color:#1A3C40"> No se han realizado reservas aún</h1>
    </div>
    </div>
    </div>';}
else{

$iteams_pagina=6;

$total_pages=ceil($count[0]/$iteams_pagina);

$page=0;

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

$offset=($page-1) * $iteams_pagina;

$result=$this->crud->crudMiReservas(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);

if(isset($_SESSION["modificar"])){
    ?>
    
<script>

$(document).ready(function(){
$("#myModal").modal();
});
</script>
    
        <?php

    $id=$_SESSION["modificar"];

    $resu=$this->crud->modif($id);

    echo  
'<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Modificar reserva</h3>
        </div>
        <div class="modal-body">';

    echo "<form style='font-size:14px' action='?c=modificar&pag=".$_GET['page']."' method='post'>";
    if(isset($_SESSION['vacio'])){
        echo $_SESSION['vacio'];
        unset($_SESSION['vacio']);
    }

    
    foreach($resu as $nombre_columna){
        for($i=0;$i<count($nombre_columna)/2;$i++){
           if($i==0){
           echo '<div class="form-group">
            <label for="">ID</label>';
            echo "<input class='form-control' type='text' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input>";
            echo '</div>';
           }
           elseif($i==1){
            echo '<div class="form-group">
            <label for="">Aula</label>';

            $aulasDisponibles=$this->crud->aulasDisponibles();

            echo '<select name="dato[]" class="form-control" required>';

            foreach($aulasDisponibles as $idAulas){
                foreach($idAulas as $idAula){

                    if($idAula==$nombre_columna[$i]){

                        echo '<option value="'.$idAula.'" selected>'.$idAula.'</option>';
                    }
                    else{
                        echo '<option value="'.$idAula.'">'.$idAula.'</option>';
                    }
                    
                    
                    
                }
            }
            echo '</select></div>';
       }

           elseif($i==2){
            echo '<div class="form-group">
             <label for="">Usuario</label>';
             echo "<input class='form-control' type='text' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input>";
             echo '</div>';
            }

            elseif($i==3){
                echo '<div class="form-group">
                <label for="">Fecha de reserva </label>';
    
                    echo "<input id='date1' type='date' name='dato[]' value='".$nombre_columna[$i]."' class='form-control' required></input>";
                    echo '</div>';
                }
    
               elseif($i==4){
                echo '<div class="form-group">
                <label for="">Grupo </label>';
    
                    $gruposDisponibles=$this->crud->gruposDisponibles();
    
                    echo '<select name="dato[]" class="form-control" required>';
    
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
                    echo '</select></div>';
                }

                else if($i==5){
                    echo '<div class="form-group">
                <label for="">Motivo </label>';
    
                    echo "<input type='text' name='dato[]' value='".$nombre_columna[$i]."' class='form-control' required></input></div>";
    
                }
                elseif($i==6){   
                    echo '<div class="form-group">
                <label for="">Hora </label>';
    
                    $horarios=array('08:30AM - 09:30AM', '09:30AM - 10:30AM', '10:30AM - 11:30AM', '11:30AM - 12:30AM', '12:30AM - 13:30PM', '13:30PM - 14:30PM');              
                    
                    echo "<select name='dato[]' class='form-control' required>  ";
    
                    foreach($horarios as $hora){
    
                        if($hora==$nombre_columna[$i]){
    
                            echo '<option value="'.$hora.'" selected>'.$hora.'</option>';
                        }
    
                        else{
                            echo '<option value="'.$hora.'">'.$hora.'</option>';
                        }
                        
                    }
                   
                    echo" </select>
                    </div>";
    
                }

            elseif($i==7){
                echo '<div class="form-group">
                 <label for="">Fecha de creación</label>';
                 echo "<input class='form-control' type='text' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                 echo '</div>';
                }
           
           

           
            
        }
    }
    
    echo '<div class="modal-footer">';
    echo "<input class='btn btn-primary' type='submit' style='font-size:14px'  name='modificar-ult' value='Actualizar'></input> ";
    echo '<button type="button" class="btn btn-danger cancelar" style="font-size:14px" data-dismiss="modal">Cancelar</button>';                                                    echo '</div>';
    echo '</div>';
    echo "</form>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    
};

?>
<div class="container" style="margin-top:5%">

<?php include "barraBusquedaMisReservas/barra.php"; ?>

<div class="row">

    
                <div class="col-md-12 " style="border:none">
<h1 style="color:#1A3C40; text-align:center; margin-bottom:5%; background-color:white" >MIS  RESERVAS</h1>
                    
                    <?php 
                    if(isset($_SESSION['error2'])){
                        echo $_SESSION['error2'];
                        unset($_SESSION['error2']);
                    }
                    else if(isset($_SESSION['exito'])){
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                        
                        
                        
                    ?>
       
<?php
       echo '
       <div class="row">
           
                       <div class="col-md-12">';
                      
        echo '<div class="table-responsive-sm">
       <table class="table table-striped bg-white table-hover" style="text-align: center; margin-top:1%">';

        echo "<tr ><th>Eliminar</th>";
                
        foreach($result[1] as $indice){
           
            if($indice=="id"){

            }else{
                echo "<th>".$indice."</th>";
            }
            
        }
        
        echo "<th>Borrar</th>";
        echo "<th>Modificar</th>";
        
        
        echo "</tr>";
        ?>
<form style='font-size:14px' action="?c=borrar&pag=<?php echo $_GET["page"]?>" method="post"> 

<input type="submit" name="borrar" value="Borrar en lote" class="btn btn-danger" style="float:right;   margin-top: -43px; font-size:14px ">
      
       <?php
        
        foreach($result[0] as $indice=>$dato){
        echo "<td><input type='checkbox' name='eliminar[]' value=' ".$dato['id']."'</td>";
            foreach($dato as $x=>$y){
        
            
                
               
                if(is_numeric($y)){
                            
                }else{
                    echo "<td>".$y."</td>";
                }
                
                
               
                //$vivienda=new Vivienda($y);
                //$i=new Vivienda($dato["id"],$dato["tipo"],$dato["zona"],$dato["direccion"],$dato["ndormitorios"],$dato["tamano"],$dato["precio"]);           
            }
      
            ?>
            

            <td>

            <a class="btn btn-danger"  href="?c=borrar&id=<?php echo $dato["id"] ?>&pag=<?php echo $_GET["page"]?>"><i class="bi bi-trash"></i></a>
        
            </td>
            <td><button  title="Modificar" class="btn btn-primary" name="modificar" value="<?php echo $dato["id"] ?>"> <i class="bi bi-pencil-square"></i></button></td>


            <?php
            echo "</tr>";
        
            }
        
       // echo "</table>";
  
  ?>
           </table>
        </div>
        
    </div>


 </form>
 


 <?php
 //--------------------------------------------------------------------

echo "<br>";

//listado

?>






<div style="margin-bottom: 100px;
    display: flex;
    justify-content: center">
    <nav aria-label="...">
		<ul class="pagination">
		<li style="<?php echo $_GET['page']==1 ? 'display:none' : '' ?>" class="page-item">
				<a class="page-link" href="inicio.php?c=crudMisReservas&page=<?php echo $_GET['page']-1?>"><</a>
			</li>
            <li class="page-item active" >

				<!--con un bucle mostramos todas las páginas que hay-->
				<?php for($i=0;$i<=$total_pages;$i++){ 
                    if($i==$_GET["page"]){

                    
                    ?>
                    <a class="page-link" style="color: white!important;
                    background-color: #212529!important;" href="inicio.php?c=crudMisReservas&page=<?php echo $_GET['page']?>"><?php echo $i ?></a>
                    </li>
                    
                    <li class="page-item" style="<?php echo $i==$total_pages ? 'display:none' : '' ?>">
                    <a class="page-link" href="inicio.php?c=crudMisReservas&page=<?php echo $_GET['page']+1?>"><?php echo $i+1 ?></a>


				<?php }
              
                    }?>
                    </li>

				<!--Para ir a la página siguiente en el enlace ponemos que le lleve a la página actual +1-->
                
                <li style="<?php echo $_GET['page']==$total_pages ? 'display:none' : '' ?>">
				<a class="page-link" href="inicio.php?c=crudMisReservas&page=<?php echo $_GET['page']+1?>">></a>
			</li>				
		</ul>
    </nav>
</div>
<?php } ?>
             
<script>



const picker = document.getElementById('date1');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  const dateform = document.getElementById("date1").value;
    const date1 = new Date();
    const date2 = new Date(dateform);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

  if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    swal({
        title: "Fines de semana no disponibles, seleccione un día de semana.",
          text: "",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'

        });  
    }
  else if(diffDays>14){
    e.preventDefault();
    this.value = '';
    swal({
        title: "Seleccione un día dentro de los 14 días siguientes a la fecha de hoy.",
          text: "",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'

        });
  }

  else if(date2.getDate() < date1.getDate()){
    e.preventDefault();
    this.value = '';
    swal({
        title: "No puede seleccionar un día anterior al actual. ",
          text: "Seleccione un día dentro de los 14 días siguientes a la fecha de hoy.",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'

        });

  }
});

</script>
<script>
$(".cancelar").click(function(){

<?php 
    if(isset($_SESSION["modificar"])){
        unset($_SESSION["modificar"]);
    }

    ?>
    
});


</script>
</body>
</html>