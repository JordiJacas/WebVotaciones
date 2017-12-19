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

	
	function mostrarTodasConsultas($pdo,$id_user,$boolean, $password){
		$hoy = getdate();
		$fecha = $hoy['year'] ."-".$hoy['mon']."-".$hoy['mday'];

		$query = $pdo->prepare("SELECT * FROM Consultas WHERE fechaInicial <= '".$fecha."' AND fechaFinal >= '".$fecha."'");
		$query->execute();
		$consulta = $query->fetch();

		//mostren el resultat de les consulta.
			while($consulta){
				$votado = votado($pdo,$consulta['id_consulta'],$id_user);
				$invitado = invitado($pdo,$consulta['id_consulta'],$id_user);

				if($votado == $boolean && $invitado){
					echo "<div  class = 'consulta' >";
					echo "<div class = 'descripcion' id='".$consulta['id_consulta']."' onclick='mostrarConsultaSel(this)'>".$consulta['descripcion']."</div>";
					//ejecutem la funcio per obtenir les opciones de la conuçsulta.
					mostrarOpciones($pdo,$consulta['id_consulta'],$id_user,$password);
					echo "<form id='consulta".$consulta['id_consulta']."' action='consulta.php' method='post' style='display:none;'><input type='text' name='idConsulta' value='".$consulta['id_consulta']."'></form>";
					echo "</div>";
					
				}
				$consulta = $query->fetch();	
			}
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}
	
	function votado($pdo,$consulta,$id_user){
		$query = $pdo->prepare("select * FROM Opciones WHERE id_consulta = ".$consulta." AND id_opcion = (select id_opcion FROM Votos WHERE id_user = ".$id_user.")");
		$query->execute();
		//$votado = $query->fetch();

		$query = $pdo->prepare("select *
								FROM VotosOpcion vo, Opciones o, Consultas c, VotosUsuario vu
								WHERE o.id_consulta = c.id_consulta and vo.id_opcion = o.id_opcion and o.id_consulta = ".$consulta." and vu.id_user = ".$id_user.";
		");
		$query->execute();
		$votado = $query->fetch();
		if(count($votado) <= 1){
			return false;
		} else if(count($votado) > 1){
			return true;
		}

		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}
	
	function invitado($pdo,$consulta,$id_user){
		$query = $pdo->prepare("SELECT * FROM Invitaciones WHERE id_admin = ".$id_user." AND id_consulta = ".$consulta."");
		$query->execute();
		$invitado = $query->fetch();
		
		if(count($invitado) <= 1){
			return false;
		} else if(count($invitado) > 1){
			return true;
		}


		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
	}
	
	function mostrarConsulta($pdo,$id_consulta,$id_user,$password){

		$query = $pdo->prepare("select * FROM Consultas WHERE id_consulta = ".$id_consulta."");
		$query->execute();
		$consulta = $query->fetch();
		//mostren el resultat de les consulta.
			while($consulta){
				echo "<div  class = 'consulta' >";
				echo "<div class = 'descripcion' id='".$consulta['id_consulta']."' onclick=''>".$consulta['descripcion']."</div>";
				//ejecutem la funcio per obtenir les opciones de la conuçsulta.
				mostrarOpciones($pdo,$consulta['id_consulta'],$id_user,$password);
				echo "<form id='consulta".$consulta['id_consulta']."' action='consulta.php' method='post' style='display:none;'><input type='text' name='idConsulta' value='".$consulta['id_consulta']."'></form>";
				$consulta = $query->fetch();
				echo "</div>";
			}
		
		//eliminem els objectes per alliberar memòria 
		unset($pdo); 
		unset($query);
		}

	function mostrarOpciones($pdo,$id_consulta,$id_user,$password){
		$query = $pdo->prepare("select * FROM Opciones WHERE id_consulta = ".$id_consulta."");
		$query->execute();
		$opciones = $query->fetch();
		//executem la funcio per saber si l'usuari ha votat i la opcion que ha escollit.
		$voto = mostrarResultados($pdo,$id_consulta,$id_user,$password);

		//mostrem el resultat obtingut.
		echo "<div class='opcionesOculto' id='o".$id_consulta."'>
				<form action='votarNew.php' method='post'>";

		while($opciones){
			if($id_user == 1){
				$contadorVoto = countResultado($pdo, $opciones['id_opcion']);
				$mostrarVotos = "&nbsp; Votos:".$contadorVoto;
			}else{
				$mostrarVotos = "";
			}
			//decidim si el input(radio) esta checked o no.
			if($opciones['id_opcion'] == $voto['id_opcion']){
				echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."' checked>".$opciones['texto']."";
				echo $mostrarVotos;
			}else if($opciones['id_opcion'] != $voto['id_opcion']){
				echo "<input type='radio' name='respuesta' value='".$opciones['id_opcion']."'>".$opciones['texto']."";
				echo $mostrarVotos;
			}
			echo "<br>";
			
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
	
	function mostrarResultados($pdo,$id_consulta,$id_user,$password){
		//	executem la funcio i retornem la array amb tots els elements.
		$query = $pdo->prepare("select vu.id_voto, vo.id_opcion
								FROM VotosOpcion vo, Opciones o, Consultas c, VotosUsuario vu
								WHERE o.id_consulta = c.id_consulta and vo.id_opcion = o.id_opcion and o.id_consulta = ".$id_consulta." and vu.id_user = ".$id_user." and AES_DECRYPT('vu.hash_enc') = vo.hash;
		");
		$query->execute();
		$voto = $query->fetch();

		return $voto;

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

	function countResultado($pdo, $id_opcion){
		$query = $pdo->prepare("SELECT COUNT(id_voto) FROM VotosOpcion WHERE id_opcion=".$id_opcion."");
		$query->execute();
		$votos = $query->fetch();

		return $votos['COUNT(id_voto)'];
	}

	function crearHash($length = 25){		
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function invitarSelect($pdo,$idAdmin){
		  //preparem i executem la consulta
		  $query = $pdo->prepare("select * FROM Consultas Where id_admin = ".$idAdmin."");
		  $query->execute();

		  $row = $query->fetch();
		  while ( $row ) {
		    echo "<option value='".$row['id_consulta']."'>".$row['descripcion']."</option>";
		    $row = $query->fetch();
		  }

		  //eliminem els objectes per alliberar memòria 
		  unset($pdo); 
		  unset($query);
	}
?>