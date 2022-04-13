<?php

class Conexion{

    public function conexion(){
        try{
            $conexion=new PDO("mysql:host=127.0.0.1:33065;dbname=sgec","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
   
        }
    }

}

?>