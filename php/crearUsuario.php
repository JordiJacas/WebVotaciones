<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	
	//$nombre = $_POST['nombre'];
	//$contraseña = $_POST['password'];

	//preparem i executem la consulta
	$query = $pdo->prepare("INSERT INTO `Usuarios`(`nombre`, `apellido`, `email`, `password`) VALUES (:nombre, :apellido, :email, :password);");

	$query->bindParam(':nombre', $_POST['nombre']);
	$query->bindParam(':apellido', $_POST['apellido']);
	$query->bindParam(':email', $_POST['email']);
	$query->bindParam(':password', $_POST['password']);

	$query->execute();
	$row = $query->fetch();
	
	//if ($row['password'] == $contraseña and $row['nombre'] == $nombre){
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