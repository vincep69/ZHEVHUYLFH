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
				// $password = md5($_POST['password']);
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$ville = $_POST['ville'];
				$grade = $_POST['grade'];

				$query=$db->prepare('UPDATE ppe_visiteur
					SET VIS_MATRICULE = :matricule,
					VIS_NOM = :nom,
					VIS_PRENOM = :prenom,
					VIS_GRADE = :grade,
					VIS_ADRESSE = :adresse,
					VIS_CP = :cp,
					VIS_VILLE = :ville
					WHERE VIS_MATRICULE = :matricule');
				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':grade', $grade, PDO::PARAM_STR);
				$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
				$query->bindValue(':cp', $cp, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
					}
		}else{
			$i=0;
			$error="";
			$matricule = $_POST['matricule'];
			if (!empty($_POST['nom'])) {
				$nom = $_POST['nom'];
			}else {
				$i++;
				$error.="nom non renseigné ";
			}
			if (!empty($_POST['prenom'])) {
				$prenom = $_POST['prenom'];
			}else {
				$i++;
				$error.="prenom non renseigné ";
			}
			if (!empty($_POST['password'])) {
				$password = md5($_POST['password']);
			}else {
				$i++;
				$error.="mot de passe non renseigné ";
			}
			if (!empty($_POST['adresse'])) {
				$adresse = $_POST['adresse'];
			}else {
				$i++;
				$error.="adresse non renseignée ";
			}
			if (!empty($_POST['cp'])) {
				$cp = $_POST['cp'];
			}else {
				$i++;
				$error.="code postal non renseigné ";
			}
			if (!empty($_POST['ville'])) {
				$ville = $_POST['ville'];
			}else {
				$i++;
				$error.="ville non renseignée ";
			}
			if (!empty($_POST['numsecteur'])) {
				$numsecteur = $_POST['numsecteur'];
			}else {
				$i++;
				$error.="Secteur non renseigné <br>";
			}
			if (!empty($_POST['numlabo'])) {
				$numlabo = $_POST['numlabo'];
			}else {
				$i++;
				$error.="Labo non renseigné <br>";
			}
			$grade = 1;
			$date=date("y.m.d");
			if ($i==0) {
				$query=$db->prepare('INSERT INTO ppe_visiteur (VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_PASSWORD,VIS_GRADE, VIS_ADRESSE,VIS_CP, VIS_VILLE, VIS_DATEEMBAUCHE, LAB_CODE, SEC_CODE)
				VALUES (:matricule, :nom, :prenom, :password, :grade, :adresse, :cp, :ville, :date, :labo, :secteur)');
				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':password', $password, PDO::PARAM_STR);
				$query->bindValue(':grade', $grade, PDO::PARAM_STR);
				$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
				$query->bindValue(':cp', $cp, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
				$query->bindValue(':date', $date, PDO::PARAM_STR);
				$query->bindValue(':labo', $numlabo, PDO::PARAM_STR);
				$query->bindValue(':secteur', $numsecteur, PDO::PARAM_STR);
				$query->execute();
				$query->CloseCursor();
			}else{
				echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';

			}
		}

}

