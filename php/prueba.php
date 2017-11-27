<?php
	include 'funcions.php';
	$pdo = connectar();

	mostrarTodasConsultas($pdo,1);
?>