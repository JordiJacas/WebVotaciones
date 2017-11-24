<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleConsulta.css">
	<script type="text/javascript" src="../js/script.js"></script>
	<meta charset="utf-8">
	<title>Consulta</title>
</head>
<body onload="onload()">
<?php
	session_start();
	
	//print_r($_SESSION['row']);
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

	<div class = "buttons">
		<button id="crearC" onclick="crearConsulta()">Crear Consulta</button>
		<button id="crearO" onclick="crearOpcion()">Crear Opciones</button>
		<button id="enviarC" onclick="eSubmit()">Enviar Consulta</button>

	</div>
</body>
</html>
