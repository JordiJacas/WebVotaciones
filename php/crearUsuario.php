<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	

	// $query = $pdo->prepare("SELECT * FROM Usuarios WHERE token = ':token' AND email = ':email'");

	// $query->bindParam(':token', $_GET['token']);

	// $query->execute();
	// $comprovar = $query->fetch();


	// print_r($comprovar);

	//preparem i executem la consulta
	$query = $pdo->prepare("INSERT INTO `Usuarios`(`nombre`, `apellido`, `email`, `password`) VALUES (:nombre, :apellido, :email, sha1(:password));");

	$query->bindParam(':nombre', $_POST['nombre']);
	$query->bindParam(':apellido', $_POST['apellido']);
	$query->bindParam(':email', $_POST['email']);
	$query->bindParam(':password', $_POST['password']);

	$query->execute();
	$row = $query->fetch();
	
	if ($row){
		
		$_SESSION['row'] = $row;
		header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');
		
	}else{
		header('Location: http://localhost/WebVotaciones');
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query)
?>