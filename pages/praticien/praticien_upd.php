<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['numero'])) {
	$reponse = $db->query('SELECT * FROM ppe_praticien WHERE  ORDER BY PRA_NUM ASC');
	$query=$db->prepare('SELECT * FROM ppe_praticien WHERE PRA_NUM = :numero');
		$query->bindValue(':numero',$_GET['numero'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		$modif = 1;
}elseif (isset($_POST['numero'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
				$numero = $_POST['numero'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$ville = $_POST['ville'];
				$notoriete = $_POST['notoriete'];
				$code = $_POST['code'];

				$query=$db->prepare('UPDATE ppe_praticien
					SET PRA_NUM = :numero,
					PRA_NOM = :nom,
					PRA_PRENOM = :prenom,
					PRA_ADRESSE = :adresse,
					PRA_CP = :cp,
					PRA_VILLE = :ville,
					PRA_COEFNOTORIETE = :notoriete,
					TYP_CODE = :code
					WHERE PRA_NUM = :numero');
				$query->bindValue(':numero', $numero, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
				$query->bindValue(':cp', $cp, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
				$query->bindValue(':notoriete', $notoriete, PDO::PARAM_STR);
				$query->bindValue(':code', $code, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
						}
		}else{
			$i=0;
			$error="";
			$numero = $_POST['numero'];
			if (!empty($_POST['nom'])) {
				$nom = $_POST['nom'];
			}else{
				$i++;
				$error.="nom non renseigné ";
			}
			if (!empty($_POST['prenom'])) {
				$prenom = $_POST['prenom'];
			}else{
				$i++;
				$error.="prenom non renseigné ";
			}if (!empty($_POST['adresse'])) {
				$adresse = $_POST['adresse'];
			}else{
				$i++;
				$error.="adresse non renseigné ";
			}if (!empty($_POST['cp'])) {
				$cp = $_POST['cp'];
			}else{
				$i++;
				$error.="code postal non renseigné ";
			}if (!empty($_POST['ville'])) {
				$ville = $_POST['ville'];
			}else{
				$i++;
				$error.="ville non renseigné ";
			}if (!empty($_POST['notoriete'])) {
				$notoriete = $_POST['notoriete'];
			}else{
				$i++;
				$error.="coefficient de notoriété non renseigné ";
			}if (!empty($_POST['code'])) {
				$code = $_POST['code'];
			}else{
				$i++;
				$error.="code non renseigné ";
			}
			if ($i==0) {
		        $query=$db->prepare('INSERT INTO ppe_praticien (PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, PRA_COEFNOTORIETE, TYP_CODE)
		        VALUES (:numero, :nom, :prenom, :adresse, :cp, :ville, :notoriete, :code)');
				$query->bindValue(':numero', $numero, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
				$query->bindValue(':cp', $cp, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
				$query->bindValue(':notoriete', $notoriete, PDO::PARAM_STR);
				$query->bindValue(':code', $code, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
			}else{
				echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
				
			}
		}
}
?>

<form method="post" action="praticien_upd.php">
	<?php
	if (isset($modif)) {
		?><input type="hidden" name="modif" value="<?php echo $modif ?>"><?php
	}
	?>
	<?php
	if (isset($_GET['numero'])) {
		?><input type="hidden" name="grade" value="<?php echo $data['PRA_NUM']; ?>"><?php
	}
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  	<span class="input-group-addon" id="basic-addon1">Numéro :</span>
		  	<?php
		  	if ($_SESSION['grade']<50) {
		  		?><input type="text" name="numero" class="form-control" value="<?php echo $data['PRA_NUM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
		  		if (isset($_GET['numero'])) {
			  		?><input type="text" name="numero" class="form-control" value="<?php echo $data['PRA_NUM']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
					<input type="text" name="numero" class="form-control" placeholder="Numéro" aria-describedby="basic-addon1">
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
		  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['PRA_NOM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['PRA_NOM']; ?>" aria-describedby="basic-addon1"><?php
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
		  		?><input type="text" name="prenom" class="form-control" value="<?php echo $data['PRA_PRENOM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="prenom" class="form-control" value="<?php echo $data['PRA_PRENOM']; ?>" aria-describedby="basic-addon1"><?php
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
		  <span class="input-group-addon" id="basic-addon1">Adresse</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="adresse" class="form-control" value="<?php echo $data['PRA_ADRESSE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="adresse" class="form-control" value="<?php echo $data['PRA_ADRESSE']; ?>" aria-describedby="basic-addon1"><?php
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
		  		?><input type="text" name="cp" class="form-control" value="<?php echo $data['PRA_CP']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="cp" class="form-control" value="<?php echo $data['PRA_CP']; ?>" aria-describedby="basic-addon1"><?php
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
		  		?><input type="text" name="ville" class="form-control" value="<?php echo $data['PRA_VILLE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="ville" class="form-control" value="<?php echo $data['PRA_VILLE']; ?>" aria-describedby="basic-addon1"><?php
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
		  <span class="input-group-addon" id="basic-addon1">Coefficient de notoriété</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="notoriete" class="form-control" value="<?php echo $data['PRA_COEFNOTORIETE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="notoriete" class="form-control" value="<?php echo $data['PRA_COEFNOTORIETE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="notoriete" class="form-control" placeholder="Coefficient de notoriété" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Code</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="code" class="form-control" value="<?php echo $data['TYP_CODE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['numero'])) {
			  		?><input type="text" name="code" class="form-control" value="<?php echo $data['TYP_CODE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="code" class="form-control" placeholder="Code" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="clearfix"></div>
		<input type="submit" value="créer" class="btn btn-primary"/>
</form>

<?php
include '../../inc/footer.php';
?>