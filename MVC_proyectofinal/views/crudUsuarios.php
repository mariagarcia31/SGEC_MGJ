<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>
<html lang="en">
<head>
  
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".alert").delay( 2200 ).fadeOut(1100);
  });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/cssc/login&check.css">
</head>
<style>
    .modal-content{
  display: flex;
    flex-direction: column;
    align-items: center;

}
</style>
<body>

<?php include "menu.php";





$count=$this->crud->crudUsuarios(1);


$iteams_pagina=3;

$total_pages=ceil($count[0]/$iteams_pagina);

$page=0;

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

$offset=($page-1) * $iteams_pagina;

$result=$this->crud->crudUsuarios(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>

<script>

$(document).ready(function(){
$("#myModal").modal();
});
</script>

<div class="row" style="margin-top:5%">
    
                <div class="col-md-12 ">
                <h1 style="color:black; text-align:center; margin-bottom:0%; background-color:white" >Usuarios</h1>
                    
                    
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
          <h3 class="modal-title" id="exampleModalLongTitle">Crear usuario</h3>
        </div>
        <div class="modal-body">';

        echo "<form action='?c=crearUsuarios&pag=".$_GET['page']."' method='post'>";
        if(isset($_SESSION['vacio'])){
            echo $_SESSION['vacio'];
            unset($_SESSION['vacio']);
        }
                                
                               
                                  
                                        echo "<input class='form-control' type='hidden'  name='dato[]' value='null' ></input>";
                                      
                                        echo '<div class="form-group">
                                        <label for="">Nombre</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                            
                                        
                                  
                                        echo '<div class="form-group">
                                        <label for="">Correo</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                                        echo '<div class="form-group">
                                        <label for="">Primer Apellido</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                                        echo '<div class="form-group">
                                        <label for="">Segundo apellido</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                                        echo '<div class="form-group">
                                        <label for="">Usuario</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                                        echo '<div class="form-group">
                                        <label for="">Puesto</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                        echo '</div>';
                                           echo '<div class="form-group">
                                            <label for="">Contraseña</label>';
                                            echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                            echo '</div>';
                                         
                                            echo '<div class="form-group">
                                        <label for="">Confirmación</label>';
                                        echo "<select name='dato[]' class='form-control' required>";

                                        echo "  <option value='0' selected>No</option>
                                        <option value='1' >Si</option>";
                                       
                                 
                                    echo "</select>";
                                        echo '</div>';
                                           
                                                echo '<div class="form-group">
                                                <label for="">Rol</label>';
                                                echo "<input class='form-control' type='text'  name='dato[]' value='' ></input>";
                                                echo '</div>';
                                            
                                            
                            
                                       
                                       
                                       
                            
                                       
                                        
                                    
                                
                                
                                echo '<div class="modal-footer">';
                                echo "<input class='btn btn-primary' type='submit'  name='agregar-ult' value='Crear'></input> ";
                                echo "<input class='btn btn-danger' type='submit'  name='cancelar' value='Cancelar'></input>";
                                echo '</div>';
                                echo "</form>";
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                
                            };
                            
                            



                    
                    if(isset($_SESSION["modificar"])){

                            
    $id=$_SESSION["modificar"];

    $resu=$this->crud->modifUsuarios($id);

    echo  
'<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Modificar usuario</h3>
        </div>
        <div class="modal-body">';

    echo "<form action='?c=modificarUsuarios&pag=".$_GET['page']."' method='post'>";
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
                                    <label for="">Nombre</label>';
                                    echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                    echo '</div>';
                        
                                    
                               }
                        
                                   elseif($i==2){
                                    echo '<div class="form-group">
                                    <label for="">Correo</label>';
                                    echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                    echo '</div>';
                                    }
                                    elseif($i==3){
                                        echo '<div class="form-group">
                                        <label for="">Primer apellido</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                        echo '</div>';
                                        }
                                        elseif($i==4){
                                            echo '<div class="form-group">
                                            <label for="">segundo apellido</label>';
                                            echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                            echo '</div>';
                                    }elseif($i==5){
                                      echo '<div class="form-group">
                                        <label for="">Usuario</label>';
                                          echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                         echo '</div>';
                                    }
                                    elseif($i==6){
                                        echo '<div class="form-group">
                                        <label for="">Puesto</label>';
                                        echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                        echo '</div>';
                                        }
                                    elseif($i==7){
                                      
                                        echo "<input class='form-control' type='hidden'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                     
                                        }
                    
                                       elseif($i==8){
                                        echo '<div class="form-group">
                                        <label for="">Confirmación</label><select name="dato[]" class="form-control" required>';
                                        if($nombre_columna[$i]==0){
                                            echo "  <option value='0' selected>No</option>
                                            <option value='1' >Si</option>";
                                        }else{
                                            echo "  <option value='0' >No</option>
                                            <option value='1' selected>Si</option>";
                                        }
                                        echo "</select></div>";
                                        }
                        
                                        else if($i==9){
                                            echo '<div class="form-group">
                                            <label for="">Rol</label>';
                                            echo "<input class='form-control' type='text'  name='dato[]' value='".$nombre_columna[$i]."' required></input>";
                                            echo '</div>';
                                        }
                                        
                        
                                   
                                   
                                   
                        
                                   
                                    
                                }
                            }
                            
                            echo '<div class="modal-footer">';
                            echo "<input class='btn btn-primary' type='submit'  name='modificar-ult' value='Actualizar'></input> ";
                            echo "<input class='btn btn-danger' type='submit'  name='cancelar' value='Cancelar'></input>";
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
                       echo "<form action='' method='post' >
                            <input class='btn btn-primary' type='submit' name='cargar' value='Cargar Usuarios'>
                            </form>";
        echo "<a href='?c=crudUsuarios&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>  ";
       
       echo                    '<table class="table table-striped bg-white table-hover" style="text-align: center; margin-top:1%">';

        echo "<tr >";

        foreach($result[1] as $indice){
            echo "<th>".$indice."</th>";
        }
        
        echo "<th>Borrar</th>";
        echo "<th>Modificar</th>";
        
        
        echo "</tr>";
        if(isset($_POST["cargar"])){
            echo  
            '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document" >
                  <div class="modal-content" >
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLongTitle">Cargar usuario</h3>
                    </div>
                    <div class="modal-body">';
            echo '<div class="form"><form class="login-form" class="form" enctype="multipart/form-data" method="post" action="?c=cargarUsuarios&pag='.$_GET["page"].'">
                    <input type="file" name="file" id="file">
                  

                    </div>';            

            echo '<div class="modal-footer">  <input type="submit" class="btn btn-success" value="Cargar" name="enviar">
            <input type="submit" class="btn btn-danger" value="Cancelar" name="cancelar"></div></form></div></div></div></div>';
     
                                        
                                  
          
        
        }

        ?>
