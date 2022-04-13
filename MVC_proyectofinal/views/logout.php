<?php 
if(isset($_SESSION['nombre'])){

    session_unset();
    session_destroy();
    header("Location:?c=home");
}
else{
    header("Location:?c=home");
}


?>