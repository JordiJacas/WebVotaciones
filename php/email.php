<?php
	$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";
	$titulo = 'Mi titulo';
	$email = 'jjacasventura@iesesteveterradas.cat';
	mail($email, $titulo, $mensaje);

?>