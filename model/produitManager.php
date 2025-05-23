<?php
	class Produit {
		private $n_produit;
		private $nom_produit;
		private $descriptif_produit;
		private $id_categorie_produit;
		private $prix_TTC;


		public function n_produit() {return $this->n_produit;}
		public function nom_produit() {return $this->nom_produit;}
		public function descriptif_produit() {return $this->descriptif_produit;}
		public function id_categorie_produit() {return $this->id_categorie_produit;}
		public function prix_TTC() {return $this->prix_TTC;}

		public function setN_produit($valeur) {
			$this->n_produit = (int)$valeur;
		}
		public function setNom_produit($valeur) {
			$this->nom_produit = $valeur;
		}
		public function setDescriptif_produit($valeur) {
			$this->descriptif_produit = $valeur;
		}
		public function setId_categorie_produit($valeur) {
			$this->id_categorie_produit = $valeur;
		}
		public function setPrix_TTC($valeur) {
			$this->prix_TTC = $valeur;
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

	class ProduitManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Produit $produit) {
			$new_produit = $this->bdd->prepare('INSERT INTO produit(nom_produit, descriptif_produit, id_categorie_produit, prix_TTC) VALUES (:nom, :descriptif, :id_categorie_produit, :prix)');
			$new_produit->bindValue(':nom', $produit->nom_produit());
			$new_produit->bindValue(':descriptif', $produit->descriptif_produit());
			$new_produit->bindValue(':id_categorie_produit', $produit->id_categorie_produit());
			$new_produit->bindValue(':prix', $produit->prix_TTC());
			$new_produit->execute();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM produit');
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getProduitParNum($num) {
			$req = $this->bdd->prepare('SELECT * FROM produit WHERE n_produit = ?');
			$req->execute([$num]);

			return $req->fetch(PDO::FETCH_ASSOC);
		}

		public function update(Produit $produit, $id) {
			$req = $this->bdd->prepare('UPDATE produit SET nom_produit = :nom,descriptif_produit = :descriptif, id_categorie_produit = :id_categorie_produit, prix_TTC = :prix WHERE n_produit = :num_produit');

			$req->bindValue(':num_produit', $id);
			$req->bindValue(':nom', $produit->nom_produit());
			$req->bindValue(':descriptif', $produit->descriptif_produit());
			$req->bindValue(':id_categorie_produit', $produit->id_categorie_produit());
			$req->bindValue(':prix', $produit->prix_TTC());
			$req->execute();
		}

		public function updatePrix($prix, $num) {
			$req = $this->bdd->prepare('UPDATE produit SET prix_TTC = :prix WHERE n_produit = :num_produit');
			$req->bindValue(':prix', $prix);
			$req->bindValue(':num_produit', $num);
			$req->execute();
		}

		public function delete($num) {
			$req = $this->bdd->prepare('DELETE FROM produit WHERE n_produit = :num');
			$req->bindValue(':num', $num);
			$req->execute();
		}
	}
?>