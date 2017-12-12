<?php
	session_start();
	include "funcions.php";
	$respuesta = $_POST['respuesta'];
	$id_voto = $_POST['voto'];
	$contador = 0;
	
	$pdo = connectar();
	
	$row = $_SESSION['row'];
	$query = $pdo->prepare("select * from Votos WHERE id_voto = ".$id_voto." and id_user = ".$row['id_user']."");
	$query->execute();
	$votos = $query->fetch();
	
	if($votos == null){
		//preparem i executem la consulta
		$query = $pdo->prepare("insert into Votos (id_opcion, id_user) values (".$respuesta.",".$row['id_user'].")");
		$query->execute();
	}else {
		$query = $pdo->prepare("update Votos set id_opcion=".$respuesta." WHERE id_voto = ".$votos['id_voto']." and id_user = ".$row['id_user']."");
		$query->execute();
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);
	header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');
?>