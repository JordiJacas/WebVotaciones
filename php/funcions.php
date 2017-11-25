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
	
	function mostrarTodasConsultas($pdo,$id_user){
		$query = $pdo->prepare("select * FROM Consultas");
		$query->execute();
		$consulta = $query->fetch();
		
		
			while($consulta){
				echo "<div  class = 'consulta' >";
				echo "<div class = 'descripcion' id='".$consulta['id_consulta']."' onclick='mostrarOpciones(this)'>".$consulta['descripcion']."</div>";
				mostrarOpciones($pdo,$consulta['id_consulta'],$id_user);
				$consulta = $query->fetch();
				echo "</div>";
			}
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}

	function mostrarOpciones($pdo,$id_consulta,$id_user){
		$query = $pdo->prepare("select * FROM Opciones WHERE id_consulta = ".$id_consulta."");
		$query->execute();
		$opciones = $query->fetch();
		$voto = mostrarResultados($pdo,$id_consulta,$id_user);
		echo "<div class='opcionesOculto' id='o".$id_consulta."'>
				<form action='votar.php' method='post'>";

		while($opciones){
			
			if($opciones['id_opcion'] == $voto['id_opcion']){
				echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."' checked>".$opciones['texto']."";
			}else if($opciones['id_opcion'] != $voto['id_opcion']){
				echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."'>".$opciones['texto']."";
			}
		
			$opciones = $query->fetch();
		}
		echo "	<br><input class='votar' type='submit' name='votar' value='Votar'><br>
				<input type='text' value='".$voto['id_voto']."' name='voto' style='display:none;'>
			</form>
			</div>";
		unset($pdo); 
		unset($query);
	}
	
	function mostrarResultados($pdo,$id_consulta,$id_user){
		
		$query = $pdo->prepare("select * FROM Votos WHERE EXISTS (select * FROM opciones WHERE id_consulta = ".$id_consulta.") and id_user = ".$id_user."");
		$query->execute();
		$opciones = $query->fetch();
		
		return $opciones;

		unset($pdo); 
		unset($query);
	}
?>