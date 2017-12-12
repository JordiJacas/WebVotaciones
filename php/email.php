<?php
	$titulo = 'Invitacion a consulta';
	$email = $_POST['email'];//'jjacasventura@iesesteveterradas.cat';

	$email = explode("\n", $email);

	for($num = 0; $num <count($email); $num++){
		$token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

		//preparem i executem la consulta
		$query = $pdo->prepare("insert into Usuarios (email,isAdmin,token) values ('".$email[$num]."',0,'".$token."')");
		$query->execute();

		$query = $pdo->prepare("Select id_user from Usuarios Where token = '".$token."' AND email = '".$email[$num]."')");
		$query->execute();
		$usuario = $query->fetch();

		$query = $pdo->prepare("insert into Invitaciones (id_consulta, id_user) values ("..",".$usuario['id_user'].")");
		$query->execute();
		
		$usuario = $query->fetch();
		
		$mensaje = "http://localhost/WebVotaciones/?token=".$token;
		//mail($email[num], $titulo, $mensaje);
	}
?>