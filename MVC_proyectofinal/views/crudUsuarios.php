
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


$count=$this->crud->crudUsuarios(1);

if($count[0]==0){
    
    echo '
    <div class="row >
    <div class="col-md-12 ">
    <h1 class="display-3"> No se han creado Usuarios aún</h1>';
 
    echo "<a href='?c=crudUsuarios&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>
  
    ";
    if(isset($_GET["crear"])){
        if(isset($_SESSION['vacio'])){
            echo $_SESSION['vacio'];
            unset($_SESSION['vacio']);
        }

        echo "<div style='    width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        align-content: center;'><form action='?c=crearUsuarios&pag=".$_GET['page']."' method='post' > <table class='table table-striped bg-white ' style='margin-top:2%'>";
        
                echo '<tr>';
                echo '<th> id</th>';
                echo '<th> nombre</th>';
                echo '<th> correo</th>';
                echo '<th> contra</th>';
                echo '<th> confirmacion</th>';
                echo '<th> rol</th>';
               

                echo '</tr>';
                echo '<tr>';
                echo "<td><input type='number' name='dato[]' style='width:210px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:220px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:220px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:80px'></input></td>";
                echo "<td><input type='number' name='dato[]' style='width:50px'></input></td>";
                echo "<td><input type='number' name='dato[]' style='width:50px'></input></td>";
               

                echo '</tr>';

                echo "</table>";
        echo "<input class='btn btn-primary'  type='submit'  name='agregar-ult' value='Crear'>  </input>";
        echo "<input  class='btn btn-danger'type='submit'  name='cancelar' value='Cancelar'></input>";

        echo "</form></div>";




    }

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

$result=$this->crud->crudUsuarios(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>



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

                        echo "<div style='    width: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        align-content: center;'><form action='?c=crearUsuarios&pag=".$_GET['page']."' method='post' > <table class='table table-striped bg-white ' style='margin-top:2%'>";
                        
                        echo '<tr>';
                echo '<th> id</th>';
                echo '<th> nombre</th>';
                echo '<th> correo</th>';
                echo '<th> contra</th>';
                echo '<th> confirmacion</th>';
                echo '<th> rol</th>';
               

                echo '</tr>';
                echo '<tr>';
                echo "<td><input type='number' name='dato[]' style='width:210px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:220px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:220px'></input></td>";
                echo "<td><input type='text' name='dato[]' style='width:80px'></input></td>";
                echo "<td><input type='number' name='dato[]' style='width:50px'></input></td>";
                echo "<td><input type='number' name='dato[]' style='width:50px'></input></td>";
               

                echo '</tr>';

                                echo "</table>";
                        echo "<input class='btn btn-primary'  type='submit'  name='agregar-ult' value='Crear'>  </input>";
                        echo "<input  class='btn btn-danger'type='submit'  name='cancelar' value='Cancelar'></input>";
                
                        echo "</form></div>";

                    }



                    
                    if(isset($_SESSION["modificar"])){

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modifUsuarios($id);

                            

                            echo "<div id='container' style='    width: 100%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            align-content: center;' ><form action='?c=modificarUsuarios&pag=".$_GET['page']."' method='post' ><table class='table table-striped bg-white ' style='margin-top:2%'>";
                            if(isset($_SESSION['vacio'])){
                                echo $_SESSION['vacio'];
                                unset($_SESSION['vacio']);
                            }
                            echo '<tr>';
                            echo '<th> id</th>';
                            echo '<th> nombre</th>';
                            echo '<th> correo</th>';
                            echo '<th> contra</th>';
                            echo '<th> confirmacion</th>';
                            echo '<th> rol</th>';
                            echo '</tr>';
                            echo '<tr>';
                            
                            foreach($resu as $nombre_columna){
                                for($i=0;$i<count($nombre_columna)/2;$i++){
                                   if($i===1||$i===2||$i===3){
                                    echo "<th><input type='text'  name='dato[]' value='".$nombre_columna[$i]."' style='width:150px'></input></th>";
                    
                                   }
                                  
                                    else{
                                      
                                        echo "<th ><input type='number' name='dato[]' value='".$nombre_columna[$i]."' style='width:75px'></input></th>";

                                    }
                                }
                            }
                            echo '</tr></table>';
                            echo "<input class='btn btn-primary' type='submit'  name='modificar-ult' value='Actualizar'></input>  ";
                            echo "<input class='btn btn-danger' type='submit'  name='cancelar' value='Cancelar'></input>";
                    
                            echo "</form></div>";
                            
                        };
                        
                        
                        
                    ?>
       
<?php

       echo '<div class="container" style="margin-top:60px;">



       <div class="row">
           
                       <div class="col-md-12 ">';
        echo "<a href='?c=crudUsuarios&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>  ";
       
       echo                    '<table class="table table-striped bg-white table-hover" style="text-align: center; margin-top:1%">';

        echo "<tr >";

        foreach($result[1] as $indice){
            echo "<th>".$indice."</th>";
        }
        
        echo "<th>Borrar</th>";
        echo "<th>Modificar</th>";
        
        
        echo "</tr>";
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
            

            <td><input type="checkbox" name="eliminar[]" value="<?php echo $dato["id"]?>">
            
            <a class="btn btn-danger"  href="?c=borrarUsuarios&id=<?php echo $dato["id"] ?>&pag=<?php echo $_GET["page"]?>"><i class="bi bi-trash"></i></a>
        
            </td>
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

}
?>
  </ul>
</nav>

</body>
</html>