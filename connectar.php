	<?php
		  //connexió dins block try-catch:
		  //  prova d'executar el contingut del try
		  //  si falla executa el catch
		  try {
		    $hostname = "localhost";
		    $dbname = "Encuestas";
		    $username = "";
		    $pw = "";
		    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");

		  } catch (PDOException $e) {

		    echo "Failed to get DB handle: " . $e->getMessage() . "\n"
		    exit;
		  }

		  // //preparem i executem la consulta
		  // $query = $pdo->prepare("select nombre FROM Usuarios");
		  // $query->execute();

		  // //anem agafant les fileres d'amb una amb una
		  // $row = $query->fetch();
		  // while ( $row ) {
		  //   echo $row['nombre']
		  //   $row = $query->fetch();
		  // }

		  // //eliminem els objectes per alliberar memòria 
		  // unset($pdo); 
		  // unset($query)

		?>