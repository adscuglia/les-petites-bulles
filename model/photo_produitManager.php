<?php
	class Photo_produit {
		private $id_photo_produit;
		private $url;
		private $n_produit;


		public function id_photo_produit() {return $this->id_photo_produit;}
		public function url() {return $this->url;}
		public function n_produit() {return $this->n_produit;}

		public function setId_photo_produit($id) {
			$this->id_photo_produit = (int)$id;
		}
		public function setUrl($n_produit) {
			$this->url = $n_produit;
		}
		public function setN_produit($n_produit) {
			$this->n_produit = $n_produit;
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

	class Photo_produitManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Photo_produit $photo) {
			$new_photo = $this->bdd->prepare('INSERT INTO photo_produit(url, n_produit) VALUES (:url, :n_produit)');

			$new_photo->bindValue(':url', $photo->url(), PDO::PARAM_STR);
			$new_photo->bindValue(':n_produit', $photo->n_produit());

			$new_photo->execute();
		}

		public function getPhotoAvecProduit($num) {
			$req = $this->bdd->prepare('SELECT * FROM photo_produit WHERE n_produit = ? ');
			$req->execute([$num]);

			return $req->fetchAll();
		}

		public function getDernierePhotoAllProduit() {
			$req = $this->bdd->query('SELECT * FROM produit pr LEFT JOIN photo_produit ph ON ph.n_produit = pr.n_produit WHERE ph.id_photo_produit = ( SELECT MAX(ph2.id_photo_produit) FROM photo_produit ph2 WHERE ph2.n_produit = pr.n_produit)');

			return $req->fetchAll();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM photo_produit');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Photo_produit $photo, $id) {
			$req = $this->bdd->prepare('UPDATE photo_produit SET n_produit = :n_produit, url = :url WHERE id_photo_produit = :id');

			$req->bindValue(':id', $id);
			$req->bindValue(':url', $photo->url());
			$req->bindValue(':n_produit', $photo->n_produit());

			$req->execute();
		}

		public function deletePhotoProduit($num) {
			$req = $this->bdd->prepare('DELETE FROM photo_produit WHERE n_produit = :num');
			$req->bindValue(':num', $num);
			$req->execute();
		}

		public function delete($id) {
			$req = $this->bdd->prepare('DELETE FROM photo_produit WHERE id_photo_produit = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
	}
?>