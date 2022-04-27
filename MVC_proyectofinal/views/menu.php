
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
    <link rel="stylesheet" href="libs/css/estilos.css">

<style>
            body{
            overflow-x: hidden;
        }
    .nav{
        display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
    /* margin: 15px; */
    background-color: #212529;
    padding: 20px;
    color: rgba(255, 255, 255, 0.5);
    }

    .cabecera, .cabecera-todo{
        color: rgba(255, 255, 255, 0.7);
    }

    .logoEnlace{
        margin-right: 5rem;
    }


    li.nav-item{
        float: right;
    right: 0px;
    top: 0px;
    position: absolute !important;
    margin: 15px;
}
    
    .menu {
        position: absolute;
    top: 30px;
    left: 20px;
        margin:0px 15px !important;
        color: rgba(255, 255, 255, 0.7) !important
    }
    .menu:hover{
        color: rgba(255, 255, 255, 0.5) !important
    }
   /* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #212529; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}
.closebtn{
    color:#375458;

}
.closebtn:hover{
    color:#1A3C40;
    background:none;
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 42px !important;
    margin-left: 50px;
}
/* The navigation menu links */
.sidenav a {
padding: 20px 8px 20px 32px;
  text-decoration: none !important;
  font-size: 18px;
  color: rgba(255, 255, 255, 0.7);
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.btn-menu:hover {
    color: rgba(255, 255, 255, 0.5);
  font-size: 20px;

}
hr{
    margin:0px !important
}
/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 20px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}
.footer{
    background-color: #212529; /* Black*/
    position:fixed;
    bottom:0px;
    left:0px;
    right:0px;
    padding:7px;
    text-align:center;
    z-index:4;
    color:white
}
@media screen and (max-width: 890px) {
  .nav{
      padding:50px
  }
  .cabecera-todo{
      display:none
  }
} 
.cabecera{
  font-size: 1.75rem !important; 
}
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
} 
.glyphicon {
    position: relative;
    top: 0px !important;
    margin-left: 15px;
    font-size: 25px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.menu:hover{
    cursor:pointer
}
a:visited{
    text-decoration:none
}

hr{
    margin:0px !important;
    color:white
}
body {
  font-family: "Lato", sans-serif;
}



/* Style the sidenav links and the dropdown button */
 .dropdown-btn {
  padding: 15px 8px 15px 16px;
  text-decoration: none;
  font-size: 20px;
  color: whitesmoke;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: white;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}



/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #545454;
  padding-left: 8px;
  color:white !important
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div id="mySidenav" class="sidenav" style="z-index:8">
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
  <a class="btn-menu" href="?c=crudGrupos&page=1"><i class="bi bi-people"></i>  Grupos</a>  


  ';
}else{echo"";}
echo " </div>  <hr class='sidebar-divider'>";

if($_SESSION['actualizarBBDD']==1){
echo '  <a class="btn-menu" href="?c=actualizarBbdd&page=1"><i class="bi bi-arrow-bar-up"></i>  Actualizar</a>  <hr class="sidebar-divider">
';
}else{echo"";}
  }

  

echo '  <a class="btn-menu" href="?c=ayuda&page=1"><i class="bi bi-info-circle"></i>  Ayuda</a>
<hr class="sidebar-divider">
<a class="btn-menu" href="?c=ayuda&page=1"><i class="bi bi-gear"></i>  Configuración</a>
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
    height: 85px;" src="libs/img/logo_ciudadescolar.png"></a>
    <h3 class="cabecera">Sistema de Gestión de Espacios Comunes</h3>
</div>
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <h5 style="color: rgba(255, 255, 255, 0.7); display:inline-block" ><?php echo $_SESSION['nombre'];?></h5>
            <img class="img-profile rounded-circle" style="width:40px"
                src="libs/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"  data-toggle="modal" data-target="#logoutModal" style="cursor:pointer">
            
                Cerrar sesión   
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </li>
</div>
   <div class="footer">
       <p>© Copyright 2022 | Sistema de Gestión de Espacios Comunes | IES Ciudad Escolar</p>
</div>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">¿Seguro que desea cerrar sesión?</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "cerrar sesión" abajo si está seguro de cerrar la sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="?c=logout" >Cerrar sesión</a>
                </div>
            </div>
        </div>
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
</script>

