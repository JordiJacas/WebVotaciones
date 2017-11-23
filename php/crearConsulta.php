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
	
	$row = $_SESSION['row'];
?>
	<nav>
		<ul>
			<li><a href="menuPrincipal.php" >Inicio</a></li>
			<li><a>Perfil</a></li>
			<li><a>Mis Consultas</a></li>
			<li><a href="crearConsulta.php" >Crear Consultas</a></li>
		</ul>
		<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a id = "lLogout" href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>

	<form id="myform" action="enviarConsulta.php" method="post" onsubmit="return enviar();">
		<label>Escribe la consulta:</label><br>
		<input type="textArea" name="consulta" id="consulta"><br>
		<input type="submit" name="crearConsulta" id="crearConsulta" value=" "style="display:none;">
	<form>

	<div class = "buttons">
		<input type="button" name="crearOpciones" value="Crear Opciones" onclick="crearOpcion()">
		<input type="submit" name="crearConsulta" value="Crear Consulta" onclick="eSubmit()">
	</diV>
</body>
</html>
