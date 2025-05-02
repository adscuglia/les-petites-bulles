const carte = document.querySelectorAll('.carte');

carte.forEach( produit => {
	produit.addEventListener('click', ()=> {
		const num = produit.getAttribute('data-num');
		window.location.href=`../view/photo_produit.php?num=${num}`
	});
});