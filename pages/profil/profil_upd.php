<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['matricule'])) {
	$reponse = $db->query('SELECT * FROM ppe_visiteur where  ORDER BY VIS_MATRICULE ASC');
	$query=$db->prepare('SELECT * FROM ppe_visiteur WHERE VIS_MATRICULE = :matricule');
		$query->bindValue(':matricule',$_GET['matricule'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		$modif = 1;
}elseif (isset($_POST['matricule'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
				$matricule = $_POST['matricule'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$password = md5($_POST['password']);
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$ville = $_POST['ville'];
				$grade = $_POST['grade'];

				$query=$db->prepare('UPDATE ppe_visiteur
					SET VIS_MATRICULE = :matricule,
					VIS_NOM = :nom,
					VIS_PRENOM = :prenom,
					VIS_PASSWORD = :password,
					VIS_GRADE = :grade,
					VIS_ADRESSE = :adresse,
					VIS_CP = :cp,
					VIS_VILLE = :ville
					WHERE VIS_MATRICULE = :matricule');
				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':password', $password, PDO::PARAM_STR);
				$query->bindValue(':grade', $grade, PDO::PARAM_STR);
				$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
				$query->bindValue(':cp', $cp, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
					}
		}else{
			$matricule = $_POST['matricule'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$password = md5($_POST['password']);
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$grade = 1;

	        $query=$db->prepare('INSERT INTO ppe_visiteur (VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_PASSWORD,VIS_GRADE, VIS_ADRESSE,VIS_CP, VIS_VILLE)
	        VALUES (:matricule, :nom, :prenom, :password, :grade, :adresse, :cp, :ville)');
			$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
			$query->bindValue(':nom', $nom, PDO::PARAM_STR);
			$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
			$query->bindValue(':password', $password, PDO::PARAM_STR);
			$query->bindValue(':grade', $grade, PDO::PARAM_STR);
			$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
			$query->bindValue(':cp', $cp, PDO::PARAM_STR);
			$query->bindValue(':ville', $ville, PDO::PARAM_STR);
	        $query->execute();
	        $query->CloseCursor();
		}

}

/*echo $data['VIS_NOM'];*/
?>

<form method="post" action="profil_upd.php">
	<?php
	if (isset($modif)) {
		?><input type="hidden" name="modif" value="<?php echo $modif ?>"><?php
	}
	?>
	<?php
	if (isset($_GET['matricule'])) {
		?><input type="hidden" name="grade" value="<?php echo $data['VIS_GRADE']; ?>"><?php
	}
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  	<span class="input-group-addon" id="basic-addon1">Matricule :</span>
		  	<?php
		  	if ($_SESSION['grade']<50) {
		  		?><input type="text" name="matricule" class="form-control" value="<?php echo $data['VIS_MATRICULE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
		  		if (isset($_GET['matricule'])) {
			  		?><input type="text" name="matricule" class="form-control" value="<?php echo $data['VIS_MATRICULE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
					<input type="text" name="matricule" class="form-control" placeholder="Matricule" aria-describedby="basic-addon1">
					<?php
				}
		  	}

		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
			  <span class="input-group-addon" id="basic-addon1">Nom :</span>
			  <?php
		  	if ($_SESSION['grade']<50) {
		  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['VIS_NOM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['VIS_NOM']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="nom" class="form-control" placeholder="Nom" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Prénom :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="prenom" class="form-control" value="<?php echo $data['VIS_PRENOM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="text" name="prenom" class="form-control" value="<?php echo $data['VIS_PRENOM']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="prenom" class="form-control" placeholder="Prénom" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Mot de Passe</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="password" name="password" class="form-control" value="<?php echo $data['VIS_PASSWORD']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="password" name="password" class="form-control" value="<?php echo $data['VIS_PASSWORD']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="password" name="password" class="form-control" placeholder="Mot de Passe" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Adresse</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="adresse" class="form-control" value="<?php echo $data['VIS_ADRESSE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="text" name="adresse" class="form-control" value="<?php echo $data['VIS_ADRESSE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="adresse" class="form-control" placeholder="Adresse" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Code Postal</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="cp" class="form-control" value="<?php echo $data['VIS_CP']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="text" name="cp" class="form-control" value="<?php echo $data['VIS_CP']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="cp" class="form-control" placeholder="Code Postal" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Ville</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="ville" class="form-control" value="<?php echo $data['VIS_VILLE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['matricule'])) {
			  		?><input type="text" name="ville" class="form-control" value="<?php echo $data['VIS_VILLE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="ville" class="form-control" placeholder="Ville" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
<!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
	<div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">Date d'embauche</span>
	  <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
	</div>
</div> -->
	<div class="clearfix"></div>
		<input type="submit" value="créer" class="btn btn-primary"/>
</form>

<?php
include '../../inc/footer.php';
?>
