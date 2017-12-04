<?php
	$titulo = 'Invitacion a consulta';
	$email = $_POST['email'];//'jjacasventura@iesesteveterradas.cat';

	$email = explode("\n", $email);




	for($num = 0; $num <count($email); $num++){
		$token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

		//preparem i executem la consulta
		$query = $pdo->prepare("insert into Usuarios (nombre,apellido,email,password,isAdmin,token) values (null,null,'".$email[$num]."',null,null,'".$token."')");
		$query->execute();
		
		$mensaje = "http://localhost/WebVotaciones/?token=".$token;
		//mail($email[num], $titulo, $mensaje);
	}
?>