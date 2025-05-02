	fetch('controller/index.php')
	.then(response => response.json())
	.then(data => {
		const coffrets = data.coffrets;
		const produits = data.produits;
		const sliderContainer = document.querySelector('.uk-slider-items');

		sliderContainer.innerHTML = ''; // On vide le slider

		coffrets.forEach(coffret => {
		const card = document.createElement('div');
		card.innerHTML = `
			<div onclick="window.location.href='view/coffret.php?coffret=${coffret.id_coffret}'" class="uk-card uk-card-default">
			<div class="uk-card-media-top">
				<img src="public/Image/coffret/${coffret.photo_coffret}" width="1800" height="1200" alt="${coffret.nom_coffret}">
			</div>
			<div class="uk-card-body">
				<h4>${coffret.nom_coffret}</h4>
				<p>${coffret.description_coffret}</p>
			</div>
			</div>
		`;
		sliderContainer.appendChild(card);
		});
	})
	.catch(error => {
		console.error("Erreur lors du chargement des coffrets :", error);
	});