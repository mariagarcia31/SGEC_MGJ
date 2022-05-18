<?php



$arrayRecibido=json_decode($_POST["arrayDeValores"], true );
 
echo "Hemos recibido en el PHP un array de ".count($arrayRecibido)." elementos";
foreach($arrayRecibido as $valor)
{
	echo "\n- ".$valor;
}
?>