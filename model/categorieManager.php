<?php
	class Categorie {
		private $id_categorie;
		private $nom_categorie;

		public function id_categorie() {return $this->id_categorie;}
		public function nom_categorie() {return $this->nom_categorie;}

		public function setid_categorie($valeur) {
			$this->id_categorie = (int)$valeur;
		}
		public function setnom_categorie($valeur) {
			$this->nom_categorie = $valeur;
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

	class CategorieManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Categorie $categorie) {
			$new_categorie = $this->bdd->prepare('INSERT INTO categorie(nom_categorie) VALUES (:nom_categorie)');

			$new_categorie->bindValue(':nom_categorie', $categorie->nom_categorie());

			$new_categorie->execute();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM categorie');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAllCategorie() {
			$req = $this->bdd->query('SELECT nom_categorie FROM categorie');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_COLUMN);
		}

		public function update(categorie $categorie, $id) {
			$req = $this->bdd->prepare('UPDATE categorie SET nom_categorie = :nom_categorie WHERE id_categorie = :id');
			
			$req->bindValue(':id', $id);
			$req->bindValue(':nom_categorie', $categorie->nom_categorie());

			$req->execute();
		}

		public function delete($id_categorie) {
			$req = $this->bdd->prepare('DELETE FROM categorie WHERE id_categorie = :id_categorie');

			$req->bindValue(':id_categorie', $id_categorie);
			$req->execute();
		}
	}
?>