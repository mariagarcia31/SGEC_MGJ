<?php

class Precio{

    public function conexion(){
        try{
            $conexion=new PDO("mysql:host=localhost:33065;dbname=sgec","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
   
        }
    }
      /*************************************  MODELO DE AULAS   ********************************/
      function gruposDisponibles(){

        $sql="SELECT imagen FROM aulas WHERE id= 'Aula 100';";
        $stmt=$this->conexion()->prepare($sql);
        $stmt->execute();
        $resultado_imagen=$stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado_imagen;

    }
      
     /*************************************  FIN MODELO DE AULAS  ********************************/
   
       

}



$precio=new Precio();
$datos= $precio->gruposDisponibles();

if(empty($datos['imagen'])){

print_r($datos);
}
else{
    echo "no vacio";
}




?>

<form action="" method="post">
    Correo<input type="email" name="correo" >
    <input type="submit" name="enviar">
</form>

<?php  

    if(isset($_POST["enviar"])){
        $correo=$_POST["correo"];
        

        if(strpos($correo, "@") && (strpos($correo, "ciudadescolar") || strpos($correo, "educa.madrid")) && strpos($correo, ".")){
            echo "funciona";
        }else{
            echo "no funciona";
        }
    }

?>