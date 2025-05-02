<?php
	class Integrer {
		private $N_produit;
		private $id_coffret;

		public function N_produit() {return $this->N_produit;}
		public function id_coffret() {return $this->id_coffret;}

		public function setN_produit($valeur) {
			$this->N_produit = $valeur;
		}
		public function setId_coffret($id) {
			$this->id_coffret = (int)$id;
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

	class IntegrerManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Integrer $integrer) {
			$req = $this->bdd->prepare('INSERT INTO integrer(N_produit, id_coffret) VALUES (:N_produit, :id_coffret)');

			$req->bindValue(':N_produit', $integrer->N_produit());
			$req->bindValue(':id_coffret', $integrer->id_coffret());

			$req->execute();
		}

		public function getAllProduitUnCoffret($id) {
			$req = $this->bdd->prepare('SELECT * FROM integrer INNER JOIN produit ON(integrer.N_produit = produit.n_produit) WHERE id_coffret = :id');
			$req->bindValue(':id', $id);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM integrer');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(integrer $integrer, $id) {
			$req = $this->bdd->prepare('UPDATE integrer SET N_produit = :N_produit WHERE id_coffret = :id');

			$req->bindValue(':id', $id);
			$req->bindValue(':N_produit', $photo->N_produit());

			$req->execute();
		}

		public function delete($id) {
			$req = $this->bdd->prepare('DELETE FROM integrer WHERE id_integrer = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
	}
?>