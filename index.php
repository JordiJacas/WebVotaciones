<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
	<div id = "inicioSession">
		<form action = "funcions.php" method = "post">
			<label>Name: </label> <br>
			<input type="text" name="user"/> <br> <br>
			<label>Password: </label> <br>
			<input type="text" name="password"/> <br>
			<input class = "submit" type="submit" name="submitIniciar" value="Enviar"/>
		</form>
	</div>

	<div id = "consulta">
		<form action = "" method="post">
			<label>Escribe aque la consulta: </label> <br>
			<input type="textArea" name="consulta">
			<input class = "submit" type="submit" name="submitConsulta" value = "Enviar">
		</form>
	</div>

</body>
</html>