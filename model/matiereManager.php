<?php
	class Matiere {
		private $ID_matiere;
		private $type_matiere;


		public function ID_matiere() {return $this->ID_matiere;}
		public function type_matiere() {return $this->type_matiere;}

		public function setID_matiere($id) {
			$this->ID_matiere = (int)$id;
		}
		public function setType_matiere($valeur) {
			$this->type_matiere = $valeur;
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

	class MatiereManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Matiere $matiere) {
			$new_matiere = $this->bdd->prepare('INSERT INTO matiere(type_matiere) VALUES (:type_matiere)');
			$new_matiere->bindValue(':type_matiere', $matiere->type_matiere());
			$new_matiere->execute();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM matiere');
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Matiere $matiere, $id) {
			$req = $this->bdd->prepare('UPDATE matiere SET type_matiere = :type_matiere WHERE ID_matiere = :id');
			$req->bindValue(':id', $id);
			$req->bindValue(':type_matiere', $matiere->type_matiere());
			$req->execute();
		}

		public function delete($id) {
			$req = $this->bdd->prepare('DELETE FROM matiere WHERE ID_matiere = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
	}
?>