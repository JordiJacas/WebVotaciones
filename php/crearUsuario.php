<?php
	session_start();
	include 'funcions.php';
	$pdo = connectar();
	
	
	$email = $_POST['email'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$password = $_POST['password'];


	if(isset($_GET['token'])){
		$token = $_GET['token'];

	}else if(!isset($_GET['token'])){
		$token = null;
	}
	
	$query = $pdo->prepare("SELECT * FROM Usuarios WHERE token = '".$token."' AND email = '".$email."'");
	$query->execute();
	$comprovar = $query->fetch();


	if(count($comprovar)>1){
		if($comprovar['nombre'] == null && $comprovar['apellido']== null){

			$query = $pdo->prepare("UPDATE Usuarios SET nombre='".$nombre."', apellido='".$apellido."', password=sha1('".$password."'), token = null WHERE token = '".$token."' AND email = '".$email."'");

			$query->execute();
			$row = $query->fetch();

			if ($row){
				
				$_SESSION['row'] = $row;
				header('Location: http://jjacas.tk/~app/WebVotaciones/php/menuPrincipal.php');
				
			}else{
				header('Location: http://jjacas.tk/~app/WebVotaciones/');
			}
		}else{
			echo "<script>alert('El correo ya existe')</script>";
		}
	}else if(count($comprovar)<=1){
		
		//preparem i executem la consulta
		$query = $pdo->prepare("INSERT INTO `Usuarios`(`nombre`, `apellido`, `email`, `password`) VALUES ('".$nombre."', '".$apellido."', '".$email."', sha1('".$password."'));");

		$query->execute();
		$row = $query->fetch();
		print_r($query);
		
		if ($row){
			
			$_SESSION['row'] = $row;
			header('Location: http://jjacas.tk/~app/WebVotaciones/php/menuPrincipal.php');
			
		}else{
			header('Location: http://jjacas.tk/~app/WebVotaciones/');
		}
	}
	
	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query)
?>