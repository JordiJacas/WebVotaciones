<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleIndex.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/styleInsert.css"> -->
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
<?php
	include 'funcions.php';
	$pdo = connectar();

	if(isset($_GET['token'])){
		$token = $_GET['token'];
		$url = "crearUsuario.php?token=".$token."";

	}else if(!isset($_GET['token'])){
		$url = "crearUsuario.php";	
	}
?>	
	<div>
		<h1>Registrarse</h1>
		<?php
			echo "<form action='".$url."'' method='post'>";
		?>
			<label>Nombre: </label> <br>
			<input type="text" name="nombre"/> <br> <br>
			<label>Apellido: </label> <br>
			<input type="text" name="apellido"/> <br> <br>
			<label>Email: </label> <br>
			<input type="text" name="email"/> <br> <br>
			<label>Password: </label> <br>
			<input type="password" name="password"/> <br> <br>
			<input class = "submit" type="submit" name="submitCrear" value="Enviar"/>			
		</form>		
	</div>

</body>
</html>