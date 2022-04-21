<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    hr{
    margin:0px !important;
    color:white
}
body {
  font-family: "Lato", sans-serif;
}

/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #212529;
  overflow-x: hidden;
  padding-top: 20px;
  padding-top:115px;
}



/* On mouse-over */
.sidenav a:hover, .btn-menu:hover {
  color: white;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: #2FA4FF;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: gray;
  padding-left: 8px;
  color:white !important
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}















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
        margin:15px !important;
        color: rgba(255, 255, 255, 0.7) !important
    }
    .menu:hover{
        color: rgba(255, 255, 255, 0.5) !important
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
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
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
</head>
<body>

<div class="sidenav">
<a class="btn-menu" href="?c=principal&page=1"><i class="bi bi-calendar-plus"></i>  Reservar</a>
  <hr class='sidebar-divider'>

  <a class="btn-menu" href="?c=crudMisReservas&page=1"><i class="bi bi-calendar-week"></i>  Mis reservas</a>
  <hr class='sidebar-divider'>
  <a class=" btn-menu">Gestionar 
    <i class="fa fa-caret-down"></i>
  </a>
  <div class="dropdown-container">
  <a class="btn-menu" href="?c=crudReservas&page=1"><i class="bi bi-calendar3"></i>   Reservas</a>  <hr class="sidebar-divider">
  <a class="btn-menu" href="?c=crudAulas&page=1"><i class="bi bi-house"></i>   Aulas</a>  <hr class="sidebar-divider">
  <a class="btn-menu" href="?c=crudUsuarios&page=1"><i class="bi bi-person"></i>   Usuarios</a>  <hr class="sidebar-divider">
  <a class="btn-menu" href="?c=crudRoles&page=1"><i class="bi bi-person-lines-fill"></i>   Roles</a>  <hr class="sidebar-divider">
  <a class="btn-menu" href="?c=crudGrupos&page=1"><i class="bi bi-people"></i>  Grupos</a>  <hr class="sidebar-divider">
  </div>
  <hr class='sidebar-divider'>

  <a class="btn-menu" href="?c=actualizarBbdd&page=1"><i class="bi bi-arrow-bar-up"></i>  Actualizar Base de Datos</a>  <hr class="sidebar-divider">

  <a class="btn-menu" href="?c=ayuda&page=1"><i class="bi bi-info-circle"></i>  Ayuda</a>
</div>

<div class="nav">
<!-- Use any element to open the sidenav -->
<span onclick="openNav()" class="menu">
<span class="glyphicon glyphicon-align-justify"></span>
</span>
<div class="cabecera-todo">
    <a class="logoEnlace" href="https://www.educa2.madrid.org/web/centro.ies.ciudadescolar.madrid" target="_blank"><img class="logo" src="libs/img/logo_ciudadescolar.jpg"></a>
    <h1 class="cabecera">Sistema de Gestión de Espacios Comunes</h1>
</div>
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="color: rgba(255, 255, 255, 0.7);" class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
            <img class="img-profile rounded-circle" style="width:50px"
                src="libs/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="?c=logout" data-toggle="" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Cerrar sesión
            </a>
        </div>
    </li>
</div>
   <div class="footer">
       <p>Copyright 2022 |Sistema de Gestión de Espacios Comunes | Gerardo, María y Jossue</p>
</div>  
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("btn-menu");
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

</body>
</html> 
