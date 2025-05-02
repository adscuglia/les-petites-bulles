document.addEventListener('DOMContentLoaded', function() {
    const selectCategorie = document.querySelector('.choix-tissus');

    selectCategorie.addEventListener('change', () => {
		const categorieSelectionnee = selectCategorie.value;
        const toutesLesCartes = document.querySelectorAll('.carte');

        toutesLesCartes.forEach(carte => {
            const categorieTissu = carte.getAttribute('data-categorie');

            // Ajout d'une transition fluide
            if (categorieSelectionnee === 'Tout' || categorieTissu === categorieSelectionnee) {
                    carte.style.display = 'block';
            }
            else {
                carte.style.display = 'none';
            }
        });
    });
});
