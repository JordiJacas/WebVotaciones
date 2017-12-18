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
	
	$row = $_SESSION['row'];
?>
<nav>
		<img src="../img/logo.png" id="logo">
		<ul>
			<li><a href="menuPrincipal.php" >Inicio</a></li>
			<?php
				if($row['isAdmin']==1){
					echo "<li><a href='crearConsulta.php' >Crear Consultas</a></li>";
					echo "<li><a href='InvitarConsulta.php' >Invitar</a></li>";
				}
			?>
		</ul>
		<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a id = "lLogout" href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>	
	
	<div class="buttons">
		<button id="crearC" class="oButtons" onclick="crearConsulta()">Crear Consulta</button>
		<button id="crearO" class="oButtons" onclick="validarConsulta()">Crear Opciones</button>
		<button id="enviarC" class="oButtons" onclick="eSubmit()">Enviar Consulta</button>
		<button id="borrarO" class="oButtons" onclick="borrarTodasOpciones()">Borrar Opciones</button>
	</div>
</body>
</html>
