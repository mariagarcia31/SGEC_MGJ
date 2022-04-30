

   <!-- Including our scripting file. -->

   <script type="text/javascript">
      //Getting value from "ajax.php".
      


 $(document).ready(function() {
 
 //On pressing a key on "Search box" in "search.php" file. This function will be called.

 $("#search").keyup(function() {

     //Assigning search box value to javascript variable named as "name".

     var name = $('#search').val();

     //Validating, if "name" is empty.

     if (name == "") {

         //Assigning empty value to "display" div in "search.php" file.

         $("#displaySearch").html("");

     }

     //If name is not empty.

     else {

         //AJAX is called.

         $.ajax({

             //AJAX type is "Post".

             type: "POST",

             //Data will be sent to "ajax.php".

             url: "views/barraBusqueda/ajax.php",

             //Data, that will be sent to "ajax.php".

             data: {

                 //Assigning value of "name" into "search" variable.

                 search: name

             },

             //If result found, this funtion will be called.

             success: function(html) {

                 //Assigning result to "display" div in "search.php" file.

                 $("#displaySearch").html(html).show();

             }

         });

     }

 });

});
   </script>



<!-- Search box. -->
<div class="col-12" style="margin-left:15px">
<div class="rounded border p-3" style="width: 30%;">
<i class="bi bi-search" style="font-size: 20px;padding-right: 10px;margin-left:3%;"></i>
<input type="text" id="search" placeholder="Buscar por nombre..."  style="width: 80%; font-size:18px; border:none;"/>
</div>
   <!-- Suggestions will be displayed in below div. -->

   <div id="displaySearch" style="width: 18%;position:fixed;z-index:90;margin-left:30px"></div>
</div>


