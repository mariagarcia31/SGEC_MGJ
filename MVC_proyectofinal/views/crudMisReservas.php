
<html lang="en">
<head>
  
    <title>Document</title>
</head>
<body>

<?php include "menu.php";


$count=$this->crud->crudMiReservas(1);

if($count[0]==0){
    echo '<div class="container" style="margin-top:60px;margin-right:80px">
    <div class="row">
    <div class="col-md-12 border">
    <h1 class="display-1"> No se han realizado reservas aún</h1>
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

$result=$this->crud->crudMiReservas(2,$iteams_pagina,$offset);

$_SESSION['cuantas']=count($result[0]);



?>
<div class="container" style="margin-top:60px;margin-right:80px">



<div class="row">
    
                <div class="col-md-12 border">

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
                            <html><head><style>#todo{opacity: 0.2;}</style></head></html>
                                <?php

                            $id=$_SESSION["modificar"];
                    
                            $resu=$this->crud->modif($id);

                            

                            echo "<div id='container' ><form action='?c=modificar&pag=".$_GET['page']."' method='post' ><table>";
                            
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
                            unset($_SESSION["modificar"]);
                        };
                        
                        
                        
                    ?>
       
<?php
       // echo "<table class='tabla' cellpadding=5px' >";

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
            
            <a href="?c=borrar&id=<?php echo $dato["id"] ?>&pag=<?php echo $_GET["page"]?>">Borrar</a>
        
            </td>
            <td><button  name="modificar" value="<?php echo $dato["id"] ?>">Modificar</button></td>


            <?php
            echo "</tr>";
        
            }
        
       // echo "</table>";
  
  ?>
           </table>
            
        </div>
        
    </div>

  <input type="submit" name="borrar" value="Borrar" class="btn btn-danger" style="position:relative;left:92%">
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
        echo "<a style='margin-left:10px' href='?c=crudMisReservas&page=$i'>$i</a>";
        
    }
}

}
?>
</div>

</div>





</body>
</html>