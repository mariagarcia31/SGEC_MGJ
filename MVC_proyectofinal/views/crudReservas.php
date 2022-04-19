
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


$count=$this->crud->crudReservas(1);

if($count[0]==0){
    echo '<div class="container" style="margin-top:60px;margin-right:80px">
    <div class="row">
    <div class="col-md-12 ">
    <h1 class="display-1" style="color:#1A3C40"> No se han realizado reservas aún</h1>
    </div>
    </div>
    </div>';}
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

$result=$this->crud->crudReservas(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>
<div class="container" style="margin-top:5%">



<div class="row">
    
                <div class="col-md-12 " style="border:none">
<h1 style="color:#1A3C40; text-align:center; margin-bottom:5%; background-color:white" >RESERVAS</h1>
                    <table class="table table-striped" style="text-align: center;">
                    <?php 
                    if(isset($_SESSION['error2'])){
                        echo $_SESSION['error2'];
                        unset($_SESSION['error2']);
                    }
                    else if(isset($_SESSION['exito'])){
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                    
                    if(isset($_SESSION["modificar"])){
                            ?>
                            
                                <?php

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modif($id);

                            

                            echo "<div id='container' ><form action='?c=modificar&pag=".$_GET['page']."' method='post' ><table>";
                            if(isset($_SESSION['vacio'])){
                                echo $_SESSION['vacio'];
                                unset($_SESSION['vacio']);
                            }
                            foreach($resu as $nombre_columna){
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
                        
                        
                        
                    ?>
       
<?php
       echo '



       <div class="row">
           
                       <div class="col-md-12">
                       <input type="submit" name="borrar" value="Borrar en lote" class="btn btn-danger" style="float:right">

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
            <form action="?c=borrar&pag=<?php echo $_GET["page"]?>" method="post"> 

            <td><input type="checkbox" name="eliminar[]" value="<?php echo $dato["id"]?>">
            
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

</body>
</html>