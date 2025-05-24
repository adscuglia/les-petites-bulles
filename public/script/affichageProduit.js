document.querySelectorAll('.fiche-miniature').forEach(miniature => {
	miniature.addEventListener('click', () => {
		const mainImage = document.getElementById('mainImage');
		mainImage.src = miniature.src;
		mainImage.alt = miniature.alt;
	});
});

