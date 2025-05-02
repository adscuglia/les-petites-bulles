<?php
	class Coffret {
		private $id_coffret;
		private $nom_coffret;
		private $description_coffret;
		private $prix_ttc;
		private $photo_coffret;

		public function id_coffret() {return $this->id_coffret;}
		public function nom_coffret() {return $this->nom_coffret;}
		public function description_coffret() {return $this->description_coffret;}
		public function prix_ttc() {return $this->prix_ttc;}
		public function photo_coffret() {return $this->photo_coffret;}

		public function setId_coffret($id) {
			$this->id_coffret = (int)$id;
		}
		public function setNom_coffret($valeur) {
			$this->nom_coffret = $valeur;
		}
		public function setDescription_coffret($valeur) {
			$this->description_coffret = $valeur;
		}
		public function setPrix_ttc($valeur) {
			$this->prix_ttc = $valeur;
		}
		public function setPhoto_coffret($valeur) {
			$this->photo_coffret = $valeur;
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

	class CoffretManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Coffret $coffret) {
			$req = $this->bdd->prepare('INSERT INTO coffret(nom_coffret, description_coffret, prix_ttc, photo_coffret) VALUES (:nom_coffret, :description_coffret, :prix_ttc, :photo)');

			$req->bindValue(':nom_coffret', $coffret->nom_coffret());
			$req->bindValue(':description_coffret', $coffret->description_coffret());
			$req->bindValue(':prix_ttc', $coffret->prix_ttc());
			$req->bindValue(':photo', $coffret->photo_coffret());

			$req->execute();
			return $this->bdd->lastInsertId();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM coffret');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAllParId($id) {
			$req = $this->bdd->prepare('SELECT * FROM coffret WHERE id_coffret = :id');
			$req->bindValue(':id' , $id);
			$req->execute();
			return $req->fetch(PDO::FETCH_ASSOC);
		}

		public function update(coffret $coffret, $id) {
			$req = $this->bdd->prepare('UPDATE coffret SET description_coffret = :description_coffret, nom_coffret = :nom_coffret, prix_ttc = :prix_ttc, photo_coffret = :photo WHERE id_coffret = :id');

			$req->bindValue(':id', $id);
			$req->bindValue(':nom_coffret', $photo->nom_coffret());
			$req->bindValue(':description_coffret', $photo->description_coffret());
			$req->bindValue(':prix_ttc', $photo->prix_ttc());
			$req->bindValue(':photo', $photo->photo_coffret());

			$req->execute();
		}

		public function delete($id) {
			$req = $this->bdd->prepare('DELETE FROM coffret WHERE id_coffret = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
	}
?>