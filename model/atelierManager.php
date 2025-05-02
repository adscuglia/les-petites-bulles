<?php
	class Atelier {
		private $n_atelier;
		private $Date_atelier;
		private $nb_participant_max;
		private $nom_atelier;

		public function n_atelier() {return $this->n_atelier;}
		public function Date_atelier() {return $this->Date_atelier;}
		public function nb_participant_max() {return $this->nb_participant_max;}
		public function nom_atelier() {return $this->nom_atelier;}

		public function setN_atelier($valeur) {
			$this->n_atelier = (int)$valeur;
		}
		public function setDate_atelier($valeur) {
			$this->Date_atelier = $valeur;
		}
		public function setNb_participant_max($valeur) {
			$this->nb_participant_max = $valeur;
		}
		public function setNom_atelier($valeur) {
			$this->nom_atelier = $valeur;
		}

		public function hydrate(array $donnees) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if(method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
	}

	class AtelierManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Atelier $atelier) {
			$new_atelier = $this->bdd->prepare('INSERT INTO atelier(Date_atelier, nb_participant_max, nom_atelier) VALUES (:date_atelier, :nbr_max, :nom)');

			$new_atelier->bindValue(':date_atelier', $atelier->Date_atelier());
			$new_atelier->bindValue(':nbr_max', $atelier->nb_participant_max());
			$new_atelier->bindValue(':nom', $atelier->nom_atelier());

			$new_atelier->execute();
		}

		public function getAllAnnees() {
			$req = $this->bdd->query('SELECT DISTINCT YEAR(Date_atelier) FROM atelier WHERE YEAR(Date_atelier) != 0001 ORDER BY YEAR(Date_atelier) DESC');
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAllNomParAnnee($annee) {
			$req = $this->bdd->prepare('SELECT nom_atelier, n_atelier FROM atelier WHERE YEAR(Date_atelier) = :annee');
			$req->execute([':annee' => $annee]);
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getN_atelierAvecDate($date) {
			$req = $this->bdd->prepare('SELECT n_atelier FROM atelier WHERE Date_atelier = ? LIMIT 1');
			$req->execute([$date]);
			return $req->fetchColumn();
		}
		public function getDateAvecN_atelier($num) {
			$req = $this->bdd->prepare('SELECT Date_atelier FROM atelier WHERE n_Atelier = ? LIMIT 1');
			$req->execute([$num]);
			return $req->fetchColumn();
		}

		public function getImageParDate($date) {
			$req = $this->bdd->query('SELECT * FROM atelier WHERE Date_atelier ='.$date);
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM atelier ORDER BY Date_atelier DESC');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function clientInscrisNumAtelier($num) {
			$req = $this->bdd->prepare('SELECT c.*, i.nbr_inscription FROM atelier AS a LEFT JOIN inscrire i ON a.n_Atelier = i.n_Atelier LEFT JOIN client c ON i.ID_client = c.ID_client WHERE a.n_Atelier = :num ORDER BY a.Date_atelier DESC');
			$req->bindValue(':num', $num);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function nbrInscris($num) {
			$req = $this->bdd->prepare('SELECT SUM(nbr_inscription) AS total FROM inscrire WHERE n_atelier = :num');
			$req->bindValue(':num', $num);
			$req->execute();
			return $req->fetchColumn();
		}

		public function placeRestante($num) {
			$req = $this->bdd->prepare('SELECT a.nb_participant_max - IFNULL(SUM(i.nbr_inscription), 0) AS places FROM atelier a LEFT JOIN inscrire i ON a.n_Atelier = i.n_Atelier WHERE a.n_Atelier = :num');
			$req->bindValue(':num', $num);
			$req->execute();
			return $req->fetch();
		}

		public function getAteliersFuture() {
			$req = $this->bdd->prepare("SELECT * FROM atelier WHERE Date_atelier >= CURDATE() ORDER BY Date_atelier ASC");
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Atelier $atelier, $num) {
			$req = $this->bdd->prepare('UPDATE atelier SET Date_atelier = :date_atelier, nb_participant_max = :nbr, nom_atelier = :nom WHERE n_atelier = :num');
			
			$req->bindValue(':num', $num);
			$req->bindValue(':date_atelier', $atelier->Date_atelier());
			$req->bindValue(':nbr', $atelier->nb_participant_max());
			$req->bindValue(':nom', $atelier->nom_atelier());

			$req->execute();
		}

		public function delete($n_atelier) {
			$req = $this->bdd->prepare('DELETE FROM atelier WHERE n_atelier = :n_atelier');

			$req->bindValue(':n_atelier', $n_atelier);
			$req->execute();
		}
	}
?>