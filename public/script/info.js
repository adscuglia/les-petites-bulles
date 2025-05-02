const select = document.querySelector('select');
const fichier = document.querySelector('#fichier');

// Fonction qui recharge les clients et ajoute les événements sur les boutons "supprimer"
function chargerClients() {
	fetch('../model/affichage_client.php')
		.then(response => response.text())
		.then(data => {
			fichier.innerHTML = data;

			// Attacher les événements aux boutons "supprimer"
			const suppr = document.querySelectorAll('.supprimer');
			suppr.forEach(bouton => {
				bouton.addEventListener('click', () => {
					const id = bouton.getAttribute('data-id');
					const nom = bouton.getAttribute('data-nom'); // Récupérer le nom du client
					if (confirm(`Êtes-vous sûr de vouloir supprimer ${nom}?`)) {
					// Supprimer le client via PHP
						fetch(`../controller/client.php?id=${id}`)
							.then(response => response.text())
							.then(() => {
								// Recharger les clients une fois la suppression faite
								chargerClients();
							});
					}
				});
			});
		})
		.catch(error => {
			console.error("Erreur lors du chargement des clients :", error);
		});
}

function chargerDate() {
	fetch('../model/affichage_date.php')
		.then(response => response.text())
		.then(data => {
			fichier.innerHTML = data ;

			const suppr = document.querySelectorAll('.supprimer');
			const voir = document.querySelectorAll('.voir');
			suppr.forEach(bouton => {
				bouton.addEventListener('click', () => {
					const num_atelier = bouton.getAttribute('data-num');
					const date = bouton.getAttribute('data-date');
					if(confirm(`Supprimer l\'atelier du ${date} ?`)) {
						fetch(`../controller/date_atelier.php?num=${num_atelier}`)
							.then(response => response.text())
							.then(() => {
								chargerDate();
							});
					}
				});
			});
			voir.forEach( boutonVoir => {
				boutonVoir.addEventListener('click', () => {
					const num = boutonVoir.getAttribute('data-num');
					chargerInfos(num);
				});
			});
		});
}

function chargerInfos(num) {
	fetch(`../model/inscris.php?num=${num}`)
		.then(response => response.text())
		.then(data => {
			fichier.innerHTML = data ;
			const suppr = document.querySelectorAll('.supprimer');
			const retour = document.querySelector('#fichier .bu-sec');
			suppr.forEach(bouton => {
				bouton.addEventListener('click', () => {
					const num = bouton.getAttribute('data-num');
					const id = bouton.getAttribute('data-id');
					const nom = bouton.getAttribute('data-nom');
					if(confirm(`supprimer ${nom} de l'atelier ?`)) {
						fetch(`../controller/client_inscris.php?id=${id}&num=${num}`)
							.then(response => response.text())
							.then(() => {
								chargerInfos(num);
							})
					}
				});
			});
			retour.addEventListener('click', () => {
				chargerDate();
			})
		});
}

function chargerPhotoProduit(num) {
	fetch(`../model/affichage_photoProduit.php?num=${num}`)
		.then(response => response.text())
		.then( data => {
			fichier.innerHTML = data;

			const supprimer = document.querySelectorAll('button');
			const retour = document.querySelector('.bu-sec');
			supprimer.forEach(boutton => {
				boutton.addEventListener('click', () => { 
					const id = boutton.getAttribute('id');
					if(confirm('supprimer l\'image ?')) {
						fetch(`../controller/affichage_produit.php?action=photoSupprimer&num=${num}`)
						.then(() => {
							chargerProduit();
						})
					}
				});
			});
			retour.addEventListener('click', () => {
				chargerProduit();
			})
		});

}

function chargerProduit() {
	fetch('../model/affichage_produit.php')
		.then(response => response.text())
		.then( data => {
			fichier.innerHTML = data;

			const supprimer = document.querySelectorAll('.supprimer');
			const modifier = document.querySelectorAll('.modifier');
			const photo = document.querySelectorAll('.photo');
			supprimer.forEach(boutton => {
				boutton.addEventListener('click', ()=> {
					const num = boutton.getAttribute('data-num');
					const nom = boutton.getAttribute('data-nom');
					if (confirm(`supprimer ${nom}`)) {
						fetch(`../controller/affichage_produit.php?action=supprimer&num=${num}`)
							.then(response => response.text())
							.then(() => {
								chargerProduit();
							})
					}
				});
			});
			modifier.forEach(boutton => {
				boutton.addEventListener('click', ()=> {
					const num = boutton.getAttribute('data-num');
					const nom = boutton.getAttribute('data-nom');
					const prix = prompt(`Modifier le prix pour le ${nom}`);
						fetch(`../controller/affichage_produit.php?action=modifier&num=${num}&prix=${prix}`)
							.then(response => response.text())
							.then(() => {
								chargerProduit();
							})
				});
			});
			photo.forEach(boutton => {
				boutton.addEventListener('click', () => {
					const num = boutton.getAttribute('data-num');
					chargerPhotoProduit(num);
				});
			})
		});
}

// Gestion du changement dans le select
select.addEventListener('change', () => {
	const valeur = select.value;

	if (valeur === "client") {
		chargerClients();
	}
	else if (valeur === "date") {
		chargerDate();
	}
	else if (valeur === "produit") {
		chargerProduit();
	}
});
