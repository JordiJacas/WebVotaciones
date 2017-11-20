<?php

		$usr = $_POST['user'];
		$psswd = $_POST['password'];
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
		$query = $pdo->prepare("select * FROM Usuarios WHERE nombre = '".$usr."' and password = '".$psswd."'");
		$query->execute();

		//anem agafant les fileres d'amb una amb una
		$row = $query->fetch();
		if($row != null){
			while ( $row ) {
			  echo $row['id_user'] . "-". $row['nombre'] ."-". $row['apellido'] ."-". $row['email'] ."-". $row['password'] ."-". $row['isAdmin'];
			  $row = $query->fetch();
			}
		}else{
			header('Location: http://localhost/WebVotaciones/');
		}

		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query)

?>