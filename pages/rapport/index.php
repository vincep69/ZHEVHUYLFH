<?php
include '../../inc/header.php';
include '../../inc/menu.php';

$visiteurs = $db->query('SELECT * FROM ppe_visiteur ORDER BY VIS_MATRICULE');
?>
<form method="get" action="index.php">
  <select name="matvis" class="form-control">
    <?php
    while ($optionvisiteurs = $visiteurs->fetch()) {
      ?>
      <option value="<?php echo $optionvisiteurs['VIS_MATRICULE']; ?>"><?php echo $optionvisiteurs['VIS_MATRICULE']." ".$optionvisiteurs['VIS_NOM']." ".$optionvisiteurs['VIS_PRENOM']; ?></option>
      <?php
    }
    $visiteurs->closeCursor();
    ?>
  </select>
  <input type="submit" value="rechercher" class="btn btn-primary"/>
</form>
<a href="/ZHEVHUYLFH/pages/rapport/"class="btn btn-danger">effacer la recherche</a>
<?php
if (isset($_GET['matvis'])) {
  $reponse=$db->prepare('SELECT * FROM ppe_rapport_visite WHERE VIS_MATRICULE = :matricule');
  $reponse->bindValue(':matricule',$_GET['matvis'], PDO::PARAM_STR);
  $reponse->execute();
}else {
  $reponse = $db->query('SELECT * FROM ppe_rapport_visite ORDER BY VIS_MATRICULE ASC');
}

?>

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
				<td><a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php?rapport=<?php echo $donnees['RAP_NUM'] ?>">
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
include '../../inc/footer.php';
?>
