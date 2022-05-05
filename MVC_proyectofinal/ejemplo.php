<?php

class Precio{

    public function conexion(){
        try{
            $conexion=new PDO("mysql:host=localhost;dbname=sgec","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
   
        }
    }
      /*************************************  MODELO DE AULAS   ********************************/
      function maximoDiasSiguientes(){
        $comprobar="SELECT valor FROM `configuracion` WHERE nombre = 'Máximo de días siguientes para reservar'";
        $consulta_comprobar=$this->conexion()->prepare($comprobar);
        $consulta_comprobar->execute();
        $resultado_comprobar=$consulta_comprobar->fetch();
       
        return $resultado_comprobar['valor'];

    }
      
     /*************************************  FIN MODELO DE AULAS  ********************************/
   
       

}



$precio=new Precio();
$datos= $precio->maximoDiasSiguientes();

        print_r($datos);


?>
