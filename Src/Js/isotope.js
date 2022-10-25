// On identifie la grille contenant les annonces
let grid = document.querySelector('.grid');

// On initialise le composant javaScript Isotope
let iso = new Isotope( grid, {
    itemSelector: '.grid-item',
    layoutMode: 'fitRows',
    sortBy: 'marque',
    sortAscending: true
});

// On identifie le groupe de boutons de filtrage
let filters = document.querySelector('.filters');

// Désactive tous les boutons de filtre
let removeActiveLinks = (parent) => {
    for (const link of parent.getElementsByTagName("a")) {
        link.classList.remove('active');
    }
}
// On gère les clicks sur les boutons de filtrage
filters.addEventListener('click', (e) => {
    // On récupère le bouton cliqué
    let $this = e.target;
    // On récupère le nom du filtre
    let filtre = $this.dataset.filter;
    // On désactive tous les boutons de filtre
    removeActiveLinks(filters);
    // On active le bouton
    $this.classList.add('active');
    // On lance le filtrage de l'affichage
    iso.arrange({filter: filtre});
});

// On identifie le groupe de boutons d'ordre
let orders = document.querySelector('.ordering');

// On gère les clicks sur les boutons d'ordre
orders.addEventListener('click', (e) => {
    // On récupère le bouton cliqué
    let $this = e.target;
    // On récupère le nom du filtre
    let order = $this.dataset.ordering === 'true';
    // On désactive tous les boutons de filtre
    removeActiveLinks(orders);
    // On active le bouton
    $this.classList.add('active');
    iso.arrange({sortAscending: order});
});
