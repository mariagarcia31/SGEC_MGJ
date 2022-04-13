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


        $resultado=$this->crud->reservar(1,$_POST['grupo'],$_POST['motivo'],$_POST['timeslot'],$_GET['id'],$_GET['date']);

        if($resultado){

            $_SESSION["msg"]="<div class='alert alert-success'>Reserva realizada</div>";
            header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id'].""); 
            
        }else{

            $_SESSION["msg"]="<div class='alert alert-danger'>Ya reservado</div>";
            header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id'].""); 
        }
       

    }
    
    function borrar(){

        if(isset($_POST["eliminar"])){
            $result=$this->crud->borrar($_POST["eliminar"]);
            if($result){
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }else{
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }
        
        }
        elseif(isset($_POST["modificar"])){
            $_SESSION["modificar"]=$_POST["modificar"];
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");

        }else{
            $result=$this->crud->borrarUnoaUno($_GET["id"]);
          
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            
            

        }
      
    }

    function modificar(){
        //echo "<div class='alert alert-danger'>Ya existe una reserva con este día, hora y aula</div>";

        $resultado=$this->crud->actualizar($_POST["dato"]);

        if($resultado){
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }else{
            header("location:?c=home");

        }

    }


}



?>