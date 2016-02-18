<?php
	// if (isset($_GET['masse']) && isset($_GET['taille']))
	// 	echo imc($_GET['masse'], $_GET['taille']);
	function imc($masse,$taille)
	{
		if ($taille > 0)
		{
			$res = $masse / pow($taille,2);
			return $res;
		}
		else
			return 0;
	}
?>


<!-- function calculIMC($taille, $masse) {
	$taille = $taille / 100;
	if ($taille == 0)
		throw new Exception(_FUNCTION_." : Taille incorrecte [$taille]");
	return round($masse / ($taille * $taille), 1);
} -->