
<!DOCTYPE html>
<html lang="en">

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
</style>
    <title>sgec</title>

    <!-- Custom fonts for this template-->
    <link href="libs/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="libs/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="libs/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="position:absolute; top:0px;left:0px;bottom:0px">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="?c=principal">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">sgec</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="?c=principal">
        <i class="far fa-calendar-alt"></i>
        <span>Reservar</span></a>
</li>
<hr class='sidebar-divider'>

<li class="nav-item active">
    <a class="nav-link" href="?c=crudMisReservas&page=1">
        <i class="far fa-calendar-alt"></i>
        <span>Mis reservas</span></a>
</li>

<!-- Divider -->

<?php if($_SESSION['crudReservas']==1){
echo "
<hr class='sidebar-divider'>

<li class='nav-item active'>
    <a class='nav-link' href='?c=crudReservas&page=1'>
        <i class='far fa-folder-open'></i>
        <span>Gestionar Reservas</span></a>
</li>";
} else{ }; 



if($_SESSION['crudAulas']==1){

echo "
   <hr class='sidebar-divider'>

   <li class='nav-item active'>
       <a class='nav-link' href='?c=crudAulas&page=1'>
           <i class='far fa-folder-open'></i>
           <span>Gestionar Aulas</span></a>
   </li>";
} else{} 

if($_SESSION['crudUsuarios']==1){
echo "
  
   <hr class='sidebar-divider'>

   <li class='nav-item active'>
       <a class='nav-link' href='?c=crudUsuarios&page=1'>
           <i class='far fa-folder-open'></i>
           <span>Gestionar Usuarios</span></a>
   </li>";
} else{} 



if($_SESSION['crudRoles']==1){
echo "

<hr class='sidebar-divider'>

<li class='nav-item active'>
  <a class='nav-link' href='?c=crudRoles&page=1'>
      <i class='far fa-folder-open'></i>
      <span>Gestionar Roles</span></a>
</li>";
} else{} 



if($_SESSION['crudGrupos']==1){
echo "

<hr class='sidebar-divider'>

<li class='nav-item active'>
  <a class='nav-link' href='?c=crudGrupos&page=1'>
      <i class='far fa-folder-open'></i>
      <span>Gestionar Grupos</span></a>
</li>";
} else{} 


if($_SESSION['actualizarBBDD']==1){
echo "

<hr class='sidebar-divider'>

<li class='nav-item active'>
  <a class='nav-link' href='?c=crudBBDD&page=1'>
      <i class='far fa-folder-open'></i>
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

    







</ul>
             <?php //function cerrar(){?>
                   <!-- Begin Page Content -->
                                <div class="container-fluid">

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->


                <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que desea cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "cerrar sesión" abajo si estás seguro de cerrar la sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="?c=logout">Cerrar sesión</a>
                </div>
                </div>
                </div>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="libs/vendor/jquery/jquery.min.js"></script>
                <script src="libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="libs/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="libs/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="libs/vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="libs/js/demo/chart-area-demo.js"></script>
                <script src="libs/js/demo/chart-pie-demo.js"></script>
            <?php //} 
            //cerrar();?>
            
</body>

</html>