


<?php

session_start();
require_once ("models/crud.php");
include ("libs/js/scripts.html");

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
    function ayuda(){
        include_once ("views/ayuda.php");
    }
    function configuracion(){
        include_once ("views/configuracion.php");
    }
    function c_contra(){
        include_once ("views/cambiar_contra.php");
    }

    function calendario(){
        include_once ("views/calendario.php");
    }

    function calendarioSemanal(){
        include_once ("views/calendarioSemanal.php");
    }

    function crudMisReservas(){
        include_once ("views/crudMisReservas.php");
    }

    function crudAulas(){
        include_once ("views/crudAulas.php");
    }

    function crudRoles(){
        include_once ("views/crudRoles.php");
    }
    function crudUsuarios(){
        include_once ("views/crudUsuarios.php");
    }

    function crudGrupos(){
        include_once ("views/crudGrupos.php");
    }

    function crudReservas(){
        include_once ("views/crudReservas.php");
    }
    function crudFestivos(){
        include_once ("views/crudFestivos.php");
    }
    function estadisticas(){
        include_once ("views/estadisticas.php");
    }


    function logout(){
        include_once ("views/logout.php");
    }

    function cargarUsuarios(){
           if(isset($_POST["enviar"])){
            $result=$this->crud->cargarUsuarios();
           }
           if(isset($_POST["cancelar"])){
            header("location:?c=crudUsuarios&page=".$_GET['page']."");     
           }

           if($result){
            $_SESSION["exito"]=" 
        

            <script>    Swal.fire({
                icon: 'success',
                title: 'Usuarios cargados con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
              
            header("location:?c=crudUsuarios&page=".$_GET['pag'].""); 
            
           }else{
            $_SESSION["exito"]=" 
        

            <script>    Swal.fire({
                icon: 'error',
                title: 'La extensión del archivo debe ser .csv/.txt',
                showConfirmButton: false,
                timer: 2500
              });</script>";
              
            header("location:?c=crudUsuarios&page=".$_GET['pag'].""); 
           }
        
    }




  

    function verificar(){
   
        $correo=$_POST["correo"];
        $contrasena=$_POST["contrasena"];
        
        $result=$this->crud->verificarUsuario($correo,$contrasena);
        $result2=$this->crud->verificarContra($correo);
        if($result){

            if($result2){

                if(isset($_POST['recordar'])) {
                    $_SESSION["cambiado"]="ok";
                    setcookie("contrasena",$contrasena,time()+600);
                    setcookie("correo",$correo,time()+600);
                    header("location:?c=principal"); 
                }else{
                    $_SESSION["cambiado"]="ok";
                    header("location:?c=principal"); 
                }
 
            }else{
                $_SESSION['correo']=$correo;
                header("location:?c=c_contra&correo=$correo"); 
            }             
        }else{
            
            $_SESSION["error"]="
        

        <script>     Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Correo o contraseña incorrecta.',
            footer: ''
          })</script>";  
            header("location: ?c=home");  
          
        }
    }

 
    function cambio_contra(){
        $n_correo=$_POST["n_correo"];
        
        $result=$this->crud->contraNueva($_GET["correo"],$_POST["contrasena1"],$_POST["contrasena2"],$n_correo);

        if($result){
            $_SESSION["cambiado"]="ok";
            header("location:?c=principal"); 
            
        }else{
            if(isset($_GET["conf"])){
                $_SESSION["error2"]="
        

                <script>     Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Las contraseñas deben ser iguales y el correo debe ser con dominio @ciudadescolarfp.es',
                    footer: ''
                })</script>";
                header("location:?c=configuracion&page=1");     

            }else{
                $_SESSION["error2"]="
        

                <script>     Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Las contraseñas deben ser iguales y el correo debe ser con dominio @ciudadescolarfp.es',
                    footer: ''
                  })</script>";
                header("location:?c=c_contra&correo=".$_GET["correo"]."");     
            }
           
        }


    }

    function reserva(){


        $resultado=$this->crud->reservar($_SESSION['id'],$_POST['grupo'],$_POST['motivo'],$_POST['timeslot'],$_GET['id'],$_GET['date']);

        if($resultado){

            $_SESSION["msg"]=" 
        

            <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva realizada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
              $this->crud->enviarCorreo("SGEC-Confirmacion de reserva", "Se ha confirmado la reserva para ".$_GET["id"]." el día ".$_GET["date"]. " en el tramo ".$_POST["timeslot"], $_SESSION["correo"]);
            
              header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id']."&month=".$_GET['month']."&year=".$_GET['year'].""); 
            
        }else{

            $_SESSION["msg"]="<div class='alert  '>Ya reservado</div>";
            header("location:?c=calendario&date=".$_GET['date']."&id=".$_GET['id']."&month=".$_GET['month']."&year=".$_GET['year'].""); 
        }
       

    }

    function reservaSemanal(){


        $resultado=$this->crud->reservar($_SESSION['id'],$_POST['grupo'],$_POST['motivo'],$_POST['timeslot'],$_GET['id'],$_GET['date']);

        if($resultado){

            $_SESSION["msg"]=" 
        

            <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva realizada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
              $this->crud->enviarCorreo("SGEC-Confirmacion de reserva", "Se ha confirmado la reserva para ".$_GET["id"]." el día ".$_GET["date"]. " en el tramo ".$_POST["timeslot"], $_SESSION["correo"]);

            header("location:?c=calendarioSemanal&id=".$_GET['id']."&week=".$_GET['week']."&year=".$_GET['year'].""); 
            
        }else{

            $_SESSION["msg"]="<div class='alert  '>Ya reservado</div>";
            header("location:?c=calendarioSemanal&id=".$_GET['id']."&week=".$_GET['week']."&year=".$_GET['year'].""); 
        }
       

    }
    
    
    /******************************   CONTROLADOR MIS RESERVAS  ********************************/
    function borrar(){

        
        if(isset($_POST["borrar"])){
            $result=$this->crud->borrar($_POST["eliminar"]);
            if($result){
                $_SESSION["exito"]="
        

                <script>    Swal.fire({
                    icon: 'success',
                    title: 'Reserva eliminada con éxito',
                    showConfirmButton: false,
                    timer: 1500
                  });</script>";                
                  $cuantos=count($_POST["eliminar"]);
                if($_SESSION['cuantas']==$cuantos){
                    header("location:?c=crudMisReservas&page=".$_GET["pag"]-1 ."");
                }
                else{
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
                }
            }else{
                $_SESSION["error2"]="
        

            <script>     Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'No se ha seleccionado ninguna reserva para eliminar.',
                footer: ''
              })</script>";
                header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }
        
        }
        elseif(isset($_POST["modificar"])){
            $_SESSION["modificar"]=$_POST["modificar"];
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");

        }else{
            $result=$this->crud->borrarUnoaUno($_GET["id"]);
            $_SESSION["exito"]="
        

            <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva eliminada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
            if($_SESSION['cuantas']==1){
                header("location:?c=crudMisReservas&page=".$_GET["pag"] - 1 ."");
            }
            else{
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
            }
            

        }
      
    }

    function modificar(){
        //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
        if(isset($_POST['cancelar'])){
            unset($_SESSION["modificar"]);
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }
        else{
        
        $resultado=$this->crud->actualizar($_POST["dato"]);

        if($resultado===3){
            
            $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
            
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }
        else if($resultado){
            $_SESSION["exito"]="
        

            <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva modificada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";
            unset($_SESSION["modificar"]);
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");
        }else{
            $_SESSION["error2"]="<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
            header("location:?c=crudMisReservas&page=".$_GET["pag"]."");

        }

    }
}
/******************************   FINAL CONTROLADOR MIS RESERVAS  ********************************/








