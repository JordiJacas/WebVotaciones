<?php
	function connectar(){
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

		return $pdo;
	}
	function login($pdo){

		//preparem i executem la consulta
		$query = $pdo->prepare("select * FROM Usuarios WHERE nombre = '".$_SESSION['usr']."' and password = '".$_SESSION['password']."'");
		$query->execute();

		//anem agafant les fileres d'amb una amb una
		$row = $query->fetch();
		if($row['id_user'] != null){
			while ( $row ) {
				$idUser = $row['id_user'];
			 	$nombreUser = $row['nombre'];
			 	$apellidoUser  = $row['apellido'];
			 	$emailUser = $row['email'];
			 	$psswd = $row['password'];
			 	$isAdmin = $row['isAdmin'];	

			 	return $row;			
			  $row = $query->fetch();
			}
		}

		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}

	function salirSession(){
		session_destroy();
	}
?>