/*echo $data['VIS_NOM'];*/

	?>

	<?php
	if (isset($_GET['matricule'])) {
	?>
	<h1>Modification d'employé</h1>
	<?php
	}else{
		?>
		<h1>Création d'employé</h1>
		<?php
	}
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
			  		?><input type="password" name="password" class="form-control" value="<?php echo $data['VIS_PASSWORD']; ?>" aria-describedby="basic-addon1" disabled><?php
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
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Secteur</span>
		  <?php
			$secteurs = $db->query('SELECT * FROM ppe_secteur ORDER BY SEC_CODE');
		  if ($_SESSION['grade']<10) {
		  		?><input type="text" name="numsecteur" class="form-control" value="<?php echo $data['SEC_CODE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?>
						<!-- <input type="text" name="numsecteur" class="form-control" value="<?php echo $data['SEC_CODE']; ?>" aria-describedby="basic-addon1"> -->
						<select name="numsecteur" class="form-control">
							<?php
							while ($optionsecteurs = $secteurs->fetch()) {
								if ($optionsecteurs['SEC_CODE']==$data['SEC_CODE']) {
									?>
									<option selected value="<?php echo $optionsecteurs['SEC_CODE']; ?>"><?php echo $optionsecteurs['SEC_CODE']." ".$optionsecteurs['SEC_LIBELLE']; ?></option>
									<?php
								}else{
									?>
							  	<option value="<?php echo $optionsecteurs['SEC_CODE']; ?>"><?php echo $optionsecteurs['SEC_CODE']." ".$optionsecteurs['SEC_LIBELLE']; ?></option>
									<?php
								}
							}
							$secteurs->closeCursor();
							?>
						</select>
						<?php
			  	}else{
					?>
			  		<!-- <input type="text" name="numpraticien" class="form-control" placeholder="numéro" aria-describedby="basic-addon1"> -->
						<select name="numsecteur" class="form-control">
							<?php
							while ($optionsecteurs = $secteurs->fetch()) {
								?>
						  	<option value="<?php echo $optionsecteurs['SEC_CODE']; ?>"><?php echo $optionsecteurs['SEC_CODE']." ".$optionsecteurs['SEC_LIBELLE']; ?></option>
								<?php
							}
							$secteurs->closeCursor();
							?>
						</select>
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Labo</span>
		  <?php
			$labos = $db->query('SELECT * FROM ppe_labo ORDER BY LAB_CODE');
		  if ($_SESSION['grade']<10) {
		  		?><input type="text" name="numlabo" class="form-control" value="<?php echo $data['LAB_CODE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?>
						<!-- <input type="text" name="numlabo" class="form-control" value="<?php echo $data['LAB_CODE']; ?>" aria-describedby="basic-addon1"> -->
						<select name="numlabo" class="form-control">
							<?php
							while ($optionlabos = $labos->fetch()) {
								if ($optionlabos['LAB_CODE']==$data['LAB_CODE']) {
									?>
									<option selected value="<?php echo $optionlabos['LAB_CODE']; ?>"><?php echo $optionlabos['LAB_CODE']." ".$optionlabos['LAB_NOM']; ?></option>
									<?php
								}else{
									?>
							  	<option value="<?php echo $optionlabos['LAB_CODE']; ?>"><?php echo $optionlabos['LAB_CODE']." ".$optionlabos['LAB_NOM']; ?></option>
									<?php
								}
							}
							$labos->closeCursor();
							?>
						</select>
						<?php
			  	}else{
					?>
			  		<!-- <input type="text" name="numpraticien" class="form-control" placeholder="numéro" aria-describedby="basic-addon1"> -->
						<select name="numlabo" class="form-control">
							<?php
							while ($optionlabos = $labos->fetch()) {
								?>
						  	<option value="<?php echo $optionlabos['LAB_CODE']; ?>"><?php echo $optionlabos['LAB_CODE']." ".$optionlabos['LAB_NOM']; ?></option>
								<?php
							}
							$labos->closeCursor();
							?>
						</select>
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
	<?php
	if (isset($_GET['matricule'])) {
	?>
		<input type="submit" value="sauvegarder" class="btn btn-primary"/>
	<?php
	}else{
	 ?>
	 <input type="submit" value="créer" class="btn btn-primary"/>
	 <?php
	 }
	  ?>
</form>

<?php
if (isset($_GET['matricule'])) {
  $reponse=$db->prepare('SELECT * FROM ppe_rapport_visite WHERE VIS_MATRICULE = :matricule');
  $reponse->bindValue(':matricule',$_GET['matricule'], PDO::PARAM_STR);
  $reponse->execute();

?>
<h2>Rapports</h2>
<table class="table">
	<thead>
    <th>
			Matricule visiteur
		</th>
    <th>
			Numéro de rapport
		</th>
    <th>
			matricule praticien
		</th>
		<th>
			date
		</th>
		<th>
			bilan
		</th>
    <th>
			motif
		</th>
	</thead>
	<tbody>
	<?php
	while ($donnees = $reponse->fetch()) {
		?>

			<tr>
        <td>
					<?php echo $donnees['VIS_MATRICULE'] ?>
				</td>
				<td><a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php?rapport=<?php echo $donnees['RAP_NUM'] ?>&mat=<?php echo $donnees['VIS_MATRICULE'] ?>">
					<?php echo $donnees['RAP_NUM'] ?></a>
				</td>
				<td>
					<?php echo $donnees['PRA_NUM'] ?>
				</td>
				<td>
					<?php echo $donnees['RAP_DATE'] ?>
				</td>
        <td>
					<?php echo $donnees['RAP_BILAN'] ?>
				</td>
        <td>
					<?php echo $donnees['RAP_MOTIF'] ?>
				</td>
			</tr>

		<?php
		}
		$reponse->closeCursor();
		?>
	</tbody>
</table>
<?php
}
include '../../inc/footer.php';
?>
