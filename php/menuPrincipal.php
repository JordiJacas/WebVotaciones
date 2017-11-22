<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleMenuPrincipal.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
<?php
	session_start();
	
	//print_r($_SESSION['row']);
	$row = $_SESSION['row'];
?>
	<nav>
		<ul>
			<li>Inicio</li>
			<li>Perfil</li>
			<li>Mis Consultas</li>
			<li>Crear Consultas</li>
		</ul>
		<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>
		
	<section>
	
		<div  class = "consulta">
			<a href="#">
			<p class = "descripcion">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia velit ut dictum sodales. 
			Sed facilisis egestas tellus, sit amet sagittis nibh lobortis mollis. Aenean ultrices arcu et tellus finibus mollis.</p>
			<p class = "nombre"> por Admin General</p>
			</a>
		</div>
		
	</section>	
</body>
</html>