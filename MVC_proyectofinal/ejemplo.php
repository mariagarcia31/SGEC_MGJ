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
   
    function ver($correo){
        $sql="SELECT * FROM usuarios WHERE (correo='$correo' OR usuario='$correo');";
        $con=$this->conexion()->prepare($sql);
        $con->execute();
        $consult=$con->fetchAll(PDO::FETCH_ASSOC);
        return $consult[0]["id"];
    }

}



$precio=new Precio();

print_r($precio->ver("josu"));
?>
