<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	
	$nombre = $_POST['nombre'];
	$contrase�a = $_POST['password'];
	
	//preparem i executem la consulta
	$query = $pdo->prepare("SELECT * FROM Usuarios WHERE nombre='".$nombre."';");
	$query->execute();
	$row = $query->fetch();
	
	if ($row['password'] == $contrase�a){
		
		$_SESSION['row'] = $row;
		header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');
		
	}else{
		header('Location: http://localhost/WebVotaciones');
	}
	
	//eliminem els objectes per alliberar mem�ria 
	unset($pdo); 
	unset($query)

?>