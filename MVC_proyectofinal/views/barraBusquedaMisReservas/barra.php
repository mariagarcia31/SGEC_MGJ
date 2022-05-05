<html lang="en" style="    overflow-x: hidden;">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>Principal</title>
    <link rel="stylesheet" href="libs/css/estilos.css">

<style>
    .card {

    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    transition: all 0.6s ease;
    
    user-select: none;
    overflow: hidden
}


.card:hover{

    cursor: pointer;
    transform: scale(1.035);
    box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 10px
    
}

.active, .accordion:hover {
    background-color: white; 
}

.busqueda:hover {
    background-color:#D8D8D8; 
}

#search:focus{
    outline: none !important;
}
@media screen 
        and (min-device-width: 320px) 
        and (max-device-width: 812px) 
        and (-webkit-min-device-pixel-ratio: 1) { 
        
        .barra{
            width: 90% !important;
        }
        .resultadosBusqueda{
            width: 60% !important;
        }
    }

@media screen 
        and (min-device-width: 813px) 
        and (max-device-width: 1600px) 
        and (-webkit-min-device-pixel-ratio: 1) { 
        
        .barra{
            width: 30% !important;
        }

        .resultadosBusqueda{
            width: 45% !important;
        }
    }




    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


   <!-- Including our scripting file. -->

   <script type="text/javascript">
      //Getting value from "ajax.php".
      


 $(document).ready(function() {
 
 //On pressing a key on "Search box" in "search.php" file. This function will be called.
 var pagina = $('#page').val();
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

             url: "views/barraBusquedaMisReservas/ajax.php",

             //Data, that will be sent to "ajax.php".

             data: {

                 //Assigning value of "name" into "search" variable.

                 search: name,
                 page: pagina

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
<div class="rounded p-3 barra" style='border: 1px solid  #212529;'>
<i class="bi bi-search" style="font-size: 20px;padding-right: 10px;margin-left:3%;"></i>
<input type="text" id="search" placeholder="Buscar por nombre..."  style="width: 80%; font-size:18px; border:none"/>
<input type="hidden" id="page"  value="<?php echo $_GET['page']?>"/>
</div>
   <!-- Suggestions will be displayed in below div. -->

   <div id="displaySearch" class="resultadosBusqueda "style="position:fixed;z-index:90;margin-left:30px"></div>
</div>


