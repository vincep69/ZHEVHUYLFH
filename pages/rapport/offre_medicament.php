<?php
include '../../inc/header.php';
include '../../inc/menu.php';
if (isset($_GET['rapport'])) {
	$query=$db->prepare('SELECT * FROM ppe_offrir WHERE RAP_NUM = :rapport AND VIS_MATRICULE = :matricule');
		$query->bindValue(':rapport',$_GET['rapport'], PDO::PARAM_STR);
		$query->bindValue(':matricule',$_GET['mat'], PDO::PARAM_STR);
		$query->execute();
		?>
		<h1>Offres de médicaments</h1>
		<table class="table">
			<thead>
		    <th>
					Matricule visiteur
				</th>
		    <th>
					Numéro de rapport
				</th>
		    <th>
					medicament
				</th>
				<th>
					quantité
				</th>

			</thead>
			<tbody>
			<?php
			while ($donnees = $query->fetch()) {
				?>

					<tr>
		        <td>
							<?php echo $donnees['VIS_MATRICULE'] ?>
						</td>
						<td><a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php?rapport=<?php echo $donnees['RAP_NUM'] ?>&mat=<?php echo $donnees['VIS_MATRICULE'] ?>">
							<?php echo $donnees['RAP_NUM'] ?></a>
						</td>
						<td>
							<?php echo $donnees['MED_DEPOTLEGAL'] ?>
						</td>
						<td>
							<?php echo $donnees['OFF_QTE'] ?>
						</td>
					</tr>

				<?php
				}
				$query->closeCursor();
				?>
			</tbody>
		</table>
		<?php
}
if (isset($_POST['num'])) {
		if (isset($_POST['modif'])) {
			if ($_POST['modif']==1) {
        $i=0;
  			$error="";
  			$num = $_POST['num'];
  			if (!empty($_POST['matricule'])) {
  				$matricule = $_POST['matricule'];
  			}else {
  				$i++;
  				$error.="matricule non renseigné ";
  			}
  			if (!empty($_POST['motif'])) {
  				$motif = $_POST['motif'];
  			}else {
  				$i++;
  				$error.="motif non renseigné ";
  			}
  			if (!empty($_POST['bilan'])) {
  				$bilan = $_POST['bilan'];
  			}else {
  				$i++;
  				$error.="bilan non renseigné ";
  			}
  			if (!empty($_POST['numpraticien'])) {
  				$numpraticien = $_POST['numpraticien'];
  			}else {
  				$i++;
  				$error.="praticien non renseigné ";
  			}
  			if ($i==0) {
  				$query=$db->prepare('UPDATE ppe_rapport_visite
  					SET VIS_MATRICULE = :matricule,
  					RAP_NUM = :num,
  					RAP_MOTIF = :motif,
  					PRA_NUM = :numpraticien,
  					RAP_BILAN = :bilan,
  					WHERE RAP_NUM = :num');
    				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    				$query->bindValue(':num', $num, PDO::PARAM_STR);
    				$query->bindValue(':motif', $motif, PDO::PARAM_STR);
    				$query->bindValue(':numpraticien', $numpraticien, PDO::PARAM_STR);
    				$query->bindValue(':bilan', $bilan, PDO::PARAM_STR);
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
				$error.="numero non renseigné ";
			}
			if (!empty($_POST['med'])) {
				$med = $_POST['med'];
			}else {
				$i++;
				$error.="med non renseigné ";
			}
			if (!empty($_POST['qte'])) {
				$qte = $_POST['qte'];
			}else {
				$i++;
				$error.="quantité non renseignée ";
			}
			if ($i==0) {
				$query=$db->prepare('INSERT INTO ppe_offrir (VIS_MATRICULE, RAP_NUM, MED_DEPOTLEGAL, OFF_QTE)
				VALUES (:matricule, :num, :med, :qte)');
				$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
				$query->bindValue(':num', $num, PDO::PARAM_STR);
				$query->bindValue(':med', $med, PDO::PARAM_STR);
				$query->bindValue(':qte', $qte, PDO::PARAM_STR);
				$query->execute();
				$query->CloseCursor();
			}else{
				echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
			}
		}

}
/*echo $data['VIS_NOM'];*/
?>

<form method="post" action="offre_medicament.php?rapport=<?php echo $_GET['rapport'] ?>&mat=<?php echo $_GET['mat'] ?>">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Matricule :</span>
				<input type="text" name="matricule" class="form-control" value="<?php echo $_GET['mat']; ?>" aria-describedby="basic-addon1" disabled>
				<input type="hidden" name="matricule" value="<?php echo $_GET['mat']; ?>">
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Numéro de rapport :</span>
				<input type="text" name="num" class="form-control" value="<?php echo $_GET['rapport'] ?>" aria-describedby="basic-addon1" disabled>
				<input type="hidden" name="num" value="<?php echo $_GET['rapport'] ?>">
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">médicament</span>
			<select name="med" class="form-control">
		    <?php
				$medics = $db->query('SELECT * FROM ppe_medicament ORDER BY MED_DEPOTLEGAL');
		    while ($optionmedics = $medics->fetch()) {
		      ?>
		      <option value="<?php echo $optionmedics['MED_DEPOTLEGAL']; ?>"><?php echo $optionmedics['MED_DEPOTLEGAL']." ".$optionmedics['MED_NOMCOMMERCIAL']; ?></option>
		      <?php
		    }
		    $medics->closeCursor();
		    ?>
		  </select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">quantité</span>
			<input type="number" name="qte" class="form-control" aria-describedby="basic-addon1">
		</div>
	</div>
	<input type="submit" value="ajouter" class="btn btn-primary"/>
</form>
<?php
include '../../inc/footer.php';
?>
