<?php

session_start();
require_once ("models/crud.php");

class Control{

    public $crud;

    function __construct()
    {
        $this->crud=new Crud();
    }


    function home(){
        include_once ("views/index.php");
    }

    function principal(){
        include_once ("views/principal.php");
    }

    function c_contra(){
        include_once ("views/cambiar_contra.php");
    }

    function calendario(){
        include_once ("views/calendario.php");
    }

    function crudMisReservas(){
        include_once ("views/crudMisReservas.php");
    }

    function logout(){
        include_once ("views/logout.php");
    }

   




  

    function verificar(){
   
        $correo=$_POST["correo"];
        $contrasena=$_POST["contrasena"];
        
        $result=$this->crud->verificarUsuario($correo,$contrasena);
        $result2=$this->crud->verificarContra($correo);
        
        if($result){

            if($result2){




                header("location:?c=principal"); 
            }else{
                
                header("location:?c=c_contra&correo=$correo"); 
            }             
        }else{
            
            $_SESSION["error"]="Correo o contraseña incorrecta";
            header("location: ?c=home");  
          
        }
    }

 
    function cambio_contra(){

        $result=$this->crud->contraNueva($_GET["_correo"],$_POST["contrasena1"],$_POST["contrasena2"]);

        if($result){

            header("location:?c=principal"); 
            
        }else{
            $_SESSION["error2"]="Las contraseñas tienen que ser iguales";
            header("location:?c=c_contra&correo=".$_GET['_correo']."");     
        }


    }

    function reserva(){


        $resultado=$this->crud->reservar($_SESSION['id'],$_POST['grupo'],$_POST['motivo'],$_POST['timeslot'],$_GET['id'],$_GET['date']);

        if($resultado){

            $_SESSION["msg"]="<div class='alert alert-success'>Reserva realizada</div>";
            header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id'].""); 
            
        }else{

            $_SESSION["msg"]="<div class='alert alert-danger'>Ya reservado</div>";
            header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id'].""); 
        }
       

    }
    
    function borrar(){

        
        if(isset($_POST["borrar"])){
            $result=$this->crud->borrar($_POST["eliminar"]);
            if($result){
                $_SESSION["exito"]="<div class='alert alert-success'>Reserva eliminada con éxito.</div>";
                $cuantos=count($_POST["eliminar"]);
                if($_SESSION['cuantas']==$cuantos){
                    header("location:?c=crudMisReservas&page=".$_GET["pag"]-1 ."");
                }
                else{
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
                }
            }else{
                $_SESSION["error2"]="<div class='alert alert-danger'>No se ha seleccionado ninguna reserva para eliminar</div>";
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }
        
        }
        elseif(isset($_POST["modificar"])){
            $_SESSION["modificar"]=$_POST["modificar"];
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");

        }else{
            $result=$this->crud->borrarUnoaUno($_GET["id"]);
            $_SESSION["exito"]="<div class='alert alert-success'>Reserva eliminada con éxito.</div>";
            if($_SESSION['cuantas']==1){
                header("location:?c=crudMisReservas&page=".$_GET["pag"] - 1 ."");
            }
            else{
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }
            

        }
      
    }

    function modificar(){
        //echo "<div class='alert alert-danger'>Ya existe una reserva con este día, hora y aula</div>";
        if(isset($_POST['cancelar'])){
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }
        else{
        
        $resultado=$this->crud->actualizar($_POST["dato"]);

        if($resultado){
            $_SESSION["exito"]="<div class='alert alert-success'>Reserva modificada con éxito.</div>";

            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }else{
            $_SESSION["error2"]="<div class='alert alert-danger'>Ya existe una reserva con este día, hora y aula</div>";
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");

        }

    }}


}



?>