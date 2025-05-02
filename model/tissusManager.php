<?php
	class Tissus {
		private $n_tissus;
		private $nom_tissus;
		private $ID_matiere;
		private $url_tissus;
		private $id_categorie;

		public function n_tissus() {return $this->n_tissus;}
		public function nom_tissus() {return $this->nom_tissus;}
		public function ID_matiere() {return $this->ID_matiere;}
		public function url_tissus() {return $this->url_tissus;}
		public function id_categorie() {return $this->id_categorie;}

		public function setN_tissus($valeur) {
			$this->n_tissus = $valeur;
		}
		public function setNom_tissus($valeur) {
			$this->nom_tissus = $valeur;
		}
		public function setID_matiere($valeur) {
			$this->ID_matiere = $valeur;
		}
		public function setUrl_tissus($valeur) {
			$this->url_tissus = $valeur;
		}
		public function setId_categorie($valeur) {
			$this->id_categorie = $valeur;
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

	class TissusManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Tissus $tissus) {
			$new_tissus = $this->bdd->prepare('INSERT INTO tissus(nom_tissus, ID_matiere, url_tissus, id_categorie) VALUES (:nom, :id, :url_tissus, :id_categorie)');
			$new_tissus->bindValue(':nom', $tissus->nom_tissus());
			$new_tissus->bindValue(':id', $tissus->ID_matiere());
			$new_tissus->bindValue(':url_tissus', $tissus->url_tissus());
			$new_tissus->bindValue(':id_categorie', $tissus->id_categorie());
			$new_tissus->execute();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM tissus');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getNomParNum($num) {
			$req = $this->bdd->prepare('SELECT nom_tissus FROM tissus WHERE n_tissus = :n_tissus');
			$req->bindValue(':n_tissus', $num);
			$req->execute();
			return $req->fetch(PDO::FETCH_COLUMN);
		}

		public function getAllParid($id_categorie) {
			$req = $this->bdd->prepare('SELECT * FROM tissus WHERE id_categorie = :id_categorie');
			$req->bindValue(':id_categorie', $id_categorie);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Tissus $tissus, $num) {
			$req = $this->bdd->prepare('UPDATE tissus SET nom_tissus = :nom, ID_matiere = :id , url_tissus = :url_tissus, id_categorie = :id_categorie WHERE n_tissus = :num');
			
			$req->bindValue(':num', $num);
			$req->bindValue(':nom', $tissus->nom_tissus());
			$req->bindValue(':id', $tissus->ID_matiere());
			$req->bindValue(':url_tissus', $tissus->url_tissus());
			$req->bindValue(':id_categorie', $tissus->id_categorie());

			$req->execute();
		}

		public function delete($num) {
			$req = $this->bdd->prepare('DELETE FROM tissus WHERE n_tissus = :num');

			$req->bindValue(':num', $num);
			$req->execute();
		}
	}
?>