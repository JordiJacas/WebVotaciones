<?php
	session_start();
	include "funcions.php";
	
	$pdo = connectar();
	
	$consulta = $_POST['consulta'];
	$fechaFinal = $_POST['fechaFinal'];
	$fechaInicial = $_POST['fechaInicial'];
	$array = $_POST['i'];
	$row = $_SESSION['row'];

	//preparem i executem la consulta
	$query = $pdo->prepare("insert into Consultas (descripcion, id_admin) values ('".$consulta."',".$row['id_user'].")");
	$query->execute();
	
	$query = $pdo->prepare("select id_consulta from Consultas where descripcion = '".$consulta."'");
	$query->execute();
	$dades = $query->fetch();
	
	foreach($array as $opcio){
		$query = $pdo->prepare("insert into Opciones (id_consulta, texto) values (".$dades['id_consulta'].",'".$opcio."')");
		$query->execute();
  	}

	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);

	header('Location: http://localhost/WebVotaciones/php/crearConsulta.php');
?>