/******************************   CONTROLADOR RESERVAS  ********************************/
function borrarReservas(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarReservas($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
    

            <script>    Swal.fire({
                icon: 'success',
                title: 'Reserva eliminada con éxito',
                showConfirmButton: false,
                timer: 1500
              });</script>";                $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudReservas&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudReservas&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ninguna reserva para eliminar</div>";
            header("location:?c=crudReservas&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudReservas&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoReservas($_GET["id"]);
        $_SESSION["exito"]="
    

        <script>    Swal.fire({
            icon: 'success',
            title: 'Reserva eliminada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudReservas&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudReservas&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarReservas(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);
        header("location:?c=crudReservas&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarReservas($_POST["dato"]);

    if($resultado===3){
        
        $_SESSION["error2"]="
        

        <script>     swal({
            title: 'No se ha cambiado ningún campo. ',
              text: '',
              type: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Entendido'
    
            });</script>";       
        header("location:?c=crudReservas&page=".$_GET["pag"]."");
    }
    else if($resultado){
        $_SESSION["exito"]="
    

        <script>    Swal.fire({
            icon: 'success',
            title: 'Reserva modificada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        unset($_SESSION["modificar"]);
        header("location:?c=crudReservas&page=".$_GET["pag"]."");
    }else{
        $_SESSION["error2"]="
        

        <script>     swal({
            title: 'Ya existe una reserva con ese día, fecha y aula. ',
              text: '',
              type: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Entendido'
    
            });</script>";        
            header("location:?c=crudReservas&page=".$_GET["pag"]."");

    }

}
}
/******************************   FINAL CONTROLADOR RESERVAS  ********************************/




/******************************   CONTROLADOR AULAS               ********************************/
function borrarAulas(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarAulas($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Aula eliminada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
            $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudAulas&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudAulas&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ningún aula para eliminar</div>";
            header("location:?c=crudAulas&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudAulas&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoAulas($_GET["id"]);
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Aula eliminada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudAulas&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarAulas(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarAulas($_POST["dato"], $_FILES['files']);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Aula modificada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        unset($_SESSION["modificar"]);
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
        
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
    }
    

}
}


function crearAulas(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
    }
    else if($_POST['dato'][0]==null || $_POST['dato'][1]==null || $_POST['dato'][2]==null || $_POST['dato'][3]==null || $_POST['dato'][4]==null ){
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Debe rellenar todos los campos',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        header("location:?c=crudAulas&page=".$_GET["pag"]."&crear=1");
    }
    else{
    
    $resultado=$this->crud->crearAulas($_POST["dato"], $_FILES['files']);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Aula creada con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        unset($_SESSION["modificar"]);
        header("location:?c=crudAulas&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> Ya existe un aula con ese nombre</div>";
        
        header("location:?c=crudAulas&page=".$_GET["pag"]."&crear=1");
    }
    

}
}

/******************************   FINAL CONTROLADOR AULAS         ********************************/




/******************************   CONTROLADOR ROLES               ********************************/
function borrarRoles(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarRoles($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Rol eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
            $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudRoles&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudRoles&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ningún Rol para eliminar</div>";
            header("location:?c=crudRoles&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudRoles&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoRoles($_GET["id"]);
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Rol eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudRoles&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarRoles(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y Role</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarRoles($_POST["dato"]); 
    $_SESSION["exito"]="
        

    <script>    Swal.fire({
        icon: 'success',
        title: 'Rol modificado con éxito',
        showConfirmButton: false,
        timer: 1500
      });</script>";  

    if($resultado){
        $result=$this->crud->borrarUnoaUnoRoles($_GET["id"]);

        unset($_SESSION["modificar"]);
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
        
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
    }
    

}
}


function crearRoles(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
    }
    else if($_POST['dato'][0]==null || $_POST['dato'][1]==null || $_POST['dato'][2]==null || $_POST['dato'][3]==null || $_POST['dato'][4]==null ||$_POST['dato'][5]==null||$_POST['dato'][6]==null||$_POST['dato'][7]==null ){
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Debe rellenar todos los campos',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        header("location:?c=crudRoles&page=".$_GET["pag"]."&crear=1");
    }
    else{
    
    $resultado=$this->crud->crearRoles($_POST["dato"]);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Rol creado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";  
        unset($_SESSION["modificar"]);
        header("location:?c=crudRoles&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> Ya existe un rol con ese nombre</div>";
        
        header("location:?c=crudRoles&page=".$_GET["pag"]."&crear=1");
    }
    

}
}

/******************************   FINAL CONTROLADOR ROLES         ********************************/





/******************************   CONTROLADOR USUARIOS               ********************************/
function borrarUsuarios(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarUsuarios($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Usuario eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
            $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudUsuarios&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ningún usuario para eliminar</div>";
            header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoUsuarios($_GET["id"]);
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Usuario eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudUsuarios&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarUsuarios(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y Usuarioe</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarUsuarios($_POST["dato"]); 
    $_SESSION["exito"]="
        

    <script>    Swal.fire({
        icon: 'success',
        title: 'Usuario modificado con éxito',
        showConfirmButton: false,
        timer: 1500
      });</script>";  

    if($resultado){
        $result=$this->crud->borrarUnoaUnoUsuarios($_GET["id"]);

        unset($_SESSION["modificar"]);
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
        
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
    }
    

}
}


function crearUsuarios(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
    }
    else if($_POST['dato'][0]==null || $_POST['dato'][1]==null || $_POST['dato'][2]==null || $_POST['dato'][3]==null || $_POST['dato'][4]==null || $_POST['dato'][5]==null ){
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Debe rellenar todos los campos',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."&crear=1");
    }
    else{
    
    $resultado=$this->crud->crearUsuarios($_POST["dato"]);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Usuario creado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";  
        unset($_SESSION["modificar"]);
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> Ya existe un usuario con ese nombre</div>";
        
        header("location:?c=crudUsuarios&page=".$_GET["pag"]."&crear=1");
    }
    

}
}

/******************************   FINAL CONTROLADOR USUARIOS         ********************************/






/******************************   CONTROLADOR GRUPOS            ********************************/
function borrarGrupos(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarGrupos($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Grupo eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
            $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudGrupos&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudGrupos&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ningún grupo para eliminar</div>";
            header("location:?c=crudGrupos&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoGrupos($_GET["id"]);
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Grupo eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudGrupos&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarGrupos(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y Usuarioe</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarGrupos($_POST["dato"]); 
    $_SESSION["exito"]="
        

    <script>    Swal.fire({
        icon: 'success',
        title: 'Grupo modificado con éxito',
        showConfirmButton: false,
        timer: 1500
      });</script>";  

    if($resultado){
        $result=$this->crud->borrarUnoaUnoGrupos($_GET["id"]);

        unset($_SESSION["modificar"]);
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
        
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
    }
    

}
}


function crearGrupos(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);

        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
    }
    else if($_POST['dato'][0]==null || $_POST['dato'][1]==null || $_POST['dato'][2]==null){
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Debe rellenar todos los campos',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        header("location:?c=crudGrupos&page=".$_GET["pag"]."&crear=1");
    }
    else{
    
    $resultado=$this->crud->crearGrupos($_POST["dato"]);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Grupo creado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";  
        unset($_SESSION["modificar"]);
        header("location:?c=crudGrupos&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> Ya existe un grupo con ese nombre</div>";
        
        header("location:?c=crudGrupos&page=".$_GET["pag"]."&crear=1");
    }
    

}
}

/******************************   FINAL CONTROLADOR GRUPOS         ********************************/





/******************************   CONTROLADOR FESTIVOS            ********************************/
function borrarFestivos(){

        
    if(isset($_POST["borrar"])){
        $result=$this->crud->borrarFestivos($_POST["eliminar"]);
        if($result){
            $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Festivo eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
            $cuantos=count($_POST["eliminar"]);
            if($_SESSION['cuantas']==$cuantos){
                header("location:?c=crudFestivos&page=".$_GET["pag"]-1 ."");
            }
            else{
            header("location:?c=crudFestivos&page=".$_GET["pag"]."");
            }
        }else{
            $_SESSION["error2"]="<div class='alert  '>No se ha seleccionado ningún festivo para eliminar</div>";
            header("location:?c=crudFestivos&page=".$_GET["pag"]."");
        }
    
    }
    elseif(isset($_POST["modificar"])){
        $_SESSION["modificar"]=$_POST["modificar"];
        header("location:?c=crudFestivos&page=".$_GET["pag"]."");

    }else{
        $result=$this->crud->borrarUnoaUnoFestivos($_GET["id"]);
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Festivo eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";
        if($_SESSION['cuantas']==1){
            header("location:?c=crudFestivos&page=".$_GET["pag"] - 1 ."");
        }
        else{
        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
        }
        

    }
  
}

function modificarFestivos(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y Usuarioe</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);

        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
    }
    else{
    
    $resultado=$this->crud->actualizarFestivos($_POST["dato"]); 
    $_SESSION["exito"]="
        

    <script>    Swal.fire({
        icon: 'success',
        title: 'Festivo modificado con éxito',
        showConfirmButton: false,
        timer: 1500
      });</script>";  

    if($resultado){
        $result=$this->crud->borrarUnoaUnoFestivos($_GET["id"]);

        unset($_SESSION["modificar"]);
        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="<div class='alert  ' id='alerta'> No se ha cambiado ningún campo</div>";
        
        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
    }
    

}
}


function crearFestivos(){
    //echo "<div class='alert  '>Ya existe una reserva con este día, hora y aula</div>";
    if(isset($_POST['cancelar'])){
        unset($_SESSION["modificar"]);

        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
    }
    else if($_POST['dato'][0]==null || $_POST['dato'][1]==null || $_POST['dato'][2]==null){
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Debe rellenar todos los campos',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        header("location:?c=crudFestivos&page=".$_GET["pag"]."&crear=1");
    }
    else{
    
    $resultado=$this->crud->crearFestivos($_POST["dato"]);


    if($resultado){
        $_SESSION["exito"]="
        

        <script>    Swal.fire({
            icon: 'success',
            title: 'Festivo creado con éxito',
            showConfirmButton: false,
            timer: 1500
          });</script>";  
        unset($_SESSION["modificar"]);
        header("location:?c=crudFestivos&page=".$_GET["pag"]."");
    }
    else{
        
        $_SESSION["vacio"]="  <script>    Swal.fire({
            icon: 'warning',
            title: 'Ya existe un festivo con ese nombre',
            showConfirmButton: false,
            timer: 1500
          });</script>
    ";
        
        header("location:?c=crudFestivos&page=".$_GET["pag"]."&crear=1");
    }
    

}
}

/******************************   FINAL CONTROLADOR FESTIVOS         ********************************/












}








?>