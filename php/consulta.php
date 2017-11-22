<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleConsulta.css">
	<script type="text/javascript" src="../js/script.js"></script>
	<meta charset="utf-8">
	<title>Consulta</title>
</head>
<body>
<?php
	session_start();
	
	//print_r($_SESSION['row']);
	//$row = $_SESSION['row'];
?>
	<nav>
		<ul>
			<li>Inicio</li>
			<li>Perfil</li>
			<li>Mis Consultas</li>
			<li>Crear Consultas</li>
		</ul>
		<p><?php //echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>

	<form action = "insertarConsulta.php" method = "post">
		<label>Escribe la consulta:</label><br>
		<input type="textArea" name="consulta" id="consulta"><br>
		<input type="submit" name="crearConsulta" style="display:none;">
	<form>

	<div class = "buttons">
		<input type="button" name="crearOpciones" value="Crear Opciones" onclick="crearOpcion()">
		<input type="submit" name="crearConsulta" value="Crear Consulta" onclick="eSubmit()">
	</diV>
</body>
</html>