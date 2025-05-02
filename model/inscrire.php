<?php
    class Inscrire {
        private $n_atelier;
        private $ID_client;
        private $nbr_inscription;

		public function n_atelier() {return $this->n_atelier;}
        public function ID_client() {return $this->ID_client;}
		public function nbr_inscription() {return $this->nbr_inscription;}

		public function setN_atelier($valeur) {
            $this->n_atelier = $valeur;
		}
        public function setID_client($id) {
            $this->ID_client = (int)$id;
        }
		public function setNbr_inscription($valeur) {
			$this->nbr_inscription = $valeur;
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

    class InscrireManager {
        private $bdd;

		public function setDb(PDO $bdd) {
			$this->bdd = $bdd;
		}
			// lors de l'initialisation je lui donne la connexion a la bdd
		public function __construct($bdd) {
			$this->setDb($bdd);
		}

        public function add($n_atelier, $id, $participant) {
            $inscription = $this->bdd->prepare('INSERT INTO inscrire(n_Atelier, ID_client, nbr_inscription) VALUES (:n_atelier, :id, :nbr)');

			$inscription->bindValue(':n_atelier', $n_atelier);
			$inscription->bindValue(':id', $id);
			$inscription->bindValue(':nbr', $participant);

			$inscription->execute();
        }

		public function getAll() {
			$req = $this->bdd->query('SELECT * FROM inscrire');

			return $req->fetchAll(PDO::FETCH_ASSOC);
		}

		public function update(Atelier $inscrire, $id_client, $n_atelier) {
			$req = $this->bdd->prepare('UPDATE inscrire SET n_atelier = :num, ID_client = :id, nbr_inscription = :nbr');

			$req->bindValue(':num', $n_atelier);
			$req->bindValue(':id', $id_client);
			$req->bindValue(':nbr', $inscrire->nbr_inscription());

			$req->execute();
		}

		public function delete($n_atelier, $id) {
			$req = $this->bdd->prepare('DELETE FROM inscrire WHERE n_Atelier = :n_atelier AND ID_client = :id');

			$req->bindValue(':n_atelier', $n_atelier);
			$req->bindValue(':id', $id);
			$req->execute();
		}

		public function deleteAtelier($num) {
			$req = $this->bdd->prepare('DELETE FROM inscrire WHERE n_Atelier = :n_atelier');
			$req->bindValue(':n_atelier', $num);
			$req->execute();
		}

		public function deleteIdClient($id) {
			$req = $this->bdd->prepare('DELETE FROM inscrire WHERE ID_client = :id');
			$req->bindValue(':id', $id);
			$req->execute();
		}
    }
?>