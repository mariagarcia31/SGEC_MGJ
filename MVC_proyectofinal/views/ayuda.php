<?php

if (isset($_COOKIE['contrasena']) || isset($_SESSION['contra']) && isset($_SESSION["cambiado"]) ){
        
}else{
    header('Location:?c=home');
    die() ;
}



?>
<html lang="en">
<head>
  
    <title>Ayuda-SGEC</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<link rel=StyleSheet href="../MVC_proyectofinal/libs/css/estilos.css" type="text/css" media=screen>
<style>

  </style>
</head>
<body>

  
  

<?php include "menu.php";
    ?>


<body>
    <div class="container">
        <h2>Preguntas más frecuentes</h2>

        <div class="tab">
        <button class="tablinks" onclick="openFaqs(event, 'reservar')" id="defaultOpen">Reservas</button>
        <button class="tablinks" onclick="openFaqs(event, 'misreservas')">Gestionar mis reservas</button>
        <button class="tablinks" onclick="openFaqs(event, 'configuracion')">Configuración</button>
        </div>

        <div id="reservar" class="tabcontent">
            <button class="accordion">¿Cómo realizar una reserva?</button>
            <div class="panel">
            <li>Para realizar una reserva, debes dirigirte a Menu > Reservar</li>
            <li>Elíge el aula que quieres reservar y se te mostrará un calendario mensual con los días disponibles
                para reservar (puedes cambiar a vista semanal)</li> 
            <li>Elíge el día y tramo horario y rellena el formulario de reserva. ¡Listo, has realizado una reserva!</li>
            </div>

            <button class="accordion">¿Cómo cambiar a la vista mensual/vista semanal?</button>
            <div class="panel">
            <p>Una vez has elegido el aula que quieres reservar se te mostrará la vista mensual por defecto pero debajo del mes encontrarás un botón para cambiar de vista.</p>
            </div>

            <button class="accordion">¿Cómo reservar en un plazo mayor de 14 días?</button>
            <div class="panel">
            <p>Esto no es posible, sólo se puede reservar en un plazo de 14 días.</p>
            </div>
        </div>

        <div id="misreservas" class="tabcontent">
            <button class="accordion">¿Como modificar una reserva?</button>
            <div class="panel">
            <p>Dirígete a menu>Mis reservas.<br>Se te mostrarán todas tus reservas y haciendo click en el botón verde de "modificar" podrás cambiar todos los datos de la reserva (fecha, aula, motivo...).</p>
            </div>

            <button class="accordion">¿Como eliminar una reserva?</button>
            <div class="panel">
            <p>Dirígete a menu>Mis reservas.<br>Se te mostrarán todas tus reservas y haciendo click en el botón rojo de "borrar" podrás eliminar la reserva).</p>
            </div>

            
        </div>

        <div id="configuracion" class="tabcontent">
            <button class="accordion">¿Cómo cambiar la contraseña?</button>
            <div class="panel">
            <p>Dirígete a "menu>Configuración" y se te mostrarán los datos de tu perfil, allí encontrarás un formulario con el cambio de contraseña, introduce la nueva contraseña y pulsa el botón "Confirmar".</p>
            </div>

            <button class="accordion">¿Cómo cambiar el nombre de usuario?</button>
            <div class="panel">
            <p>Este dato sólo lo puede modificar el administrador.</p>
            </div>

            <button class="accordion">¿Cómo cambiar el correo electrónico?</button>
            <div class="panel">
            <p>Este dato sólo lo puede modificar el administrador.</p>
            </div>
        </div>
    </div>

</body>
</html>





<script>


function openFaqs(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


document.getElementById("defaultOpen").click();


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>