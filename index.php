<?php
include 'inc/header.php';
?>
<h1>
	Connexion
</h1>
<?php
if (!isset($_POST['login']))
{
	?>
	<form class="connexion" method="post" action="index.php">
	<p>
	<input name="login" type="text" id="pseudo" placeholder="Login" /><br />
	<input type="password" name="password" id="password" placeholder="Password" />
	</p>
	<p><input class="valid" type="submit" value="Connexion" /></p></form>
	<?php
}
else
{
	$message='';
	if (empty($_POST['login']) || empty($_POST['password']) )
	{
		$message = '<p>une erreur s\'est produite pendant votre identification.
		Vous devez remplir tous les champs.</p>
		<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
	}
	else //Check mdp
	{
		$query=$db->prepare('SELECT VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_PASSWORD, VIS_GRADE
		FROM ppe_visiteur WHERE VIS_MATRICULE = :login');
		$query->bindValue(':login',$_POST['login'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();
		if ($data['VIS_PASSWORD'] == md5($_POST['password'])) // Acces OK !
		{
			$_SESSION['login'] = $data['VIS_MATRICULE'];
			$_SESSION['grade'] = $data['VIS_GRADE'];
			$_SESSION['id'] = $data['VIS_MATRICULE'];
			$message = '<p>Bienvenue '.$data['VIS_PRENOM'].' '.$data['VIS_NOM'].', 
				vous êtes maintenant connecté!</p>';
			/*header('Location: index.php');*/
		}
		else // Acces pas OK !
		{
			$message = '<p>Une erreur s\'est produite 
			pendant votre identification.<br /> Le mot de passe ou le pseudo 
			    entré n\'est pas correct.</p>';
		}
		$query->CloseCursor();
	}
	echo $message.'</div></body></html>';
}
?>
<?php
include 'inc/footer.php';
?>