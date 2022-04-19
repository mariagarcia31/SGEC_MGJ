
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
    background: #C6CECF;
    padding: 20px;
    color: white;
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
        margin:15px !important;
        color:#375458 !important
    }
    .menu:hover{
        color:#1A3C40 !important
    }
   /* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #C6CECF; /* Black*/
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
  color: #375458;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.btn-menu:hover {
  color:#1A3C40;
  font-size: 20px;

}
hr{
    margin:0px !important
}
/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}
.footer{
    background:#C6CECF;
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
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a class="btn-menu" href="?c=principal&page=1"><i class="bi bi-calendar-plus"></i>  Reservar</a>
  <hr class='sidebar-divider'>

  <a class="btn-menu" href="?c=crudMisReservas&page=1"><i class="bi bi-calendar-week"></i>  Mis reservas</a>
  <hr class='sidebar-divider'>

  <?php     
  
  if($_SESSION['crudReservas']==1){
      echo '  <a class="btn-menu" href="?c=crudReservas&page=1"><i class="bi bi-calendar3"></i>  Gestionar Reservas</a>  <hr class="sidebar-divider">
      ';
  }else{echo"";}

  if($_SESSION['crudAulas']==1){
    echo '  <a class="btn-menu" href="?c=crudAulas&page=1"><i class="bi bi-house"></i>  Gestionar Aulas</a>  <hr class="sidebar-divider">

    ';
}else{echo"";}


if($_SESSION['crudUsuarios']==1){
    echo '  <a class="btn-menu" href="?c=crudUsuarios&page=1"><i class="bi bi-person"></i>  Gestionar Usuarios</a>  <hr class="sidebar-divider">
    ';
}else{echo"";}


if($_SESSION['crudRoles']==1){
    echo '  <a class="btn-menu" href="?c=crudRoles&page=1"><i class="bi bi-person-lines-fill"></i>  Gestionar Roles</a>  <hr class="sidebar-divider">

    ';
}else{echo"";}

if($_SESSION['crudGrupos']==1){
    echo '  <a class="btn-menu" href="?c=crudGrupos&page=1"><i class="bi bi-people"></i> Gestionar Grupos</a>  <hr class="sidebar-divider">


    ';
}else{echo"";}

if($_SESSION['actualizarBBDD']==1){
    echo '  <a class="btn-menu" href="?c=actualizarBbdd&page=1"><i class="bi bi-arrow-bar-up"></i>  Actualizar Base de Datos</a>  <hr class="sidebar-divider">
    ';
}else{echo"";}

?>


  <a class="btn-menu" href="?c=ayuda&page=1"><i class="bi bi-info-circle"></i>  Ayuda</a>

</div>

<div class="nav">
<!-- Use any element to open the sidenav -->
<span onclick="openNav()" class="menu">
<span class="glyphicon glyphicon-align-justify"></span>
</span>
<div class="cabecera-todo"><h1 class="cabecera">Sistema de Gestión de Espacios Comunes</h1><img class="logo" src="libs/img/logo_ciudadescolar.jpg">
</div>
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="color:#1A3C40" class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="?c=logout" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Cerrar sesión
            </a>
        </div>
    </li>
</div>
   <div class="footer">
       <p>Copyright 2022 |Sistema de Gestión de Espacios Comunes | Gerardo, María y Jossue</p>
</div>         
</body>

</html>
<script>
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
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
</script>