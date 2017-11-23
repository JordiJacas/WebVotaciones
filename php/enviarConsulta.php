<?php
	session_start();
	include "funcions.php";
	
	$pdo = connectar();
	
	$consulta = $_POST['consulta'];
	$array = $_POST['i'];
	$row = $_SESSION['row'];

	//preparem i executem la consulta
	$query = $pdo->prepare("insert into consultas (descripcion, id_admin) values ('".$consulta."',".$row['id_user'].")");
	$query->execute();
	
	$query = $pdo->prepare("select id_consulta from consultas where descripcion = '".$consulta."'");
	$query->execute();
	$dades = $query->fetch();
	
	foreach($array as $opcio){
		$query = $pdo->prepare("insert into opciones (id_consulta, texto) values (".$dades['id_consulta'].",'".$opcio."')");
		$query->execute();
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);
	

?>