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

	function mostraUsuarios($pdo){
		$query = $pdo->prepare("select * FROM Usuarios");
		$query->execute();
		$usuarios = $query->fetch();
		//mostren el resultat de les consulta.

			while($usuarios){
				echo "Nombre: ".$usuarios['nombre']."   Contraseña: " . $usuarios['password'] ."   isAdmin: " . $usuarios['isAdmin'] . "<br>	";
				$usuarios = $query->fetch();
			}
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}

	
	function mostrarTodasConsultas($pdo,$id_user){
		$hoy = getdate();
		$fecha = $hoy['year'] ."-".$hoy['mon']."-".$hoy['mday'];

		$query = $pdo->prepare("select * FROM Consultas WHERE fechaInicial <= '".$fecha."' AND fechaFinal < '".$fecha."'");
		$query->execute();
		$consulta = $query->fetch();
		//mostren el resultat de les consulta.
			while($consulta){
				echo "<div  class = 'consulta' >";
				echo "<div class = 'descripcion' id='".$consulta['id_consulta']."' onclick='mostrarOpciones(this)'>".$consulta['descripcion']."</div>";
				//ejecutem la funcio per obtenir les opciones de la conuçsulta.
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
		//executem la funcio per saber si l'usuari ha votat i la opcion que ha escollit.
		$voto = mostrarResultados($pdo,$id_consulta,$id_user);
		
		//mostrem el resultat obtingut.
		echo "<div class='opcionesOculto' id='o".$id_consulta."'>
				<form action='votar.php' method='post'>";

		while($opciones){
			
			//decidim si el input(radio) esta checked o no.
			//if($opciones['id_opcion'] == $voto['id_opcion']){
			//	echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."' checked>".$opciones['texto']."";
			//}else if($opciones['id_opcion'] != $voto['id_opcion']){
				echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."'>".$opciones['texto']."";
			//}
		
			$opciones = $query->fetch();
		}
		echo "	<br><input class='votar' type='submit' name='votar' value='Votar'><br>
				<input type='text' value='".$voto['id_voto']."' name='voto' style='display:none;'>
			</form>
			</div>";
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}
	
	function mostrarResultados($pdo,$id_consulta,$id_user){
		//executem la funcio i retornem la array amb tots els elements.
		$query = $pdo->prepare("select * FROM Votos WHERE EXISTS (select * FROM Opciones WHERE id_consulta = ".$id_consulta.") and id_user = ".$id_user."");
		$query->execute();
		$opciones = $query->fetch();

		return $opciones;

		unset($pdo); 
		unset($query);
	}

	function mostrarConsultasUsuario($pdo,$id_user){
		$query = $pdo->prepare("select * FROM Consultas Where id_admin = ".$id_user."");
		$query->execute();
		$consulta = $query->fetch();
		//mostren el resultat de les consulta.
			while($consulta){
				echo "<div  class = 'consulta' >";
				echo "<div class = 'descripcion' id='".$consulta['id_consulta']."' onclick='mostrarOpciones(this)'>".$consulta['descripcion']."</div>";
				//ejecutem la funcio per obtenir les opciones de la conuçsulta.
				//mostrarOpciones($pdo,$consulta['id_consulta'],$id_user);
				$consulta = $query->fetch();
				echo "<form action='' method='post'><input type='submit' value='Editar'></form>";
				echo "<form action='' method='post'><input type='submit' value='Borrar'></form>";
				echo "<form action='' method='post'><input type='text'style='display:none'>";
					//if($consulta[''] == false){
						echo "<input type='submit' value='Activar'></form>";
					//}else if($consulta[''] == true){
						echo "<input type='submit' value='Desactivar'>";
					//}
				echo "<form action='' method='post'><input type='submit' value='Invitar'></form>";		
				echo "</form>";
				echo "</div>";
			}
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}

	function todosUsuarios($pdo,$id_user){
		$query = $pdo->prepare("select * FROM Usuarios Where id_user != ".$id_user."");
		$query->execute();
		$usuarios = $query->fetch();

		while($usuarios){
			echo "<input type='checkbox' name='email[]' value='".$usuarios['email']."'>".$usuarios['nombre'] . " " .$usuarios['apellido']."<br>";
			$usuarios = $query->fetch();
		}
	}
?>