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
	include 'funcions.php';
	
	//print_r($_SESSION['row']);
	$row = $_SESSION['row'];
?>
	<nav>
		<ul>
			<li><a href="menuPrincipal.php" >Inicio</a></li>
			<li><a>Perfil</a></li>
			<li><a>Mis Consultas</a></li>
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
			$pdo = connectar();
			mostrarTodasConsultas($pdo);
		?>	
	</section>	
</body>
</html>