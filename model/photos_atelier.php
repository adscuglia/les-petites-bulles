<?php
	class Photo {
		private $id_photo;
		private $url;
		private $n_atelier;
		private $description;

		public function id_photo() {return $this->id_photo;}
		public function url() {return $this->url;}
		public function n_atelier() {return $this->n_atelier;}
		public function description() {return $this->description;}

		public function setId_photo($valeur) {
			$this->id_photo = $valeur;
		}
		public function setUrl($valeur) {
			$this->url = $valeur;
		}
		public function setN_atelier($valeur) {
			$this->n_atelier = (int)$valeur;
		}
		public function setDescription($valeur) {
			$this->description = $valeur;
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

	class PhotoManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Photo $photo) {
			$new_photo = $this->bdd->prepare('INSERT INTO photos_atelier(url, n_atelier, description) VALUES (:url, :num, :description)');

			$new_photo->bindValue(':url', $photo->url());
			$new_photo->bindValue(':num', $photo->n_atelier());
			$new_photo->bindValue(':description', $photo->description());

			$new_photo->execute();
		}

		public function getImageParNumero($num) {
			$req = $this->bdd->prepare('SELECT * FROM photos_atelier WHERE n_atelier = :num');

			$req->bindValue(':num', $num);
			$req->execute();

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM photos_atelier');
				// PDO::FETCH_ASSOC retourne un tableau associatif 
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getDerniereAffiche() {
			$req = $this->bdd->query('SELECT url, description FROM `photos_atelier` WHERE n_atelier = 2 ORDER BY id_photo DESC LIMIT 1');
			$image = $req->fetch(PDO::FETCH_ASSOC);
			return $image;
		}

		public function update(photo $photo, $num) {
			$req = $this->bdd->prepare('UPDATE photos_atelier SET Date_photo = :date_photo, nb_participant_max = :nbr WHERE n_photo = :num');
			
			$req->bindValue(':num', $num);
			$req->bindValue(':date_photo', $photo->Date_photo());
			$req->bindValue(':nbr', $photo->nb_participant_max());

			$req->execute();
		}

		public function delete($n_photo) {
			$req = $this->bdd->prepare('DELETE FROM photos_atelier WHERE n_photo = :n_photo');

			$req->bindValue(':n_photo', $n_photo);
			$req->execute();
		}
	}
?>