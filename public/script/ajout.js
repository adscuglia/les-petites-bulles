	const fichier = document.querySelector('#fichier');

	function chargerTissus() {
		fetch('../model/ajout_tissus.php')
			.then(response => response.text())
			.then(data => {
				fichier.innerHTML = data;

				const img = document.querySelectorAll('button');
				const choix = document.querySelector("select[name=choix]");

				choix.addEventListener('change', ()=> {
					const valeur = choix.value;
					if (valeur === "photo") {
						chargerTissus();
					}
					else if (valeur === "categorie") {
						fetch('../model/ajout_categorie.php')
							.then(response => response.text())
							.then(data => {
								fichier.innerHTML = data;
								const supprimer = document.querySelectorAll('.supprimer');
								supprimer.forEach( boutton => {
									boutton.addEventListener('click', () => {
										const id = boutton.getAttribute('data-id');
										fetch(`../controller/affichage_tissus.php?idSuppr=${id}`)
										chargerTissus();
									})
								})
							})
					}
				});

				img.forEach(supprimer => {
					const id = supprimer.getAttribute('id');
					const nom = supprimer.getAttribute('data-nom');
					supprimer.addEventListener('click', ()=> {
						if (confirm(`supprimer ${nom} ?`)) {
							fetch(`../controller/affichage_tissus.php?id=${id}`)
								.then(response => response.text())
								.then(()=> {
									chargerTissus();
								})
						}
					});
				});
			})
	}

	function chargerPhotoProduit() {
		fetch('../model/ajout_photo_produit.php')
			.then(response => response.text())
			.then(data => {
				fichier.innerHTML = data;
			})
	}

	function chargerNouveauProduit() {
		fetch('../model/ajout_produit.php')
		.then(response => response.text())
		.then(data => {
			fichier.innerHTML = data;

			const choix = document.querySelector("select[name=choix]");

				choix.addEventListener('change', ()=> {
					const valeur = choix.value;
					if (valeur === "photo") {
						chargerProduit();
					}
					else if (valeur === "produit") {
						fetch('../model/ajout_produit.php')
						.then(response => response.text())
						.then(data => {
							fichier.innerHTML = data;
						})
					}
				});
		})
	}

	function chargerProduit() {
		fetch('../model/ajout_photo_produit.php')
			.then(response => response.text())
			.then(data => {
				fichier.innerHTML = data;

				const choix = document.querySelector("select[name=choix]");

				choix.addEventListener('change', ()=> {
					const valeur = choix.value;
					if (valeur === "photo") {
						chargerProduit();
					}
					else if (valeur === "produit") {
						fetch('../model/ajout_produit.php')
						.then(response => response.text())
						.then(data => {
							fichier.innerHTML = data;
						})
					}
				});
			})
	}

	function chargerCoffret() {
		fetch('../model/ajout_coffret.php')
			.then(response => response.text())
			.then(data => {
				fichier.innerHTML = data;

				const ajouter = document.querySelector('.ajoutProduit');
				const ajoutProduit = document.querySelector('.produits');
				ajouter.addEventListener('click', ()=> {
					const select = document.createElement('select');
					select.className = 'produit';
					select.name = 'produits[]'; // Tableau pour récupérer plusieurs valeurs

					fetch('../controller/getProduits.php')
						.then(response => response.json())
						.then(produits => {
							produits.forEach(produit => {
								const option = document.createElement('option');
								option.value = produit.n_produit;
								option.textContent = produit.nom_produit;
								option.classList.add('produit');
								select.appendChild(option);
							});
							ajoutProduit.appendChild(select);
						})
				})
			})
	}


	if (page === "tissus") {
		chargerTissus();
	}
	else if (page === "produit") {
		chargerProduit();
	}
	else if (page === 'nouveau') {
		chargerNouveauProduit();
	}
	else if (page === 'coffret') {
		chargerCoffret();
	}
	else if (page ==='tissus') {
		chargerTissus();
	}
