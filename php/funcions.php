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

		return $row;

		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}
	function mostrarTodasConsultas($pdo){
		$query = $pdo->prepare("select * FROM Consultas");
		$query->execute();
		$consulta = $query->fetch();
		echo "<div  class = 'consulta' id='".$consulta['id_consulta']."' onclick='mostrarOpciones(this)'>";
			while($consulta){
				
				echo "<div class = 'descripcion'>".$consulta['descripcion']."</div>";
				mostrarOpciones($pdo,$consulta['id_consulta']);
				$consulta = $query->fetch();
			}
		echo "</div>";
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}

	function mostrarOpciones($pdo,$id_consulta){
		$query = $pdo->prepare("select * FROM Opciones WHERE id_consulta = ".$id_consulta."");
		$query->execute();
		$opciones = $query->fetch();

		echo "<div class='opcionesOculto' id='o".$id_consulta."'>
				<form action='votar.php' method='post'>";

		while($opciones){
			echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."'>".$opciones['texto']."<br>";
		
			$opciones = $query->fetch();
		}
		echo "	<input type='submit' name='votar' value='Votar'><br>
			</form>
			</div>";
	}
?>