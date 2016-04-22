<?php
include '../../inc/header.php';
include '../../inc/menu.php';
$reponse = $db->query('SELECT * FROM ppe_medicament ORDER BY MED_DEPOTLEGAL ASC');
?>
<table class="table">
	<thead>
		<th>
			Depot légal
		</th>
		<th>
			Nom
		</th>
		<th>
			Code
		</th>
		<th>
			Composition
		</th>
		<th>
			Effets
		</th>
		<th>
			Contre-indication
		</th>
	</thead>
	<tbody>
	<?php
	while ($donnees = $reponse->fetch()) {
		?>
		
			<tr>
				<td><a href="/ZHEVHUYLFH/pages/medicament/medicament_upd.php?depotlegal=<?php echo $donnees['MED_DEPOTLEGAL'] ?>">
					<?php echo $donnees['MED_DEPOTLEGAL'] ?></a>
				</td>
				<td>
					<?php echo $donnees['MED_NOMCOMMERCIAL'] ?>
				</td>
				<td>
					<?php echo $donnees['FAM_CODE'] ?>
				</td>
				<td>
					<?php echo $donnees['MED_COMPOSITION'] ?>
				</td>
				<td>
					<?php echo $donnees['MED_EFFETS'] ?>
				</td>
				<td>
					<?php echo $donnees['MED_CONTREINDIC'] ?>
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