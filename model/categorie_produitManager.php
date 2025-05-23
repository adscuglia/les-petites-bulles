<?php
	class Categorie_produit {
		private $id_categorie_produit;
		private $nom_categorie_produit;

		public function id_categorie_produit() {return $this->id_categorie_produit;}
		public function nom_categorie_produit() {return $this->nom_categorie_produit;}

		public function setid_categorie_produit($valeur) {
			$this->id_categorie_produit = (int)$valeur;
		}
		public function setnom_categorie_produit($valeur) {
			$this->nom_categorie_produit = $valeur;
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

	class Categorie_produitManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Categorie_produit $categorie) {
			$new_categorie = $this->bdd->prepare('INSERT INTO categorie_produit(nom_categorie_produit) VALUES (:nom_categorie_produit)');

			$new_categorie->bindValue(':nom_categorie_produit', $categorie->nom_categorie_produit());

			$new_categorie->execute();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM categorie_produit');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAllCategorie() {
			$req = $this->bdd->query('SELECT id_categorie_produit, nom_categorie_produit FROM categorie_produit');
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}


		public function update(categorie $categorie, $id) {
			$req = $this->bdd->prepare('UPDATE categorie_produit SET nom_categorie_produit = :nom_categorie_produit WHERE id_categorie_produit = :id');
			
			$req->bindValue(':id', $id);
			$req->bindValue(':nom_categorie_produit', $categorie->nom_categorie_produit());

			$req->execute();
		}

		public function delete($id_categorie_produit) {
			$req = $this->bdd->prepare('DELETE FROM categorie_produit WHERE id_categorie_produit = :id_categorie_produit');

			$req->bindValue(':id_categorie_produit', $id_categorie_produit);
			$req->execute();
		}
	}
?>