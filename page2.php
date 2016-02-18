<!-- 
<html>
<head>
	<title>Exercice</title>
</head>
<body>
	<form method="get" action="page2.php">
		<p>Nom: <input type="text" name="nom"/></p>
		<p>Note: <input type="text" name="note"/></p>
		<p><input type="submit" value="OK"/></p>

	</form>


</body>
</html>

<?php

	// $nom = '';
	// $note = 0;
	// $cmp = 0;
	// $moyenne = 0;
	// if (isset($_GET['nom']))
	// {
	// 	$nom = $_GET['nom'];
	// 	$note = $_GET['note'];
	// }
	// echo $nom;
	// echo $note;
	// session_start();
	// $_SESSION['tablenom'][$nom][] = $note;
	// foreach ($_SESSION['tablenom'][$nom] as $key => $val) {
	//  	$somme += $val;
	// }
	// echo $somme;

	?>
<pre><?php	//print_r($_SESSION); ?> </pre>

 -->

<?php

session_start();
if (!isset($_SESSION['tabNotes']))
  $_SESSION['tabNotes'] = array();

if (isset($_GET['nom'])){
  $nom = $_GET['nom'];
  $note = $_GET['note'];
  $_SESSION['tabNotes'][$nom][] = $note;
}


?>
<html>
<head>
</head>
<body>
  <form action="notes.php" method="get">
    <p>Etudiant : <input type="text" name="nom" /></p>
    <p>Note : <input type="text" name="note" /></p>
    <p><input type="submit"value="ok" /></p>
  </form>
  
  <ul>
    <?php
      foreach ($_SESSION['tabNotes'] as $nomEtudiant => $tabNotesEtudiant){
        echo '<li>';
          echo $nomEtudiant.' : moyenne=';
          $moy = moyenne($tabNotesEtudiant); 
          if ($moy !== false)
            echo $moy;
          else
            echo " pas de notes";
        echo '</li>';
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
    for ($i=0; $i<$nb; $i++){
      $somme += $tab[$i];
    }
    return $somme / $nb;
  }
?>

