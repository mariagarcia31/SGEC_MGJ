<?php
session_start();

//Including Database configuration file.

//Database connection.

$con = MySQLi_connect(

   "127.0.0.1:33065", //Server host name.

   "root", //Database username.

   "", //Database password.

   "sgec" //Database name or anything you would like to call it.

);



//Check connection

if (MySQLi_connect_errno()) {

   echo "Failed to connect to MySQL: " . MySQLi_connect_error();

}
//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];
   $page = $_POST['page'];
  
//Search query.

   $Query = "SELECT * FROM aulas WHERE id LIKE '%$Name%' ORDER BY id LIMIT 10 ";

//Query execution

   $ExecQuery = MySQLi_query($con, $Query);

//Creating unordered list to display result.

   echo '
   <form style="font-size:14px" action="?c=borrarAulas&pag='.$page.'" method="post"> 
   <ul class="list-group">

   ';

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

   
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
   <li class="list-group-item busqueda" style="font-size: 15px;"  >
       <?php echo $Result['id']; ?>
       <a class="btn btn-danger float-right ml-2"  href="?c=borrarAulas&id=<?php echo $Result["id"] ?>&pag=<?php echo $page ?>"><i class="bi bi-trash"></i></a>
       <button  title="Modificar" class="btn btn-primary float-right" name="modificar" value="<?php echo $Result["id"] ?>"> <i class="bi bi-pencil-square"></i></button>

       </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul> 