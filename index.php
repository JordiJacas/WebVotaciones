<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
	<div id = "inicioSession">
		<form action = " " method = "post">
			<label>Name: </label> <br>
			<input type="text" name="user"/> <br> <br>
			<label>Password: </label> <br>
			<input type="password" name="password"/> <br>
			<input class = "submit" type="submit" name="submitIniciar" value="Enviar"/>
		</form>
	</div>
	<?php
		session_start();
		include 'php/connectar.php';

		if(!isset($_SESSION['usr']) || !isset($_SESSION['password'])){
			$_SESSION['usr'] = null;
			$_SESSION['password'] = null;
			
		}else{
			$_SESSION['usr'] = $_POST['user'];
			$_SESSION['password'] = $_POST['password'];
		}		
		
		$pdo = connectar();
		$row = login($pdo);

		if($row['nombre'] == $_SESSION['usr']){
			$_SESSION['row'] = $row;
			// echo "<script>
					// document.getElementById('inicioSession').style.display = 'none';
					// document.getElementById('principal').style.display = 'inline';
				  // </script>";
			header('Location: http://localhost:8080/WebVotaciones/php/menuPrincipal.php');
		}
	?>


</body>
</html>