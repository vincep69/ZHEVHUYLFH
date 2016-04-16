<?php
include '../../inc/header.php';
include '../../inc/menu.php';
$reponse = $db->query('SELECT * FROM ppe_visiteur ORDER BY VIS_MATRICULE ASC');
?>

<table class="table">
	<thead>
		<th>
			Matricule
		</th>
		<th>
			Nom
		</th>
		<th>
			Prénom
		</th>
		<th>
			Ville
		</th>
	</thead>
	<tbody>
	<?php
	while ($donnees = $reponse->fetch()) {
		?>
		
			<tr>
				<td><a href="/ZHEVHUYLFH/pages/profil/profil_upd.php?matricule=<?php echo $donnees['VIS_MATRICULE'] ?>">
					<?php echo $donnees['VIS_MATRICULE'] ?></a>
				</td>
				<td>
					<?php echo $donnees['VIS_NOM'] ?>
				</td>
				<td>
					<?php echo $donnees['VIS_PRENOM'] ?>
				</td>
				<td>
					<?php echo $donnees['VIS_VILLE'] ?>
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