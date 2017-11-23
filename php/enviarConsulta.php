<?php
	include "funcions.php";
	
	$pdo = connectar();
	
	$consulta = $_POST['consulta'];
	$array = $_POST['i'];
	$row = $_SESSION['row'];
	
	print_r($array);
	echo $consulta;
	echo $row['id_user']

	//preparem i executem la consulta
	//$query = $pdo->prepare("insert into Consultas (descripcion, id_admin) values ('".$consula."',".$_SESSION['id_user']."")");
	//$query->execute();
?>