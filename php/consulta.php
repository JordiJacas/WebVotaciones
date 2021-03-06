<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/styleNav.css">
	<link rel="stylesheet" type="text/css" href="../css/styleVerConsulta.css">
	<script type="text/javascript" src="../js/script.js"></script>
	<title>Consulta</title>
</head>
<body id = "snow" onload = "mostrarOpciones()">
<?php
	session_start();
	$row = $_SESSION['row'];
	
	include 'funcions.php';
	$pdo = connectar();
	
	$idConsulta = $_POST['idConsulta'];
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
<?php
	mostrarConsulta($pdo,$idConsulta,$row['id_user'],$row['password']);
?>
</body>
</html>
