
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
</head>
<body>

<?php include "menu.php";


$count=$this->crud->crudAulas(1);

if($count[0]==0){
    echo '<div class="container" style="margin-top:60px;margin-right:80px">
    <div class="row">
    <div class="col-md-12 border">
    <h1 class="display-1"> No se han creado aulas aún</h1>
    </div>
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
<div class="container" style="margin-top:60px;margin-right:80px">



<div class="row">
    
                <div class="col-md-12 border">
                
                    <table class="table table-striped" style="text-align: center;">
                    
                    <?php
                    /*AGREGAR AQUI EL FORMULARIO PARA CREAR */
                    
                   echo "<a href='?c=crudAulas&page=".$_GET['page']."&crear=1'><button name='crear'  class='btn btn-success'> Agregar</button></a>";
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

                        echo "<div id='container' ><form action='?c=crearAulas&pag=".$_GET['page']."' method='post' ><table>";
                        
                       
                                echo "<tr>Nombre: <input type='text' name='dato[]'></input></tr>";
                                echo "<tr>Ubicación: <input type='text' name='dato[]'></input></tr>";
                                echo "<tr>Información: <input type='text' name='dato[]'></input></tr>";
                                echo "<tr>Aforo: <input type='number' name='dato[]'></input></tr>";
                                echo "<tr>Habilitado: <input type='number' name='dato[]'></input></tr>";
                

                 
                        echo "<tr><div><input type='submit'  name='agregar-ult' value='Agregar'></input>";
                        echo "<input type='submit'  name='cancelar' value='Cancelar'></input></div></tr>";
                
                        echo "</table></form></div>";




                    }



                    
                    if(isset($_SESSION["modificar"])){

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modifAulas($id);

                            

                            echo "<div id='container' ><form action='?c=modificarAulas&pag=".$_GET['page']."' method='post' ><table>";
                            if(isset($_SESSION['vacio'])){
                                echo $_SESSION['vacio'];
                                unset($_SESSION['vacio']);
                            }
                            foreach($resu as $nombre_columna){
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
                            echo "<input type='submit'  name='cancelar' value='Cancelar'></input></div></tr>";
                    
                            echo "</table></form></div>";
                            
                        };
                        
                        
                        
                    ?>
       
<?php
       echo '<div class="container" style="margin-top:60px;margin-right:80px">



       <div class="row">
           
                       <div class="col-md-12 border">
       
                           <table class="table table-striped bg-white" style="text-align: center;">';

        echo "<tr >";

        foreach($result[1] as $indice){
            echo "<th>".$indice."</th>";
        }
        
        echo "<th>Borrar</th>";
        echo "<th>Modificar</th>";
        
        
        echo "</tr>";
        
        foreach($result[0] as $indice=>$dato){
        
            foreach($dato as $x=>$y){
        
            
                echo "<td>".$y."</td>";
                
                //$vivienda=new Vivienda($y);
                //$i=new Vivienda($dato["id"],$dato["tipo"],$dato["zona"],$dato["direccion"],$dato["ndormitorios"],$dato["tamano"],$dato["precio"]);           
            }
      
            ?>
            <form action="?c=borrarAulas&pag=<?php echo $_GET["page"]?>" method="post"> 

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
    
  <input type="submit" name="borrar" value="Borrar en lote" class="btn btn-danger" style="position:relative;left:92%">
  
 </form>

   



 <?php
 //--------------------------------------------------------------------

echo "<br>";

//listado

?>
<div class="container" style="margin-top:60px;margin-right:80px">



<div class="row">
                <div class="col-md-12 border">
<?php
for($i=1;$i<=$total_pages;$i++){
    if($i==$page){
        echo "<a style='margin-left:10px'>".$i."</a>";
    }else{
        echo "<a style='margin-left:10px' href='?c=crudAulas&page=$i'>$i</a>";
        
    }
}

}
?>
</div>

</div>


</body>
</html>