<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styleIndex.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
<?php
	include 'php/funcions.php';
	$pdo = connectar();
	mostraUsuarios($pdo);

	if(isset($_GET['token'])){
		$token = $_GET['token'];
		$url = "'php/paginaUsuario.php?token=".$token."'";

	}else if(!isset($_GET['token'])){
		$url = "'php/paginaUsuario.php'";	
	}
?>	
	<div>
		<h1>Iniciar Session</h1>
		<form action = "php/login.php" method = "post">
			<label>Nombre: </label> <br>
			<input type="text" name="nombre"/> <br> <br>
			<label>Contraseña: </label> <br>
			<input type="password" name="password"/> <br>
			<input class = "submit" type="submit" name="submitIniciar" value="Entrar"/>
		</form>
		<input id="registrarse" type="submit" value="Registrarse" onclick="location.href=
		<?php
			echo $url;
		?>
		"/>
		
	</div>

</body>
</html>