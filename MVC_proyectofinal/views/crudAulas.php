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

</head>
<body>

  
  

<?php include "menu.php";
if(isset($_GET["crear"])){
    ?>

    <script>
    
    $(document).ready(function(){
    $("#myModal").modal();
    });
    </script>
        
            <?php
    echo 
'<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLongTitle">Crear aula</h3>
    </div>
    <div class="modal-body">';

    if(isset($_SESSION['vacio'])){
        echo $_SESSION['vacio'];
        unset($_SESSION['vacio']);
    }

    echo "<form action='?c=crearAulas&pag=".$_GET['page']."' method='post' enctype='multipart/form-data'>";
    
    echo '<div class="form-group">
    <label for="">Nombre: </label>';
            echo "<input class='form-control' type='text' name='dato[]' required></input></div>";

    echo '<div class="form-group">
        <label for="">Ubicación: </label>';

            echo "<input class='form-control' type='text' name='dato[]' required></input></div>";

    echo '<div class="form-group">
        <label for="">Información: </label>';

            echo "<input class='form-control' type='text' name='dato[]' required></input></div>";

    echo '<div class="form-group">
        <label for="">Aforo: </label>';

            echo "<input class='form-control' type='number' name='dato[]'required ></input></div>";

    echo '<div class="form-group">
        <label for="">Habilitado: </label>';
        

            echo "<select class='form-control' name='dato[]' required></input>
            <option value ='1' selected> Sí </option>
            <option value ='0' > No </option>
            
            </select></div>";
            
    echo '<div class="form-group">
        <label for="">Imágen: </label>';
    echo "<input type='file' name='files'/></div>";
            
    echo "<input class='btn btn-success'  type='submit'  name='agregar-ult' value='Crear'>  </input>";
    echo '<a href="?c=crudAulas&page='.$_GET['page'].'"><button type="button" class="btn btn-danger">Cancelar</button></a>';

    echo "</form>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

}

if(isset($_SESSION["modificar"])){
    ?>
    
    <script>
    
    $(document).ready(function(){
    $("#myModal").modal();
    });
    </script>
        
            <?php

    $id=$_SESSION["modificar"];

    $resu=$this->crud->modifAulas($id);

    
    echo 
    '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLongTitle">Modificar aula</h3>
            </div>
            <div class="modal-body">';
    echo "<form action='?c=modificarAulas&pag=".$_GET['page']."' method='post' enctype='multipart/form-data' >";
    if(isset($_SESSION['vacio'])){
        echo $_SESSION['vacio'];
        unset($_SESSION['vacio']);
    }
    
    
    foreach($resu as $nombre_columna){
        for($i=0;$i<count($nombre_columna)/2;$i++){
           if($i===0){
            echo '<div class="form-group">
            <label for="">ID: </label>';
            echo "<input class='form-control' type='text' readonly name='dato[]' value='".$nombre_columna[$i]."' required></input></div>";

           }
           
            else if($i===1){
                echo '<div class="form-group">
                <label for="">Ubicación: </label>';
                echo "<input class='form-control' type='text' name='dato[]' value='".$nombre_columna[$i]."' required></input></div>";

            }

            else if($i===2){
                echo '<div class="form-group">
                <label for="">Información: </label>';
                echo "<input class='form-control' type='text' name='dato[]' value='".$nombre_columna[$i]."' required></input></div>";

            }

            else if($i===3){
                echo '<div class="form-group">
                <label for="">Aforo: </label>';
                echo "<input class='form-control' type='number' name='dato[]' value='".$nombre_columna[$i]."' required></input></div>";

            }

            else if($i===4){
                echo '<div class="form-group">
                <label for="">Habilitado: </label>';
                echo '<select name="dato[]" class="form-control" required>';
                if($nombre_columna[$i]==1){

                    echo '<option value="'.$nombre_columna[$i].'" selected>Sí</option>';
                    echo '<option value="'. 0 .'" >No</option>';
                }
                else{
                    echo '<option value="'.$nombre_columna[$i].'" selected>No</option>';
                    echo '<option value="'. 1 .'" >Sí</option>';
                }
                echo '</select></div>';
            }

            
        }

    }

    echo '<div class="form-group">
        <label for="">Imágen: </label>';
    echo "<input type='file' name='files'/></div>";
    
    echo "<input class='btn btn-primary' type='submit'  name='modificar-ult' value='Actualizar'></input>  ";
    echo '<button type="button" class="btn btn-danger cancelar" data-dismiss="modal">Cancelar</button>';

    echo "</form>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
};


$count=$this->crud->crudAulas(1);

if($count[0]==0){
    
    echo '
    <div class="row >
    <div class="col-md-12 ">
    <h1 class="display-3"> No se han creado aulas aún</h1>';
 
    echo "<a href='?c=crudAulas&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>
  
    ";
    

    echo '</div>
    </div>
    </div>';
    
    
}
else{

$iteams_pagina=3;

$total_pages=ceil($count[0]/$iteams_pagina);

$page=0;

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

$offset=($page-1) * $iteams_pagina;

$result=$this->crud->crudAulas(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>



<div class="row" style="margin-top:5%">
    
                <div class="col-md-12 ">
                <h1 style="color:black; text-align:center; margin-bottom:0%; background-color:white" >AULAS</h1>
                    
                    
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
            
                        
                    ?>
       
<?php

       echo '<div class="container" style="margin-top:60px;">


       <div class="row">


                       <div class="col-md-12 ">';
        echo "<a href='?c=crudAulas&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>  ";
       
       echo '<div class="table-responsive-sm">
       <table class="table table-striped bg-white table-hover" style="text-align: center; margin-top:1%">';

        echo "<tr >";

        foreach($result[1] as $indice){
            echo "<th>".$indice."</th>";
        }
        
        echo "<th>Borrar</th>";
        echo "<th>Modificar</th>";
        
        
        echo "</tr>";
        ?>
        
        <form action="?c=borrarAulas&pag=<?php echo $_GET["page"]?>" method="post"> 
            <input type='submit' name='borrar' value='Borrar en lote' class='btn btn-danger' style='float:right;' >

        
        <?php
        foreach($result[0] as $indice=>$dato){
        
            foreach($dato as $x=>$y){
        
                if($x=='imagen'){
                    echo "<td><img src='".$y."' class='img-fluid img-thumbnail' style='width:70px; height:60px;'></td>";
                }
                else{
                echo "<td>".$y."</td>";
                }
            }
      
            ?>

            <td><input type="checkbox" name="eliminar[]" value="<?php echo $dato["id"]?>">
            
            <a class="btn btn-danger"  href="?c=borrarAulas&id=<?php echo $dato["id"] ?>&pag=<?php echo $_GET["page"]?>"><i class="bi bi-trash"></i></a>
        
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
<nav aria-label="..." class="contenedor-paginador" >
  <ul class="pagination pagination-mg justify-content-center">

<?php
for($i=1;$i<=$total_pages;$i++){
    if($i==$page){
        echo "<li class='page-item active'><a class='page-link'>".$i."</a></li>";
    }else{
        echo "<li class='page-item'><a class='page-link' href='?c=crudAulas&page=$i'>$i</a></li>";
        
    }
}

}
?>
  </ul>
</nav>
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