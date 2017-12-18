<?php
	include "funcions.php";
	$pdo = connectar();
	$titulo = 'Invitacion a consulta';
	$email = $_POST['email'];
	$id_consulta = $_POST['idConsulta'];


	$email = explode("\n", $email);

	for($num = 0; $num <count($email); $num++){
		$token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

		$query = $pdo->prepare("SELECT count(id_user) FROM Usuarios WHERE email = '".$email[$num]."'");
		$query->execute();
		$numUser = $query->fetch();
		print_r($numUser);

		//preparem i executem la consulta
		if($numUser['count(id_user)'] == 0){
			$query = $pdo->prepare("INSERT into Usuarios (email,isAdmin,token) values ('".$email[$num]."',0,'".$token."')");
			$query->execute();
			echo "2";

		}else if ($numUser['count(id_user)'] == 1){
			$query = $pdo->prepare("UPDATE Usuarios set token = '".$token."' WHERE email = '".$email[$num]."'");
			$query->execute();
			echo "3";

		}


		$query = $pdo->prepare("SELECT * FROM Usuarios WHERE token = '".$token."' AND email = '".$email[$num]."'");
		$query->execute();
		$usuario = $query->fetch();
		echo "4";


		$query = $pdo->prepare("INSERT into Invitaciones (id_admin,id_consulta) values (".$usuario['id_user'].",".$id_consulta.")");
		$query->execute();
		$usuario = $query->fetch();
		echo "5";

		
		$mensaje = "http://jjacas.tk/~app/WebVotaciones/?token=".$token;
		mail($email[$num], $titulo, $mensaje);
	}

	//header('Location: http://jjacas.tk/~app/WebVotaciones/php/menuPrincipal.php');
?>