<?php

include_once("controller/controller.php");


$control=new Control();

if(!isset($_REQUEST['c'])){

    $control->home();
    
}else{

    $action=$_REQUEST['c'];
    call_user_func(array($control,$action));

}

?>