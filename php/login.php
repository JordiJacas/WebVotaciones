<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	
	//$nombre = $_POST['nombre'];
	//$contraseña = $_POST['password'];

	
	//preparem i executem la consulta
	$query = $pdo->prepare("SELECT * FROM Usuarios WHERE nombre = :nombre and password = SHA1(:password)");

	$query->bindParam(':nombre', $_POST['nombre']);
	$query->bindParam(':password', $_POST['password']);
	
	$query->execute();
	$row = $query->fetch();
	
	//if ($row['password'] == $contraseña and $row['nombre'] == $nombre){
	if ($row){
		
		$_SESSION['row'] = $row;
		header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');
		
	}else{
		header('Location: http://localhost/WebVotaciones/');
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query)

?>