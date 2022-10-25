'use strict';
/*** on renome l'objet JavaScript document ***/
let d;
d = document;
/****************************************************************/
/*** Fonction de validation de la syntaxe d'une adresse email ***/
/*** Renvoie True si l'adresse mail est valide ******************/
/****************************************************************/
let ValideEmail = (email) => {
    const validRegex = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)])$/;
    return !!email.match(validRegex);
}

/************************************************************/
/*** Fonction qui valide et change l'apparence des champs ***/
/************************************************************/
let setApparence = (field) => {
    // Pour les champs obligatoires, on cible seulement les champs qui ont la propriété 'required' positionnée.
    if(field.hasAttribute('required')) {
        // Si le champ est rempli
        if (field.value.trim().length) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            // Sinon le champ est vide
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }
    // Champs email, on cible seulement les champs qui ont l'attribut type="email" positionné.
    if(field.hasAttribute('type') && field.getAttribute('type') === 'email') {
        // S'il s'agit d'une adresse email valide.
        if (field.value.trim().length && ValideEmail(field.value)) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            // Sinon l'adresse email n'est pas valide
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }
};

window.onload = () => {
    /*** Gestion du retour en haut de page ***/
    d.querySelector('#to-top').addEventListener('click', () => {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });

    d.querySelector('#search-btn').addEventListener('click', () => {
       alert('Cherche toujours');
    });
}