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
	
	if($votos==null){
		//preparem i executem la consulta
		$query = $pdo->prepare("insert into Votos (id_opcion, contador) values (".$respuesta.",1)");
		$query->execute();
	}else{

		$contador = $votos['contador'];
		$contador++;
		$query = $pdo->prepare("update Votos set contador=".$contador." where id_opcion = ".$respuesta."");
		$query->execute();;
	}

	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);

	header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');

?>