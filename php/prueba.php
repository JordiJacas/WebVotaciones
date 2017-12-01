<?php
	include 'funcions.php';
	$pdo = connectar();

	mostrarConsultasUsuario($pdo,1);
?>