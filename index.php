<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
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

	<div id = "principal">
		<nav>
			<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
			<a href="longout.php">Cerrar Session</a>
		</nav>
	</div>
	<?php
		session_start();
		include 'connectar.php';

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
			print_r($row);
			echo "<script>
					document.getElementById('inicioSession').style.display = 'none';
					document.getElementById('principal').style.display = 'inline';
				  </script>";
		}
	?>


</body>
</html>