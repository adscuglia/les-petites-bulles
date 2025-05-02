<?php
	function retourneMessage($bdd, $nom, $tissus) {
		$produitManager = new ProduitManager($bdd);
		$tissusManager = new TissusManager($bdd);

		$numTissus = explode('-', $tissus);
		$nomTissus = [];

		foreach($numTissus as $numTissu) {
			$nomTissus[] = $tissusManager->getNomParNum($numTissu);
		}

		$message = "Bonjour,\n\nJe souhaiterai le produit : ".$_GET['numProduit']."\n\nDétails :\n";

		foreach($nomTissus as $nomTissu) {
			$message .= "- Tissu : ".$nomTissu."\n";
		}

		$message .= "- Broderie : \n\nMerci.";
		return $message;
	}
?>