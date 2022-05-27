<?php

if ((isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) && isset($_SESSION["crudDias"]))){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>
<html lang="es" style="    overflow-x: hidden;">
<head>
  
    <title>Gestionar días no disponibles</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".alert").delay( 2200 ).fadeOut(1100);
  });
</script>
<script>

$(document).ready(function(){
$("#myModal2").modal();
});
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">

</head>
<body style="font-size:12px !important">

<?php include "menu.php";


$count=$this->crud->crudDias(1);

if($count[0]==0){
    
    echo '
        <div class="row mx-auto" >
    <div class="col-md-12 " style="text-align:center; margin-top:5%;">
    <i class="bi bi-emoji-frown" style="font-size:50px; margin-bottom:30px" ></i>
    <h1 class="display-3"> ¡Oops! Parece que no se han creado días no disponibles aún</h1>';
 
    echo "<a href='?c=crudDias&page=".$_GET['page']."&crear=1'><button name='crear' style='font-size:20px; margin-bottom:5%;margin-top:3%'  class='btn btn-success'> Agregar</button></a>
  
    ";
    if(isset($_SESSION['error2'])){
                        echo $_SESSION['error2'];
                        unset($_SESSION['error2']);
                    }
                    else if(isset($_SESSION['exito'])){
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }

                    if(isset($_GET["crear"])){
                        if(isset($_SESSION['vacio'])){
                            echo $_SESSION['vacio'];
                            unset($_SESSION['vacio']);
                        }

                        echo  
        '<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Crear día no disponible</h3>
                </div>
                <div class="modal-body">';
        
                echo "<form style='font-size:14px' action='?c=crearDias&pag=".$_GET['page']."' method='post'>";
               
                echo '<div class="form-group">
                <label for="">Aula</label>';
    
                $aulasDisponibles=$this->crud->aulasDisponibles();
    
                echo '<select name="dato[]" class="form-control" required>';
    
                foreach($aulasDisponibles as $idAulas){
                    foreach($idAulas as $idAula){
    
                    
                            echo '<option value="'.$idAula.'">'.$idAula.'</option>';
                        
                        
                        
                        
                    }
                }
                echo '</select></div>';                    
                                
                
                    echo '<div class="form-group">
                    <label for="">Motivo</label>';
                    echo "<input class='form-control' type='text'  name='dato[]' value='' required ></input>";
                    echo '</div>';                                        
                                          
                    echo '<div class="form-group">
                    <label for="">Fecha inicio</label>';
                    echo "<input class='form-control' id='date1' type='date'  name='dato[]' value='' required ></input>";
                    echo '</div>';
                    echo '<div class="form-group">
                    <label for="">Fecha fin</label>';
                    echo "<input class='form-control' id='date2' type='date'  name='dato[]' value='' required></input>";
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo "<input class='btn btn-primary' type='submit' style='font-size:14px' name='agregar-ult' value='Crear'></input> ";
                    echo '<a href="?c=crudDias&page='.$_GET['page'].'"><button type="button"  style="font-size:14px" class="btn btn-danger">Cancelar</button></a>';
                    echo '</div>';
                    echo "</form>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    }


                    
                    if(isset($_SESSION["modificar"])){

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modifDias($id);

                            echo  
                        '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLongTitle">Modificar festivo</h3>
                                </div>
                                <div class="modal-body">';
                        
                            echo "<form style='font-size:14px' action='?c=modificarDias&pag=".$_GET['page']."' method='post'>";
                            if(isset($_SESSION['vacio'])){
                                echo $_SESSION['vacio'];
                                unset($_SESSION['vacio']);
                            }
                                                    
                            foreach($resu as $nombre_columna){
                            for($i=0;$i<count($nombre_columna)/2;$i++){
                                if($i==0){
                                echo '<div class="form-group">';
                                    echo "<input class='form-control' type='hidden' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input>";
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
                            <label for="">Nombre</label>';
                            echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                            echo '</div>';
                            }
                                elseif($i==3){
                                    echo '<div class="form-group">
                                    <label for="">Fecha inicio</label>';
                                    echo "<input class='form-control' id='date1' type='date'  name='dato[]' value='".$nombre_columna[$i]."' required ></input>";
                                    echo '</div>';
                                    
                                    }
                                    elseif($i==4){
                                        echo '<div class="form-group">
                                    <label for="">Fecha fin</label>';
                                    echo "<input class='form-control' id='date2' type='date'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                    echo '</div>';
                                    }

                                

                                
                                
                                

                                
                                    
                            }
                            }
                            
                            echo '<div class="modal-footer">';
                            echo "<input class='btn btn-primary' type='submit' style='font-size:14px'  name='modificar-ult' value='Actualizar'></input> ";
                            echo '<button type="button" style="font-size:14px" class="btn btn-danger cancelar" data-dismiss="modal">Cancelar</button>';                                                    echo '</div>';
                            echo '</div>';
                            echo "</form>";
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                                                    
                     
                                                
                                                
                            
                        };
    
    
}
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

$result=$this->crud->crudDias(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>

<script>

$(document).ready(function(){
$("#myModal").modal();
});
</script>


<div class="row" style="margin-top:5%">
<?php include "barraBusquedaFestivos/barra.php"; ?>
                <div class="col-md-12 ">
                <h1 style="color:black; text-align:center; margin-bottom:0%; background-color:white; margin-top:50px" >Días no disponibles</h1>
                    
                    
                    <?php
                    /*AGREGAR AQUI EL FORMULARIO PARA CREAR */
                    
                  
                    if(isset($_SESSION['error2'])){
                        echo $_SESSION['error2'];
                        unset($_SESSION['error2']);
                    }
                    else if(isset($_SESSION['exito'])){
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }

                    if(isset($_GET["crear"])){
                        if(isset($_SESSION['vacio'])){
                            echo $_SESSION['vacio'];
                            unset($_SESSION['vacio']);
                        }

                        echo  
        '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLongTitle">Crear festivo</h3>
                </div>
                <div class="modal-body">';
        
                echo "<form style='font-size:14px' action='?c=crearDias&pag=".$_GET['page']."' method='post'>";
               
                echo '<div class="form-group">
                <label for="">Aula</label>';
    
                $aulasDisponibles=$this->crud->aulasDisponibles();
    
                echo '<select name="dato[]" class="form-control" required>';
    
                foreach($aulasDisponibles as $idAulas){
                    foreach($idAulas as $idAula){
    
                    
                            echo '<option value="'.$idAula.'">'.$idAula.'</option>';
                        
                        
                        
                        
                    }
                }
                echo '</select></div>';                          
                                
                
                    echo '<div class="form-group">
                    <label for="">Motivo</label>';
                    echo "<input class='form-control' type='text'  name='dato[]' value='' required ></input>";
                    echo '</div>';
                                    
                                                
                                          
                    echo '<div class="form-group">
                    <label for="">Fecha inicio</label>';
                    echo "<input class='form-control' id='date1' type='date'  name='dato[]' value='' required ></input>";
                    echo '</div>';
                    echo '<div class="form-group">
                    <label for="">Fecha fin</label>';
                    echo "<input class='form-control' id='date2' type='date'  name='dato[]' value='' required></input>";
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo "<input class='btn btn-primary' type='submit' style='font-size:14px' name='agregar-ult' value='Crear'></input> ";
                    echo '<a href="?c=crudDias&page='.$_GET['page'].'"><button type="button"  style="font-size:14px" class="btn btn-danger">Cancelar</button></a>';
                    echo '</div>';
                    echo "</form>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    }


                    
                    if(isset($_SESSION["modificar"])){

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modifDias($id);

                            echo  
                        '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLongTitle">Modificar festivo</h3>
                                </div>
                                <div class="modal-body">';
                        
                            echo "<form style='font-size:14px' action='?c=modificarDias&pag=".$_GET['page']."' method='post'>";
                            if(isset($_SESSION['vacio'])){
                                echo $_SESSION['vacio'];
                                unset($_SESSION['vacio']);
                            }
                                                    
                            foreach($resu as $nombre_columna){
                            for($i=0;$i<count($nombre_columna)/2;$i++){
                                if($i==0){
                                echo '<div class="form-group">';
                                    echo "<input class='form-control' type='hidden' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input>";
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
                                    <label for="">Nombre</label>';
                                    echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                    echo '</div>';

                                    
                            }

                                elseif($i==3){
                                    echo '<div class="form-group">
                                    <label for="">Fecha inicio</label>';
                                    echo "<input class='form-control' id='date1' type='date'  name='dato[]' value='".$nombre_columna[$i]."' required ></input>";
                                    echo '</div>';
                                    
                                    }
                                    elseif($i==4){
                                        echo '<div class="form-group">
                                    <label for="">Fecha fin</label>';
                                    echo "<input class='form-control' id='date2' type='date'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                    echo '</div>';
                                    }

                                

                                
                                
                                

                                
                                    
                            }
                            }
                            
                            echo '<div class="modal-footer">';
                            echo "<input class='btn btn-primary' type='submit' style='font-size:14px'  name='modificar-ult' value='Actualizar'></input> ";
                            echo '<button type="button" style="font-size:14px" class="btn btn-danger cancelar" data-dismiss="modal">Cancelar</button>';                                                    echo '</div>';
                            echo '</div>';
                            echo "</form>";
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                                                    
                     
                                                
                                                
                            
                        };
                        
                        
                        
                    ?>
       
<?php

       echo '<div class="container" style="margin-top:60px;">



       <div class="row">
           
                       <div class="col-md-12 ">';
        echo "<a href='?c=crudDias&page=".$_GET['page']."&crear=1'><button name='crear' style='font-size:14px;margin-bottom:30px'  class='btn btn-success'> Agregar</button></a>  ";
       
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
<form style='font-size:14px' action="?c=borrarDias&pag=<?php echo $_GET["page"]?>" method="post"> 
<input type='submit' name='borrar' value='Borrar en lote' onclick='return confirm("¿Desea eliminar este registro?\nEsta acción es irreversible");' class='btn btn-danger' style="    float: right;
    font-size: 14px;
    position: absolute;
    right: 16px;
    top: 0px; " >
<?php
        
        foreach($result[0] as $indice=>$dato){
            echo "<td><input type='checkbox' name='eliminar[]' value=' ".$dato['id']."'</td>";

            foreach($dato as $x=>$y){
        
            
                if($x=="id"){
                            
                }else{
                    echo "<td>".$y."</td>";
                }                
                //$vivienda=new Vivienda($y);
                //$i=new Vivienda($dato["id"],$dato["tipo"],$dato["zona"],$dato["direccion"],$dato["ndormitorios"],$dato["tamano"],$dato["precio"]);           
            }
      
            ?>
            

            <td>
            <a class="dltBtn btn btn-danger" data-id="<?php echo $dato["id"]; ?>" data-page="<?php echo $_GET["page"]; ?>" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
        
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
        
   <script>
                $(document).ready(function(){
                    $('.dltBtn').click(function(e){
                        e.preventDefault();
                        var id = $(this).attr('data-id');
                        var page = $(this).attr('data-page');
                        Swal.fire({
                            title: '¿Desea eliminar este registro?',
                            text: "Esta acción es irreversible",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: 'gray',
                            confirmButtonText: 'Eliminar',
                            cancelButtonText: 'Cancelar'

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "?c=borrarDias&id="+id+"&pag="+page;
 
                                }
                        })
                    });
                });
            </script>

  
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
				<a class="page-link" href="?c=crudDias&page=<?php echo $_GET['page']-1?>"><</a>
			</li>
            <li class="page-item" style="<?php echo $_GET['page']==1 || $_GET['page']==2 ? 'display:none' : '' ?>">
                    <a class="page-link" href="?c=crudDias&page=1">1 </a>
                </li>
            <li style="<?php echo $_GET['page']==1|| $_GET['page']==2 || $_GET['page']==3 ? 'display:none' : '' ?>">
				    <a class="page-link" href="">...</a>
			    </li>
				<!--con un bucle mostramos todas las páginas que hay-->
				<?php for($i=1;$i<=$total_pages;$i++){
                   if($i==$_GET["page"]-1){
                    echo '<li class="page-item" >
                    <a class="page-link" href="?c=crudDias&page='.$i.'">'.$i.' </a>
                    </li>';
                   }
                   elseif($i==$_GET["page"]){

                    echo '<li class="page-item active" >
                    <a class="page-link" href="?c=crudDias&page='.$_GET["page"].'">'.$_GET["page"].' </a>
                    </li>';
                    ?>
                  
				<?php }elseif($i==$_GET["page"]+1){
                    echo '<li class="page-item" >
                    <a class="page-link" href="?c=crudDias&page='.$i.'">'.$i.' </a>
                    </li>';
                    
                }
                
            }
                ?>
                <li style="<?php echo $_GET['page']==$total_pages-1 || $_GET['page']==$total_pages|| $_GET['page']==$total_pages-2  ? 'display:none' : '' ?>">
				    <a class="page-link" href="">...</a>
			    </li>
                <li class="page-item" style="<?php echo $_GET['page']==$total_pages ||$_GET['page']==$total_pages-1  ? 'display:none' : '' ?>">
                    <a class="page-link" href="?c=crudDias&page<?php echo $total_pages?>"><?php echo $total_pages?> </a>
                </li>
				<!--Para ir a la página siguiente en el enlace ponemos que le lleve a la página actual +1-->
                <li style="<?php echo $_GET['page']==$total_pages ? 'display:none' : '' ?>">
				<a class="page-link" href="?c=crudDias&page=<?php echo $_GET['page']+1?>">></a>
			</li>				
		</ul>
    </nav>
</div>
<?php } ?>
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