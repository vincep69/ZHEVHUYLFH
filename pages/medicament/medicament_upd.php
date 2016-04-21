<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['meddepotlegal'])) {
	$reponse = $db->query('SELECT * FROM ppe_medicament where  ORDER BY MED_DEPOTLEGAL ASC');
	$query=$db->prepare('SELECT * FROM ppe_medicament WHERE MED_DEPOTLEGAL = :meddepotlegal');
		$query->bindValue(':meddepotlegal',$_GET['meddepotlegal'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		$modif = 1;
}elseif (isset($_POST['meddepotlegal'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
				$meddepotlegal = $_POST['meddepotlegal'];
				$nom = $_POST['nom'];
				$code = $_POST['code'];
				$medcompo = md5($_POST['medcompo']);
				$effet = $_POST['effet'];
				$contreindic = $_POST['contreindic'];
				$prixechantille = $_POST['prixechantille'];

				$query=$db->prepare('UPDATE ppe_medicament
					SET MED_DEPOTLEGAL = :meddepotlegal,
					MED_NOMCOMMERCIAL = :nom,
					FAM_CODE = :code,
					MED_COMPOSITION = :medcompo,
					MED_EFFETS = :effet,
					MED_CONTREINDIC = :contreindic,
					MED_PRIXECHANTILLON = :prixechantille,
					WHERE MED_DEPOTLEGAL = :meddepotlegal');
				$query->bindValue(':meddepotlegal', $meddepotlegal, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':code', $code, PDO::PARAM_STR);
				$query->bindValue(':medcompo', $medcompo, PDO::PARAM_STR);
				$query->bindValue(':effet', $effet, PDO::PARAM_STR);
				$query->bindValue(':contreindic', $contreindic, PDO::PARAM_STR);
				$query->bindValue(':prixechantille', $prixechantille, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
					}
		}else {
			$i = 0;
			$error = "";
			$meddepotlegal = $_POST['meddepotlegal'];
			if (!empty($_POST['nom'])) {
				$nom = $_POST['nom'];
			} else {
				$i++;
				$error .= "nom non renseigné ";
			}
			if (!empty($_POST['code'])) {
				$code = $_POST['code'];
			} else {
				$i++;
				$error .= "code non renseigné ";
			}
			if (!empty($_POST['medcompo'])) {
				$medcompo = ($_POST['medcompo']);
			} else {
				$i++;
				$error .= "composition non renseigné ";
			}
			if (!empty($_POST['effet'])) {
				$effet = $_POST['effet'];
			} else {
				$i++;
				$error .= "effet non renseignée ";
			}
			if (!empty($_POST['contreindic'])) {
				$contreindic = $_POST['contreindic'];
			} else {
				$i++;
				$error .= "contre indication non renseigné ";
			}
			if (!empty($_POST['prixechantille'])) {
				$ville = $_POST['prixechantille'];
			} else {
				$i++;
				$error .= "prix de l'echantillon non renseignée ";
			}
			$grade = 1;
			if ($i == 0) {

				$query = $db->prepare('INSERT INTO ppe_medicament (MED_DEPOTLEGAL, MED_NOMCOMMERCIAL, FAM_CODE, MED_COMPOSITION, MED_EFFETS, MED_CONTREINDIC, MED_PRIXECHANTILLON)
	        VALUES (:meddepotlegal, :nom, :code, :medcompo, :effet, :contreindic, :prixechantille)');
				$query->bindValue(':meddepotlegal', $meddepotlegal, PDO::PARAM_STR);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':code', $code, PDO::PARAM_STR);
				$query->bindValue(':medcompo', $medcompo, PDO::PARAM_STR);
				$query->bindValue(':effet', $effet, PDO::PARAM_STR);
				$query->bindValue(':contreindic', $contreindic, PDO::PARAM_STR);
				$query->bindValue(':prixechantille', $prixechantille, PDO::PARAM_STR);
				$query->execute();
				$query->CloseCursor();
			} else {
				echo '<div class="alert alert-warning" role="alert">' . $error . '</div>';
			}
		}

}

/*echo $data['MED_NOMCOMMERCIAL'];*/
?>

<form method="post" action="medicament_upd.php">

	<?php
	if (isset($modif)) {
		?><input type="hidden" name="modif" value="<?php echo $modif ?>"><?php
	}
	?>
	<?php
	if (isset($_GET['meddepotlegal'])) {
		?><input type="hidden" name="grade" value="<?php echo $data['MED_DEPOTLEGAL']; ?>"><?php
	}
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  	<span class="input-group-addon" id="basic-addon1">med depot legal :</span>
		  	<?php
		  	if ($_SESSION['grade']<50) {
		  		?><input type="text" name="meddepotlegal" class="form-control" value="<?php echo $data['MED_DEPOTLEGAL']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
		  		if (isset($_GET['meddepotlegal'])) {
			  		?><input type="text" name="meddepotlegal" class="form-control" value="<?php echo $data['MED_DEPOTLEGAL']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
					<input type="text" name="meddepotlegal" class="form-control" placeholder="meddepotlegal" aria-describedby="basic-addon1">
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
		  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['MED_NOMCOMMERCIAL']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['nom'])) {
			  		?><input type="text" name="nom" class="form-control" value="<?php echo $data['MED_NOMCOMMERCIAL']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="nom" class="form-control" placeholder="nom" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">code :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="code" class="form-control" value="<?php echo $data['FAM_CODE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['code'])) {
			  		?><input type="text" name="code" class="form-control" value="<?php echo $data['FAM_CODE']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="code" class="form-control" placeholder="code" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">medcompo :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="medcompo" class="form-control" value="<?php echo $data['MED_COMPOSITION']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['medcompo'])) {
			  		?><input type="text" name="medcompo" class="form-control" value="<?php echo $data['MED_COMPOSITION']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="medcompo" class="form-control" placeholder="medcompo" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">effet :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="effet" class="form-control" value="<?php echo $data['MED_EFFETS']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['effet'])) {
			  		?><input type="text" name="effet" class="form-control" value="<?php echo $data['MED_EFFETS']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="effet" class="form-control" placeholder="effet" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">contreindic :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="contreindic" class="form-control" value="<?php echo $data['MED_CONTREINDIC']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['contreindic'])) {
			  		?><input type="text" name="contreindic" class="form-control" value="<?php echo $data['MED_CONTREINDIC']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="contreindic" class="form-control" placeholder="contreindic" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
		</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">prixechantille :</span>
		 			 <?php
					 if ($_SESSION['grade']<50) {
		  					?><input type="text" name="prixechantille" class="form-control" value="NULL" aria-describedby="basic-addon1" disabled><?php
		  				}else{
			  				if (isset($_GET['prixechantille'])) {
			  				?><input type="text" name="prixechantille" class="form-control" value="NULL" aria-describedby="basic-addon1"><?php
			  			}else{
							?>
			  		<input type="text" name="prixechantille" class="form-control" placeholder="prixechantille" aria-describedby="basic-addon1">
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
