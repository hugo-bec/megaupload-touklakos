
<?php 
	if (isset($_POST['mdp']) || isset($_POST['mdp_crypt'])) {
	//var_dump($);
		if($_POST['mdp_crypt']){
			$mdp_crypt = $_POST['mdp_crypt'];
		}
		else {
			$mdp_crypt = hash('sha256', $_POST['mdp']);
		}
		var_dump($mdp_crypt);
		if ($mdp_crypt == "3a1bb5c70203b47239f83e376ceda019b56e45810934f354138ed07e5f418bd7"
		|| $mdp_crypt == "2cd573beee5051c20200f125cee253e15ab1dd762b22ca82f0d674837df0ed1c") {
			//var_dump($_FILE['']);
			if (isset($_FILES['fichier'])) {
				
				$file_name = $_FILES['fichier']['name'];
				$file_nameH = htmlspecialchars($file_name);
				$file_nameE = rawurlencode($file_name);
			   	$file_size = $_FILES['fichier']['size'];
			   	$file_tmp = $_FILES['fichier']['tmp_name'];
			  	$file_type = $_FILES['fichier']['type'];
				//$testmove = move_uploaded_file($file_tmp,"test/".$file_name);
				//var_dump($testmove);
				//var_dump($file_tmp);
				//var_dump($file_name);
				$testmove = move_uploaded_file($file_tmp, "../fichiers/".$file_name);
				//var_dump($testmove);
				if($testmove){
					$resultat = "fichier téléversé avec succés";
				}
				else {
					$resultat = "problème lors du téléversement";
				}
				
				$html = "
				<p>$resultat</p>
				<ul>
	            		<li>nom: $file_nameH </li>
	            		<li>taille: $file_size </li>
	            		<li>type: $file_type </li>
	         		</ul>
				<p><a href=\"../fichiers/".$file_nameE."\">Accéder au fichier</a></p>
				<p><a href=\"index.php\">Retour file</a></p>
				";
			}
			else {

				$html = '
				<p>cc pti con</p>
				<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mdp_crypt" value="'.$mdp_crypt.'"/>
				<label>Fichier : </label>
				<input type="file" name="fichier" required/>
				<input type="submit"/>
				</form>';
			}
		}
		else {
			$html = '
			<p>Mauvais mot de passe</p>
			<p><a href="index.php">Retour</a></p>';
		}

	}
	else {
		$html = '
		<form action="" method="post">
		<label>Entrez le mot de passe stp :</label>
		<input type="password" name="mdp" required/>
		<input type="submit"/>
		</form>';
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Fichier bg</title>
</head>
<body>
	<?php echo $html; ?>
</body>
</html>
