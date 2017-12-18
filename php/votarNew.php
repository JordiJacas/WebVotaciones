<?php
	session_start();
	include "funcions.php";

	$respuesta = $_POST['respuesta'];
	$id_voto = $_POST['voto'];
	$contador = 0;
	$hash = crearHash();
	echo "Respuesta: ".$respuesta."<br>Id_voto: ".$id_voto."<br>Hash: ".$hash."<br>";

	$pdo = connectar();
	
	$row = $_SESSION['row'];
	$query = $pdo->prepare("select * from VotosUsuario WHERE id_voto = ".$id_voto." and id_user = ".$row['id_user']."");
	$query->execute();
	$votos = $query->fetch();
	print_r($query);

	if($votos == null){
		//preparem i executem la consulta
		$query = $pdo->prepare("Insert into VotosUsuario (id_user, hash_enc) values (".$row['id_user'].",
			AES_ENCRYPT('".$hash."','".$row['password']."'))");
		$query->execute();
		print_r($query);

		$query2 = $pdo->prepare("insert into VotosOpcion (id_opcion, hash) values (".$respuesta.",'".$hash."')");
		$query2->execute();
		print_r($query2);
		
	}else {
		$query = $pdo->prepare("update VotosOpcion set id_opcion=".$respuesta." WHERE hash = (SELECT AES_DECRYPT(hash_enc,'".$row['password']."') FROM VotosUsuario WHERE id_voto = ".$id_voto.")");
		$query->execute();
		print_r($query);
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query);
	header('Location: http://jjacas.tk/~app/WebVotaciones/php/menuPrincipal.php');
?>