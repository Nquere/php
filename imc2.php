<?php
	require_once 'lib.php';
	$nom ='';
	$taille = '';
	$masse ='';
	$imc = false;

	$tabErreurs = array();

	if (isset($_GET['nom']))
		$nom = $_GET['nom'];
	if (isset($_GET['taille']))
		$taille = $_GET['taille'];
	if (isset($_GET['masse']))
		$masse = $_GET['masse'];

	if ($nom == '')
		$tabErreurs['nom'];
	if ($taille <= 100)
		$tabErreurs['taille'];
	if ($masse <= 30)
		$tabErreurs['masse'];

	if (count($tabErreurs) == 0)
		$imc = calculIMC($taille, $masse);
?>


<html>
<head>
	<title>IMC2</title>
</head>
<body>

	<fieldset>
		<legend>Calculez votre IMC</legend>
		<form>
			<p><label for="nom">Votre nom : </label><input id="nom" name="nom" value="<?php echo $nom; ?>" type="text"><?php afficheErreur() ?></p>
			<p><label for="taille">Votre taille : </label><input id="taille" name="taille" value="<?php echo $taille; ?>" type="text"></p>
			<p><label for="masse">Votre masse : </label><input id="masse" name="masse" value="<?php echo $masse; ?>" type="text"></p>
			<p><input type ="submit" value="OK"></p>
		</form>
	</fieldset>

	<p>
		<?php 
		if ($imc)
			echo "Votre IMC est : ".$imc;
		?>
	</p>


	<table>
		<?php>
			$tailleMax = 240;
			$tailleMin = 130;
			$masseMax = 160;
			$masseMin = 35;
			$incT = 5;
			$incM = 2;

			for ($taille=$tailleMax; $taille >= $tailleMin ; $taille-=$incT) { 
				echo '<tr>';
				for ($masse=$masseMin; $masse <= $masseMax ; $masse+=$incM) { 
					$imc = calculIMC($taille, $masse);
					echo '<td>'.$imc.'</td>';
				}
				echo '</tr>';
			}
		?>
	</table>
</body>
</html>

<?php

function afficheErreur($tabErreurs, $champ) {

}
?>