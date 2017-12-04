<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Usuarios</p>
<?php
	include 'funcions.php';
	$pdo = connectar();

	//mostrarConsultasUsuario($pdo,1);
	echo "<form action='email.php' method='post'>
		<label>Emails: </label>
		<textarea name='email'></textarea>
		<br>
		<input type='submit' value='invitar'>
		</form>";
?>
</body>
</html>
