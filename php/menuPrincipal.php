<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleMenuPrincipal.css">
	<script type="text/javascript" src="../js/script.js"></script>
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body id="snow">
<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	
	$row = $_SESSION['row'];
?>
	<nav>
		<img src="../img/logo.png" id="logo">
		<ul>
			<li><a href="menuPrincipal.php" >Inicio</a></li>
			<!-- <li><a>Crear Usuario</a></li>
			<li><a>Mis Consultas</a></li>-->
			<?php
				if($row['isAdmin']==1){
					echo "<li><a href='crearConsulta.php' >Crear Consultas</a></li>";
				}
			?>
		</ul>
		<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
		<a id = "lLogout" href = "logout.php"><img id = "logout"  src="../img/Logout.png"></a>
	</nav>
		
	<section>
		<?php
			mostrarTodasConsultas($pdo,$row['id_user']);
		?>
	</section>	
</body>
</html>