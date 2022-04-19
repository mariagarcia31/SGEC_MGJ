<html>
    <head>
        


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<style>
.container-fluid{
    display:none
}
#wrapper{
    top: 0px;
position: absolute;
left: 0px;
right: 0px;
bottom: 0px;
}
.menu{
                top: 0px;
    position: absolute;
    left:0px;
    bottom:0px
            }
            .navbar{
                top: 0px !important;
                position: absolute !important;
                right: 0px !important;
                left: 0px !important;
            }
            .contenedor{
                margin-top:150px !important;
                margin-left:264px !important
            }
            .menu>ul{
                bottom: 0px;
    position: absolute;
    top:0px
            }
            #sidebarToggleTop{
                left:100px ;
                position:absolute
            }
</style>
<title>sgec</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>

<body>

<?php
echo "
    <div class='menu' style='z-index:3'>


        <ul class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>

            <a class='sidebar-brand d-flex align-items-center justify-content-center' href='index.php'>
                <div class='sidebar-brand-icon rotate-n-15'>
                    <i class='fas fa-laugh-wink'></i>
                </div>
                <div class='sidebar-brand-text mx-3'>sgec</div>
            </a>

            <!-- Divider -->
            <hr class='sidebar-divider my-0'>

            <!-- Nav Item - Dashboard -->
            <li class='nav-item active'>
                <a class='nav-link' href='index.php'>
                    <i class='far fa-calendar-alt'></i>
                    <span>Reservar</span></a>
            </li>
            <!-- Divider -->
            <hr class='sidebar-divider'>

            <li class='nav-item active'>
                <a class='nav-link' href='crudMisReservas.php'>
                    <i class='far fa-eye'></i>
                    <span>Mis Reservas</span></a>
            </li>";
     if($_SESSION['crudReservas']==1){
         echo "
            <hr class='sidebar-divider'>

            <li class='nav-item active'>
                <a class='nav-link' href='crudReservas.php'>
                    <i class='far fa-folder-open'></i>
                    <span>Gestionar Reservas</span></a>
            </li>";
         } else{};

    if($_SESSION['crudAulas']==1){
            
         echo "
            <hr class='sidebar-divider'>

            <li class='nav-item active'>
                <a class='nav-link' href='crudAulas.php'>
                    <i class='bi-house-door-fill'></i>
                    <span>Gestionar Aulas</span></a>
            </li>";
     } else{} 

     if($_SESSION['crudUsuarios']==1){
         echo "
           
            <hr class='sidebar-divider'>

            <li class='nav-item active'>
                <a class='nav-link' href='crudAulas.php'>
                    <i class='bi-person-fill'></i>
                    <span>Gestionar Usuarios</span></a>
            </li>";
    } else{} 



if($_SESSION['crudUsuarios']==1){
    echo "
      
       <hr class='sidebar-divider'>

       <li class='nav-item active'>
           <a class='nav-link' href='crudAulas.php'>
               <i class='bi-toggles'></i>
               <span>Gestionar Roles</span></a>
       </li>";
} else{} 



if($_SESSION['crudUsuarios']==1){
    echo "
      
       <hr class='sidebar-divider'>

       <li class='nav-item active'>
           <a class='nav-link' href='crudAulas.php'>
               <i class='bi-people-fill'></i>
               <span>Gestionar Grupos</span></a>
       </li>";
} else{} 


if($_SESSION['crudUsuarios']==1){
    echo "
      
       <hr class='sidebar-divider'>

       <li class='nav-item active'>
           <a class='nav-link' href='crudAulas.php'>
               <i class='bi-upload'></i>
               <span>Actualizar Base de Datos</span></a>
       </li>";
} else{} 


echo "   
<hr class='sidebar-divider'>

<li class='nav-item active'>
    <a class='nav-link' href='crudAulas.php'>
        <i class='fas fa-hands-helping'></i>
        <span>Ayuda</span></a>
</li>




</ul>
</div>


";

?>



<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button onclick="redimensionar()" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>    <!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Cerrar sesión
            </a>
        </div>
    </li>

</ul>

</nav>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>