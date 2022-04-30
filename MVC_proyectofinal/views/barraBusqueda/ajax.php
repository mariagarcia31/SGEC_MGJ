<?php

//Including Database configuration file.

//Database connection.

$con = MySQLi_connect(

   "localhost", //Server host name.

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

//Search query.

   $Query = "SELECT id FROM aulas WHERE id LIKE '%$Name%' AND habilitado = 1 LIMIT 6";

//Query execution

   $ExecQuery = MySQLi_query($con, $Query);

//Creating unordered list to display result.

   echo '

   <ul class="list-group">

   ';

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

   <a href="?c=calendario&id=<?php echo $Result['id']; ?>" style="font-size:18px;text-decoration:none;" class="busqueda">

   <!-- Assigning searched result in "Search box" in "search.php" file. -->
   <li class="list-group-item busqueda"  >
       <?php echo $Result['id']; ?>
       

       </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul> 