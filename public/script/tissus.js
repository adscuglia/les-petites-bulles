// Crée un Set pour stocker les IDs des tissus sélectionnés (évite les doublons)
const selection = new Set();
const numProduit = document.querySelector('#valider').getAttribute('data-produit');

document.querySelectorAll('.carte').forEach(carte => {
    carte.addEventListener('click', () => {
        const idTissu = carte.getAttribute('data-id');

        if (!idTissu) return;

        // Vérifie si le tissu est déjà sélectionné
        if (selection.has(idTissu)) {
            selection.delete(idTissu);
            carte.classList.remove('selectionnee');
        } else {
            selection.add(idTissu);
            carte.classList.add('selectionnee');
        }
    });
});

document.querySelector('#valider').addEventListener('click', () => {
    if (selection.size === 0) {
        alert("Veuillez sélectionner au moins un tissu.");
        return;
    }

    // Convertit le Set en tableau et joint les IDs avec des virgules
    const tissus = Array.from(selection).join('-');

    // encodeURIComponent assure que les caractères spéciaux sont correctement encodés
    window.location.href = `contact.php?numProduit=${numProduit}&tissus=${tissus}`;
});