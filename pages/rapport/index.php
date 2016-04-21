<?php
include '../../inc/header.php';
include '../../inc/menu.php';
$reponse = $db->query('SELECT * FROM ppe_rapport_visite ORDER BY VIS_MATRICULE ASC');
?>

<table class="table">
	<thead>
    <th>
			Numéro de rapport
		</th>
		<th>
			Matricule visiteur
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
				<td><a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php?rapport=<?php echo $donnees['RAP_NUM'] ?>">
					<?php echo $donnees['RAP_NUM'] ?></a>
				</td>
				<td>
					<?php echo $donnees['VIS_MATRICULE'] ?>
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
