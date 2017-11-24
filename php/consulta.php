<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleMenuPrincipal.css">
	<meta charset="utf-8">
	<title>Consulta</title>
</head>
<body>
<?php
	session_start();
	include 'funcions.php';
	$row = $_SESSION['row'];
	$id_consulta = $_GET['id_consulta'];
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
		
	<section>
		<?php
			$pdo = connectar();
			mostrarConsulta($pdo,$id_consulta);
			mostrarOpciones($pdo,$id_consulta);
		?>
	</section>	
</body>
</html>