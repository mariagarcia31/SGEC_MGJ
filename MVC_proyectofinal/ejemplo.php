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
      function gruposDisponibles(){

        $comprobar="SELECT * FROM reservas ;";
            $consulta_comprobar=$this->conexion()->prepare($comprobar);
            $consulta_comprobar->execute();
            $resultado_comprobar=$consulta_comprobar->fetchAll(PDO::FETCH_ASSOC);
       
        return $resultado_comprobar;

    }
      
     /*************************************  FIN MODELO DE AULAS  ********************************/
   
       

}



$precio=new Precio();
$datos= $precio->gruposDisponibles();


print_r($datos[0]['idUsuario']);



exit();


?>