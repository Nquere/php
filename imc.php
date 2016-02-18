<?php
	require_once "lib.php";
	$myimc = false;
	$mytaille = '';
	$mymasse = '';
	if (isset($_GET['masse']))
	{
		$mymasse = $_GET['masse'];
		$mytaille = $_GET['taille'];
		$myimc = imc($mymasse, $mytaille);
	}
?>
<html>
<head>
	<title>IMC</title>
</head>
<body>
	<form action="imc.php" method="get">
		<p> Masse : <input name="masse" value="<?php echo $mymasse; ?>" placeholder="en kg"></p>
		<!-- <p> Masse : <input type="text" name="masse" placeholder="en kg"></p> -->
		<p> Taille : <input name="taille" value ="<?php echo $mytaille; ?>" placeholder="en mètre"></p>
		<!-- <p> Taille : <input type="text" name="taille" placeholder="en mètre"></p> -->
		<p><input type="submit" value="ok"></p>
	</form>
	<?php
		echo "Votre IMC = $myimc";
	?>

	<table border="1">
		<?php
			echo '<th style="background: grey">T/M</th>';
			for ($masse=30; $masse < 150; $masse+=2) {
				echo '<th style="background: grey">'.$masse.'</th>';
			}
			echo '<tr>';
			for ($taille=2.1; $taille >= 1.40; $taille-=0.02) {
				$temp = $taille *100;
				echo '<th style="background: grey">'.$temp.'</th>';
				for ($masse=30; $masse < 150; $masse+=2)
				{
					$imc = round(imc($masse,$taille), 0);
					$color = '#000000';
					if (($masse <= $mymasse) && ($masse+2 > $mymasse))
						$couleur = '#FFFFFF';
					else if (($imc < 17) || ($imc > 35.5 && $imc < 40.5))
						$couleur ='#FF0000';
					else if (($imc >= 17 && $imc < 18.5) || ($imc >= 30.5 && $imc < 35.5))
						$couleur = '#FFA500';
					else if ($imc >= 18.5 && $imc < 25.5)
						$couleur = '#00FF00';
					else if ($imc >= 25.5 && $imc < 30.5)
						$couleur = '#FF8000';
					else
					{
						$couleur = '#000000';
						$color = '#FFFFFF';
					}

					echo '<td style="background:'.$couleur.';color: '.$color.'">'.$imc.'</td>';
				}
					
				echo '</tr>';
			}
		?>
	</table>
</body>
</html>
