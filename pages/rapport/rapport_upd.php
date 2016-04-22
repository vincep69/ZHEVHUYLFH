<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['rapport'])) {
	$reponse = $db->query('SELECT * FROM ppe_rapport_visite WHERE  ORDER BY VIS_MATRICULE ASC');
	$query=$db->prepare('SELECT * FROM ppe_rapport_visite WHERE RAP_NUM = :rapport');
		$query->bindValue(':rapport',$_GET['rapport'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		$modif = 1;
}elseif (isset($_POST['num'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
        $i=0;
  			$error="";
  			$num = $_POST['num'];
  			if (!empty($_POST['matricule'])) {
  				$matricule = $_POST['matricule'];
  			}else {
  				$i++;
  				$error.="Matricule non renseigné <br>";
  			}
  			if (!empty($_POST['motif'])) {
  				$motif = $_POST['motif'];
  			}else {
  				$i++;
  				$error.="Motif non renseigné <br>";
  			}
  			if (!empty($_POST['bilan'])) {
  				$bilan = $_POST['bilan'];
  			}else {
  				$i++;
  				$error.="Bilan non renseigné <br>";
  			}
  			if (!empty($_POST['numpraticien'])) {
  				$numpraticien = $_POST['numpraticien'];
  			}else {
  				$i++;
  				$error.="Praticien non renseigné <br>";
  			}
  			if ($i==0) {
  				$query=$db->prepare('UPDATE ppe_rapport_visite
  					SET VIS_MATRICULE = :matricule,
  					RAP_NUM = :num,
  					PRA_NUM = :numpraticien,
  					RAP_BILAN = :bilan,
  					RAP_MOTIF = :motif
  					WHERE RAP_NUM = :num');
    				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    				$query->bindValue(':num', $num, PDO::PARAM_STR);
    				$query->bindValue(':numpraticien', $numpraticien, PDO::PARAM_STR);
    				$query->bindValue(':bilan', $bilan, PDO::PARAM_STR);
    				$query->bindValue(':motif', $motif, PDO::PARAM_STR);
		        $query->execute();
		        $query->CloseCursor();
						echo "yes";
						echo $num;
          }else{
            echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
          }
					}
		}else{
			$i=0;
			$error="";
			$matricule = $_POST['matricule'];
			if (!empty($_POST['num'])) {
				$num = $_POST['num'];
			}else {
				$i++;
				$error.="Numéro non renseigné <br>";
			}
			if (!empty($_POST['motif'])) {
				$motif = $_POST['motif'];
			}else {
				$i++;
				$error.="Motif non renseigné <br>";
			}
			if (!empty($_POST['bilan'])) {
				$bilan = $_POST['bilan'];
			}else {
				$i++;
				$error.="Bilan non renseigné <br>";
			}
			if (!empty($_POST['numpraticien'])) {
				$numpraticien = $_POST['numpraticien'];
			}else {
				$i++;
				$error.="Praticien non renseigné <br>";
			}
			if ($i==0) {
				$query=$db->prepare('INSERT INTO ppe_rapport_visite (VIS_MATRICULE, RAP_NUM, RAP_MOTIF, PRA_NUM ,RAP_BILAN)
				VALUES (:matricule, :num, :motif, :numpraticien, :bilan)');
				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
				$query->bindValue(':num', $num, PDO::PARAM_STR);
				$query->bindValue(':motif', $motif, PDO::PARAM_STR);
				$query->bindValue(':bilan', $bilan, PDO::PARAM_STR);
				$query->bindValue(':numpraticien', $numpraticien, PDO::PARAM_STR);
				$query->execute();
				$query->CloseCursor();
			}else{
				echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
			}
		}

}
/*echo $data['VIS_NOM'];*/
?>

<form method="post" action="rapport_upd.php">
	<?php
	if (isset($modif)) {
		?><input type="hidden" name="modif" value="<?php echo $modif ?>"><?php
	}
	?>
	<!-- <?php
	if (isset($_GET['matricule'])) {
		?><input type="hidden" name="grade" value="<?php echo $data['VIS_GRADE']; ?>"><?php
	}
	?> -->
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  	<span class="input-group-addon" id="basic-addon1">Matricule :</span>
		  	<?php
		  	if ($_SESSION['grade']<10) {
		  		?><input type="text" name="matricule" class="form-control" value="<?php echo $data['VIS_MATRICULE']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
		  		if (isset($_GET['rapport'])) {
			  		?>
						<input type="text" name="matricule" class="form-control" value="<?php echo $data['VIS_MATRICULE']; ?>" aria-describedby="basic-addon1" disabled>
						<input type="hidden" name="matricule" value="<?php echo $data['VIS_MATRICULE']; ?>">
						<?php
			  	}else{
					?>
					<input type="text" name="matricule" class="form-control" value="<?php echo $_SESSION['login']; ?>" aria-describedby="basic-addon1" disabled>
					<input type="hidden" name="matricule" value="<?php echo $_SESSION['login']; ?>">
					<?php
				}
		  	}

		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
			  <span class="input-group-addon" id="basic-addon1">Numéro de rapport :</span>
			  <?php
		  	if ($_SESSION['grade']<10) {
		  		?><input type="text" name="num" class="form-control" value="<?php echo $data['RAP_NUM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?><input type="text" name="num" class="form-control" value="<?php echo $data['RAP_NUM']; ?>" aria-describedby="basic-addon1" disabled>
						<input type="hidden" name="num" value="<?php echo $data['RAP_NUM']; ?>">
						<?php
			  	}else{
						$numerorapport = 1;
						$numrapport=$db->prepare('SELECT * FROM ppe_rapport_visite WHERE VIS_MATRICULE = :matricule ORDER BY RAP_NUM ASC');
						$numrapport->bindValue(':matricule',$_SESSION['login'], PDO::PARAM_STR);
						$numrapport->execute();
						// $reponse = $db->query('SELECT * FROM ppe_rapport_visite where  ORDER BY VIS_MATRICULE ASC');
						while ($numrapports = $numrapport->fetch()) {
							$numerorapport = $numrapports['RAP_NUM']+1;
						}
						$numrapport->closeCursor();
					?>
			  		<input type="text" name="num" class="form-control" value="<?php echo $numerorapport ?>" aria-describedby="basic-addon1" disabled>
						<input type="hidden" name="num" value="<?php echo $numerorapport ?>">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Motif</span>
		  <?php
		  if ($_SESSION['grade']<10) {
		  		?><input type="text" name="motif" class="form-control" value="<?php echo $data['RAP_MOTIF']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?><input type="text" name="motif" class="form-control" value="<?php echo $data['RAP_MOTIF']; ?>" aria-describedby="basic-addon1"><?php
			  	}else{
					?>
			  		<input type="text" name="motif" class="form-control" placeholder="Motif" aria-describedby="basic-addon1">
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Praticien</span>
		  <?php
			$praticiens = $db->query('SELECT * FROM ppe_praticien ORDER BY PRA_NUM');
		  if ($_SESSION['grade']<10) {
		  		?><input type="text" name="numpraticien" class="form-control" value="<?php echo $data['PRA_NUM']; ?>" aria-describedby="basic-addon1" disabled><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?>
						<!-- <input type="text" name="numpraticien" class="form-control" value="<?php echo $data['PRA_NUM']; ?>" aria-describedby="basic-addon1"> -->
						<select name="numpraticien" class="form-control">
							<?php
							while ($optionpraticiens = $praticiens->fetch()) {
								if ($optionpraticiens['PRA_NUM']==$data['PRA_NUM']) {
									?>
									<option selected value="<?php echo $optionpraticiens['PRA_NUM']; ?>"><?php echo $optionpraticiens['PRA_NUM']." ".$optionpraticiens['PRA_NOM']." ".$optionpraticiens['PRA_PRENOM']; ?></option>
									<?php
								}else{
									?>
							  	<option value="<?php echo $optionpraticiens['PRA_NUM']; ?>"><?php echo $optionpraticiens['PRA_NUM']." ".$optionpraticiens['PRA_NOM']." ".$optionpraticiens['PRA_PRENOM']; ?></option>
									<?php
								}
							}
							$praticiens->closeCursor();
							?>
						</select>
						<?php
			  	}else{
					?>
			  		<!-- <input type="text" name="numpraticien" class="form-control" placeholder="numéro" aria-describedby="basic-addon1"> -->
						<select name="numpraticien" class="form-control">
							<?php
							while ($optionpraticiens = $praticiens->fetch()) {
								?>
						  	<option value="<?php echo $optionpraticiens['PRA_NUM']; ?>"><?php echo $optionpraticiens['PRA_NUM']." ".$optionpraticiens['PRA_NOM']." ".$optionpraticiens['PRA_PRENOM']; ?></option>
								<?php
							}
							$praticiens->closeCursor();
							?>
						</select>
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Bilan :</span>
		  <?php
		  if ($_SESSION['grade']<10) {
		  		?><textarea type="text" name="bilan" class="form-control" value="<?php echo $data['RAP_BILAN']; ?>" aria-describedby="basic-addon1" disabled><?php echo $data['RAP_BILAN']; ?></textarea><?php
		  	}else{
			  	if (isset($_GET['rapport'])) {
			  		?><textarea type="text" name="bilan" class="form-control" value="<?php echo $data['RAP_BILAN']; ?>" aria-describedby="basic-addon1"><?php echo $data['RAP_BILAN']; ?></textarea><?php
			  	}else{
					?>
			  		<textarea type="text" name="bilan" class="form-control" placeholder="Bilan" aria-describedby="basic-addon1"></textarea>
			  		<?php
				}
			}
		  ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<?php
	if (isset($_GET['rapport'])) {
	?>
		<input type="submit" value="sauvegarder" class="btn btn-primary"/>
	<?php
	}else{
	 ?>
	 <input type="submit" value="créer" class="btn btn-primary"/>
	 <?php
	 }
	  ?>
	</div>
</form>

<?php
include '../../inc/footer.php';
?>
