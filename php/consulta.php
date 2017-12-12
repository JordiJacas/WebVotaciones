<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	$row = $_SESSION['row'];
	
	include 'funcions.php';
	$pdo = connectar();
	
	$idConsulta = $_POST['idConsulta'];
	mostrarConsulta($pdo,$idConsulta,$row['id_user']);
?>
</body>
</html>
