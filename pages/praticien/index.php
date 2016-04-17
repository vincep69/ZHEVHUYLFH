<?php
include '../../inc/header.php';
include '../../inc/menu.php';
$reponse = $db->query('SELECT * FROM ppe_praticien ORDER BY PRA_NUM ASC');
?>

<table class="table">
	<thead>
		<th>
			Numéro
		</th>
		<th>
			Nom
		</th>
		<th>
			Prénom
		</th>
		<th>
			Adresse
		</th>
		<th>
			Code postal
		</th>
		<th>
			Ville
		</th>
		<th>
			Coefficient notoriété
		</th>
		<th>
			Type code
		</th>
	</thead>
	<tbody>
	<?php
	while ($donnees = $reponse->fetch()) {
		?>
		
			<tr>
				<td><a href="/ZHEVHUYLFH/pages/praticien/praticien_upd.php?numero=<?php echo $donnees['PRA_NUM'] ?>">
					<?php echo $donnees['PRA_NUM'] ?></a>
				</td>
				<td>
					<?php echo $donnees['PRA_NOM'] ?>
				</td>
				<td>
					<?php echo $donnees['PRA_PRENOM'] ?>
				</td>
				<td>
					<?php echo $donnees['PRA_ADRESSE'] ?>
				</td>
				<td>
					<?php echo $donnees['PRA_CP'] ?>
				</td>
				<td>
					<?php echo $donnees['PRA_VILLE'] ?>
				</td>
				<td>
					<?php echo $donnees['PRA_COEFNOTORIETE'] ?>
				</td>
				<td>
					<?php echo $donnees['TYP_CODE'] ?>
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