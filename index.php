<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styleIndex.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>

	
	<div id = "inicioSession">
		<h1>Iniciar Session</h1>
		<form action = " " method = "post">
			<label>Nombre: </label> <br>
			<input type="text" name="user"/> <br> <br>
			<label>Contraseña: </label> <br>
			<input type="password" name="password"/> <br>
			<input class = "submit" type="submit" name="submitIniciar" value="Enviar"/>
		</form>
	</div>
	<?php
		session_start();
		include 'php/funcions.php';

		if(!isset($_SESSION['usr']) || !isset($_SESSION['password'])){
			$_SESSION['usr'] = " ";
			$_SESSION['password'] = " ";
			
		}else{
			$_SESSION['usr'] = $_POST['user'];
			$_SESSION['password'] = $_POST['password'];
		}		
		
		$pdo = connectar();
		$row = login($pdo);

		if($row['nombre'] == $_SESSION['usr']){
			$_SESSION['row'] = $row;

			header('Location: http://localhost/WebVotaciones/php/menuPrincipal.php');
		}
	?>


</body>
</html>