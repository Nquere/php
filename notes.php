<?php
	session_start();
	if (!isset($_SESSION['tabNotes']))
		$_SESSION['tabNotes'] = array();

	if (isset($_GET['nom'])) {
		$nom = $_GET['nom'];
		$notes = $_GET['note'];
		$_SESSION['tabNotes'][$nom][] = $notes;
	}
?>

<html>
<head>
	<title></title>
</head>
<body>
	<form method="get" action="notes.php">
		<p>Nom: <input type="text" name="nom"/></p>
		<p>Note: <input type="text" name="note"/></p>
		<p><input type="submit" value="OK"/></p>
	</form>

	<ul>
		<?php
			foreach ($_SESSION['tabNotes'] as $nomEtudiant => $tabNotesEtudiant) {
				echo '<li>';
				echo $nomEtudiant.' : moyenne=';
				$moy = moyenne($tabNotesEtudiant);
				if ($moy !== false)
					echo $moy;
				else
					echo " pas de notes";
			}
		?>
	</ul>

	<pre>
		<?php
			print_r($_SESSION);
		?>
	</pre>
</body>
</html>

<?php

	function moyenne(&$tab){
		$somme = 0;
		$nb = count($tab);
		if ($nb == 0)
			return false;
		for ($i=0; $i < $nb; $i++) { 
			$somme += $tab[$i];
		}
		return $somme/$nb;
	}


?>