<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
	<div id = "inicioSession">
		<form action = " " method = "post">
			<label>Name: </label> <br>
			<input type="text" name="user"/> <br> <br>
			<label>Password: </label> <br>
			<input type="password" name="password"/> <br>
			<input class = "submit" type="submit" name="submitIniciar" value="Enviar"/>
		</form>
	</div>
	<?php
		session_start();
		include 'connectar.php';

		if(!isset($_SESSION['usr']) || !isset($_SESSION['password'])){
			$_SESSION['usr'] = " ";
			$_SESSION['password'] = " ";
			
		}else{
			$_SESSION['usr'] = $_POST['user'];
			$_SESSION['password'] = $_POST['password'];
		}		
			//connexió dins block try-catch:
			//  prova d'executar el contingut del try
			//  si falla executa el catch
			try {
			  $hostname = "localhost";
			  $dbname = "Encuestas";
			  $username = "Encuesta";
			  $pw = "encuesta";
			  $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
			} catch (PDOException $e) {
			  echo "Failed to get DB handle: " . $e->getMessage() . "\n";
			  exit;
			}

			//preparem i executem la consulta
			$query = $pdo->prepare("select * FROM Usuarios WHERE nombre = '".$_SESSION['usr']."' and password = '".$_SESSION['password']."'");
			$query->execute();

			//anem agafant les fileres d'amb una amb una
			$row = $query->fetch();
			if($row != null){
				while ( $row ) {
				  $idUser = $row['id_user'];
				  $nombreUser = $row['nombre'];
				  $apellidoUser  = $row['apellido'];
				  $emailUser = $row['email'];
				  $psswd = $row['password'];
				  $isAdmin = $row['isAdmin'];
				  getDatos($idUser, $nombreUser, $apellidoUser, $emailUser, $psswd, $isAdmin);
				  $row = $query->fetch();
				}
				header('Location: http://localhost/WebVotaciones/connectar.php');
			}

			//eliminem els objectes per alliberar memòria 
			unset($pdo); 
			unset($query);	

?>
</body>
</html>