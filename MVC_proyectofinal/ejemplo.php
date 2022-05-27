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
        
        $sql="SELECT confirmacion, correo from usuarios where (correo = :email or usuario = :email);";

        $consulta=$this->conexion()->prepare($sql);
        $consulta->bindParam(":email",$correo);
        $consulta->execute();
        $verif1=$consulta->fetchAll();

        return $verif1;
    }

    

}



$precio=new Precio();
$resultado=$precio->ver('ama2');

    print_r($resultado[0]['confirmacion']);



?>
