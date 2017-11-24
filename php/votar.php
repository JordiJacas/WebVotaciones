<?php
	session_start();
	include "funcions.php";

	$respuesta = $_POST['respuesta'];
	$contador = 0;
	
	$pdo = connectar();
	
	$row = $_SESSION['row'];


	$query = $pdo->prepare("select * from Votos WHERE id_opcion = ".$respuesta."");
	$query->execute();
	$votos = $query->fetch();
	
	//preparem i executem la consulta
	$query = $pdo->prepare("insert into Votos (id_opcion, id_user) values (".$respuesta.",".$row['id_user'].")");
	$query->execute();


	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);

	header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');

?>