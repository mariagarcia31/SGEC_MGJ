
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MVC_proyectofinal/libs/css/estilos.css">

<style>
            body{
            overflow-x: hidden;
        }
 

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div id="mySidenav" class="sidenav" style="z-index:999">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a class="btn-menu btn-menu-reservar" href="?c=principal&page=1"><i class="bi bi-calendar-plus"></i>  Reservar</a>
  <hr class='sidebar-divider'>

  <a class="btn-menu" href="?c=crudMisReservas&page=1"><i class="bi bi-calendar-week"></i>  Mis reservas</a>
  <hr class='sidebar-divider'>
<?php
  if($_SESSION['crudReservas']==1 || $_SESSION['crudAulas']==1 || $_SESSION['crudUsuarios']==1 || $_SESSION['crudRoles']==1 || $_SESSION['crudGrupos']==1){
    echo '  <a style="color: rgba(255, 255, 255, 0.7); " class="dropdown-btn btn-menu"><i class="bi bi-clipboard-check"></i>  Gestionar 
    <i class="bi bi-caret-down-fill" style="    float: right;
    padding-right: 15px;"></i>
  </a>
  <div class="dropdown-container">';


  if($_SESSION['crudReservas']==1){
    echo '  
    <a class="btn-menu" href="?c=crudReservas&page=1"><i class="bi bi-calendar3"></i>   Reservas</a>  <hr class="sidebar-divider">
    ';
  }else{echo"";}

  if($_SESSION['crudAulas']==1){
    echo '  
    <a class="btn-menu" href="?c=crudAulas&page=1"><i class="bi bi-house"></i>   Aulas</a>  <hr class="sidebar-divider">

    ';
  }else{echo"";}


  if($_SESSION['crudUsuarios']==1){
    echo '  
    <a class="btn-menu" href="?c=crudUsuarios&page=1"><i class="bi bi-person"></i>   Usuarios</a>  <hr class="sidebar-divider">
    ';
  }else{echo"";}


  if($_SESSION['crudRoles']==1){
    echo '  
    <a class="btn-menu" href="?c=crudRoles&page=1"><i class="bi bi-person-lines-fill"></i>   Roles</a>  <hr class="sidebar-divider">

    ';
  }else{echo"";}

  if($_SESSION['crudGrupos']==1){
    echo '  
    <a class="btn-menu" href="?c=crudGrupos&page=1"><i class="bi bi-people"></i>  Grupos</a>  <hr class="sidebar-divider">


    ';
  }else{echo"";}
  if($_SESSION['crudFestivos']==1){
    echo '  
    <a class="btn-menu" href="?c=crudFestivos&page=1"><i class="bi bi-briefcase"></i>  Festivos</a>  


    ';
  }else{echo"";}
  echo " </div>  <hr class='sidebar-divider'>";

  if($_SESSION['actualizarBBDD']==1){

  echo '  <a class="btn-menu" href="?c=actualizarBbdd&page=1"><i class="bi bi-arrow-bar-up"></i>  Actualizar</a>  <hr class="sidebar-divider">';

  }else{echo"";}
  if($_SESSION['estadisticas']==1){

    echo '  <a class="btn-menu" href="?c=estadisticas&page=1"><i class="bi bi-bar-chart-line"></i>  Estadísticas</a>  <hr class="sidebar-divider">';
    
  }else{echo"";}
}


echo '  <a class="btn-menu" href="?c=ayuda&page=1"><i class="bi bi-info-circle"></i>  Ayuda</a>
<hr class="sidebar-divider">
<a class="btn-menu" href="?c=configuracion&page=1"><i class="bi bi-gear"></i>  Configuración</a>
</div>
';
?>



</div>

<div class="nav">
<!-- Use any element to open the sidenav -->
<span onclick="openNav()" class="menu">
<span class="glyphicon glyphicon-align-justify"></span>
</span>
<div class="cabecera-todo">
    <a class="logoEnlace" href="https://www.educa2.madrid.org/web/centro.ies.ciudadescolar.madrid" target="_blank"><img class="logo" style="    width: 175px;
    height: 75px;" src="libs/img/logo_ciudadescolar.png"></a>
    <h3 class="cabecera">Sistema de Gestión de Espacios Comunes</h3>
</div>
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <h5 style="color: rgba(255, 255, 255, 0.7); display:inline-block" ><?php echo $_SESSION['nombre'];?></h5>
            <img class="img-profile rounded-circle" style="width:40px"
                src="libs/img/undraw_profile.svg">
        </a>
  <div class="dropdown-content">
  <p class="btn-cerrar-sesion" style="color:black" onclick=cerrar()>Cerrar sesión</p>
  </div>

    </li>


    


</div>
   <div class="footer">
       <p>© Copyright 2022 | Sistema de Gestión de Espacios Comunes | IES Ciudad Escolar</p>
</div>
       
</body>

</html>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)!important";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.body.style.backgroundColor = "white";
}


var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

function cerrar(){
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: '¿Desea cerrar sesión?',
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Si, cerrar sesión',
  cancelButtonText: 'No, cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    
    window.location.href = "?c=logout";
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
   
  }
})
}
</script>

