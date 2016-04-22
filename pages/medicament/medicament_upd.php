<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['depotlegal'])) {
	$reponse = $db->query('SELECT * FROM ppe_medicament where  ORDER BY MED_DEPOTLEGAL ASC');
	$query=$db->prepare('SELECT * FROM ppe_medicament WHERE MED_DEPOTLEGAL = :depotlegal');
		$query->bindValue(':depotlegal',$_GET['depotlegal'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		$modif = 1;
}elseif (isset($_POST['depotlegal'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
				$depotlegal = $_POST['depotlegal'];
				$nom = $_POST['nom'];
				$code = $_POST['code'];
				$medcompo = $_POST['medcompo'];
				$effet = $_POST['effet'];
				$contreindic = $_POST['contreindic'];
				$prixechantille = $_POST['prixechantille'];

				$query=$db->prepare('UPDATE ppe_medicament
					SET MED_DEPOTLEGAL = :depotlegal,
					MED_NOMCOMMERCIAL = :nom,
					FAM_CODE = :code,
					MED_COMPOSITION = :medcompo,
					MED_EFFETS = :effet,
					MED_CONTREINDIC = :contreindic,
					MED_PRIXECHANTILLON = :prixechantille,
					WHERE MED_DEPOTLEGAL = :depotlegal');
				$query->bindValue(':depotlegal', $depotlegal, PDO::PARAM_STR);
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
			$depotlegal = $_POST['depotlegal'];
			if (!empty($_POST['nom'])) {
				$nom = $_POST['nom'];
			} else {
				$i++;
				$error .= "Nom non renseigné <br> ";
			}
			if (!empty($_POST['code'])) {
				$code = $_POST['code'];
			} else {
				$i++;
				$error .= "Code non renseigné <br> ";
			}
			if (!empty($_POST['medcompo'])) {
				$medcompo = ($_POST['medcompo']);
			} else {
				$i++;
				$error .= "Composition non renseigné <br> ";
			}
			if (!empty($_POST['effet'])) {
				$effet = $_POST['effet'];
			} else {
				$i++;
				$error .= "Effet non renseignée <br> ";
			}
			if (!empty($_POST['contreindic'])) {
				$contreindic = $_POST['contreindic'];
			} else {
				$i++;
				$error .= "Contre indication non renseigné <br> ";
			}
			if (!empty($_POST['prixechantille'])) {
				$ville = $_POST['prixechantille'];
			} else {
				$i++;
				$error .= "Prix de l'echantillon non renseignée <br> ";
			}
			$grade = 1;
			if ($i == 0) {

				$query = $db->prepare('INSERT INTO ppe_medicament (MED_DEPOTLEGAL, MED_NOMCOMMERCIAL, FAM_CODE, MED_COMPOSITION, MED_EFFETS, MED_CONTREINDIC, MED_PRIXECHANTILLON)
	        VALUES (:depotlegal, :nom, :code, :medcompo, :effet, :contreindic, :prixechantille)');
				$query->bindValue(':depotlegal', $depotlegal, PDO::PARAM_STR);
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
	if (isset($_GET['depotlegal'])) {
		?><input type="hidden" name="grade" value="<?php echo $data['MED_DEPOTLEGAL']; ?>"><?php
	}
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  	<span class="input-group-addon" id="basic-addon1">Depot legal :</span>
		  	<?php
		  	if ($_SESSION['grade']<50) {
		  		?><input type="text" name="depotlegal" class="form-control" value="<?php echo $data['MED_DEPOTLEGAL']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
		  		if (isset($_GET['depotlegal'])) {
			  		?><input type="text" name="depotlegal" class="form-control" value="<?php echo $data['MED_DEPOTLEGAL']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
					<input type="text" name="depotlegal" class="form-control" placeholder="depotlegal" aria-describedby="basic-addon1">
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
			  	if (isset($_GET['depotlegal'])) {
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
		  <span class="input-group-addon" id="basic-addon1">Code identiffication:</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="code" class="form-control" value="<?php echo $data['FAM_CODE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['depotlegal'])) {
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
		  <span class="input-group-addon" id="basic-addon1">Composition :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="medcompo" class="form-control" value="<?php echo $data['MED_COMPOSITION']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['depotlegal'])) {
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
		  <span class="input-group-addon" id="basic-addon1">Effet(s) a noter :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="effet" class="form-control" value="<?php echo $data['MED_EFFETS']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['depotlegal'])) {
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
		  <span class="input-group-addon" id="basic-addon1">Contre indication :</span>
		  <?php
		  if ($_SESSION['grade']<50) {
		  		?><input type="text" name="contreindic" class="form-control" value="<?php echo $data['MED_CONTREINDIC']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['depotlegal'])) {
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
				  <span class="input-group-addon" id="basic-addon1">Prix de l'echantillon :</span>
		 			 <?php
					 if ($_SESSION['grade']<50) {
		  					?><input type="text" name="prixechantille" class="form-control" value="NULL" aria-describedby="basic-addon1" disabled><?php
		  				}else{
			  				if (isset($_GET['depotlegal'])) {
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
	<div class="clearfix"></div>
	<?php
	if (isset($_GET['depotlegal'])) {
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
include '../../inc/footer.php';
?>
