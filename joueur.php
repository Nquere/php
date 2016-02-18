<?php
define("DB_DRIVER", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "coursPHP");
define("DB_USERNAME", "root");//identifiant pour se connecter a la base de donnée, rien a voir avec autre username
define("DB_PASSWORD", "");

function connexionSQL(){
	try {
		$cnxbdd = new PDO (DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
		return $cnxbdd;
	}

	catch (PDOException $e){
		die('Erreur de connexion :'. $e->getMessage());
	}
}
class Joueur {
	private $cnxbdd = null;
	private $pseudo = '';
	private $score = 0;

	public function __construct(&$cnxbdd, $pseudo) {
		$this->cnxbdd = $cnxbdd;


		$requete = "SELECT * from joueurs where pseudo=:pseudo";
		$stmtPDO = $this->cnxbdd->prepare($requete);
		$stmtPDO->bindValue(':pseudo', $pseudo);

		if ($stmtPDO->execute()) {
			if ($stmtPDO->rowCount() == 1) {
				$row = $stmtPDO->fetch(PDO::FETCH_ASSOC);
				$this->pseudo = $row['pseudo'];
				$this->score = $row['score'];
			}
		}
		else {
			$message = print_r($stmtPDO->errorInfo(),True);
			throw new Exception($message);	
		}
	}
	public function __get($prop) {
		switch ($prop) {
			case 'pseudo':
			case 'score':
				return $this->$prop;
				break;
			default:
				echo "Lecture propriété $prop impossible";
				break;
		}
	}
	public function __set($prop, $val) {
		switch ($prop) {
			case 'score':
				if (is_numeric($val) && ($val > 0)) {
					$this->score = $val;
					$requete1 = "UPDATE joueurs set score=:score where pseudo=:pseudo";
					$stmtPDO1 = $this->cnxbdd->prepare($requete1);
					$stmtPDO1->bindValue(':pseudo', $this->pseudo);
					$stmtPDO1->bindValue(':score', $val);

					if (!$stmtPDO1->execute()) {
						$message = print_r($stmtPDO1->errorInfo(),True);
						throw new Exception($message);
					}
				}
				break;
			
			default:
				echo "Modif propriété $prop interdite";
				break;
		}
	}
}
?>


<?php
	$pseudo = '';
	$score = 0;
	if (isset($_GET['pseudo'])) {
		$pseudo = $_GET['pseudo'];
		$score = $_GET['score'];
		$cnx = connexionSQL();
		$joueur = new Joueur($cnx, $pseudo);
		$joueur->score = $score;
		echo $joueur->pseudo." : ".$joueur->score;
	}
?>
<html>
<head>
	<title>Joueur</title>
</head>
<body>
	<form>
		<p>Nom : <input type="text" name="pseudo"/></p>
		<p>Score : <input type="text" name="score"/></p>
		<p><input type="submit" value="afficher"/></p>
	</form>
</body>
</html>