<form action="?c=borrarUsuarios&pag=<?php echo $_GET["page"]?>" method="post"> 
<input type='submit' name='borrar' value='Borrar en lote' class='btn btn-danger' style='float:right;' >
<?php
        
        foreach($result[0] as $indice=>$dato){
        
            foreach($dato as $x=>$y){
                
                    echo "<td>".$y."</td>";

                
            
                
                //$vivienda=new Vivienda($y);
                //$i=new Vivienda($dato["id"],$dato["tipo"],$dato["zona"],$dato["direccion"],$dato["ndormitorios"],$dato["tamano"],$dato["precio"]);           
            }
      
            ?>
            
            <?php if($dato["rol"]==1){?>
            <td>No</td>
            <?php  }else{?>
            <td><input type="checkbox" name="eliminar[]" value="<?php echo $dato["id"]?>">
            
            <a class="btn btn-danger"  href="?c=borrarUsuarios&id=<?php echo $dato["id"] ?>&pag=<?php echo $_GET["page"]?>"><i class="bi bi-trash"></i></a>
            </td>
            <?php }?>
            <td><button  title="Modificar" class="btn btn-primary" name="modificar" value="<?php echo $dato["id"] ?>"> <i class="bi bi-pencil-square"></i></button></td>


            <?php
            echo "</tr>";
        
            }
        
       // echo "</table>";
  
  ?>
           </table>
        </div>
        
    

  
 </form>



 <?php
 
 //--------------------------------------------------------------------

echo "<br>";

//listado

?>
<nav aria-label="..." class="contenedor-paginador" >
  <ul class="pagination pagination-mg justify-content-center">

<?php
for($i=1;$i<=$total_pages;$i++){
    if($i==$page){
        echo "<li class='page-item active'><a class='page-link'>".$i."</a></li>";
    }else{
        echo "<li class='page-item'><a class='page-link' href='?c=crudUsuarios&page=$i'>$i</a></li>";
        
    }
}


?>
  </ul>
</nav>

</body>
</html>