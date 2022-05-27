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
   
    function ver(){
        $qry = "SELECT departamentos.nombre from departamentos 
        INNER JOIN puestos ON departamentos.id = puestos.idDepartamento
        where puestos.nombre='Intervención Sociocomunitaria'";

    $consulta= $this->conexion()->prepare($qry);
    $consulta->execute();
    $resultado_departamentos=$consulta->fetchAll();

        return $resultado_departamentos;
    }

    

}



$precio=new Precio();
$resultado=$precio->ver();
print_r($resultado[0]['nombre']);

?>
