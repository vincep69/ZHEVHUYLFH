<?php session_start();
/*-------------------------------------------------------local----------------------------------------------------*/
/*try {
 	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
 	$bdd = new PDO ("mysql:host=localhost;dbname=ecole","root","", $pdo_options);
} catch (Exception $e) {
 	die('Erreur : '.$e->getMessage());
}*/
/*-------------------------------------------------------ftp----------------------------------------------------*/
try{
		$db=new PDO('mysql:host=localhost; dbname=stephan', 'root', '', array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);
	}
catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}
 ?>