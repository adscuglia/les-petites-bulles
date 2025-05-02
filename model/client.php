<?php
	class Client {
		private $ID_client;
		private $Nom_client;
		private $Prenom_client;
		private $Date_naissance;
		private $n_tel;
		private $Mail;

		public function ID_client() {return $this->ID_client;}
		public function Nom_client() {return $this->Nom_client;}
		public function Prenom_client() {return $this->Prenom_client;}
		public function Date_naissance() {return $this->Date_naissance;}
		public function n_tel() {return $this->n_tel;}
		public function Mail() {return $this->Mail;}

		public function setID_client($id) {
			$this->ID_client = (int)$id;
		}
		public function setNom_client($nom) {
			$this->Nom_client = $nom;
		}
		public function setPrenom_client($prenom) {
			$this->Prenom_client = $prenom;
		}
		public function setDate_naissance($date) {
			$this->Date_naissance = $date;
		}
		public function setN_tel($num) {
			$this->n_tel = $num;
		}
		public function setMail($mail) {
			$this->Mail = $mail;
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

	class ClientManager {
		private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

		public function add(Client $client) {
			$new_client = $this->bdd->prepare('INSERT INTO client(Nom_client, Prenom_client, Date_naissance, n_tel, Mail) VALUES (:Nom, :Prenom, :Date_naissance, :Tel, :Mail)');


			$new_client->bindValue(':Nom', $client->Nom_client(), PDO::PARAM_STR);
			$new_client->bindValue(':Prenom', $client->Prenom_client());
			$new_client->bindValue(':Date_naissance', $client->Date_naissance());
			$new_client->bindValue(':Tel', $client->n_tel());
			$new_client->bindValue(':Mail', $client->Mail());

			$new_client->execute();
		}

		public function getIdAvecMail($email) {
			$req = $this->bdd->prepare('SELECT ID_client FROM client WHERE Mail = ? LIMIT 1');
			$req->execute([$email]);
				// retourne l'id du client ou rien si il n'existe pas 
				// fetchColumn recupere la premiere column du premier resultat 
				// l'id client pour cette requete 
			return $req->fetchColumn();
		}

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM client');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Client $client, $id) {
			$req = $this->bdd->prepare('UPDATE client SET Nom_client = :nom, Prenom_client = :prenom, Date_naissance = :date_naissance, n_tel = :tel WHERE ID_client = :id');

			$req->bindValue(':id', $id);
			$req->bindValue(':nom', $client->Nom_client());
			$req->bindValue(':prenom', $client->Prenom_client());
			$req->bindValue(':date_naissance', $client->Date_naissance());
			$req->bindValue(':tel', $client->n_tel());

			$req->execute();
		}

		public function delete($id) {
			$req = $this->bdd->prepare('DELETE FROM client WHERE ID_client = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
	}
?>