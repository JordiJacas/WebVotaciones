<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleConsulta.css">	
	<script type="text/javascript" src="../js/script.js"></script>

	<meta charset="utf-8">
	<title>Consulta</title>
</head>
<body onload="onload()" id="snow">
<?php
	session_start();
	
	//print_r($_SESSION['row']);
	$row = $_SESSION['row'];
?>
	<nav>
		<img src="../img/logo.png" id="logo">
		<ul>
			<li><a href="menuPrincipal.php" >Inicio</a></li>
			<li><a>Perfil</a></li>
			<!--<li><a>Mis Consultas</a></li>-->
			<li><a href="crearConsulta.php" >Crear Consultas</a></li>
		</ul>
		<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a id = "lLogout" href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>	
	
	<div class="buttons">
		<button id="crearC" class="oButtons" onclick="crearConsulta()">Crear Consulta</button>
		<button id="crearO" class="oButtons" onclick="validarConsulta()">Crear Opciones</button>
		<button id="enviarC" class="oButtons" onclick="eSubmit()">Enviar Consulta</button>
	</div>
</body>
</html>
