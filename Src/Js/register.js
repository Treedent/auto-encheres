'use strict';

window.onload = () => {

    /********************************************************************/
    /*** On gère l'apparence des champs en erreur ou pas, à la saisie ***/
    /********************************************************************/
    d.querySelectorAll('#nom, #prenom, #email, #password, #password2').forEach(field => {
        field.addEventListener('input', (e) => {
            setApparence(e.currentTarget);
        });
    });

   /************************************************************************************/
    /*** On déclare un gestionnaire d'événement click sur le bouton d'enregistrement ***/
    /***********************************************************************************/
    d.querySelector('#register-btn').addEventListener('click', (e) => {

        // On selectionne le formulaire de connexion par son id
        let registerForm = d.querySelector('#registerform');

        // On récupère les données du formulaire avec l'objet Javascript Formadata
        let registerdata = new FormData(registerForm);

        // On déclare un tableau qui stoquera le nom des champs en erreur.
        let formError = [];

        // On stockera dans ces variables certaines informations de l'utilisateur
        // pour une utilisation ultérieure.
        let password, nom, prenom;

        // On valide le formulaire
        // On travaille directement avec une boucle for of
        // pour parcourir l'objet FormData
        // qui contient le nom et la valeur des champs de formulaire
        for (let field of registerdata) {
            // la variable field prend la valeur de couples [Champ,Valeur] soit field[0] ou field[1]
            // Pour chaque champ en erreur on stocke son nom dans le tableau formError
            switch(field[0]) {
                case 'nom':
                    nom = field[1];
                    if(!field[1].trim().length) {
                        formError.push('nom');
                    }
                    break;
                case 'prenom':
                    prenom = field[1];
                    if(!field[1].trim().length) {
                        formError.push('prenom');
                    }
                    break;
                case 'email':
                    if(!field[1].trim().length || !ValideEmail(field[1])) {
                        formError.push('email');
                    }
                    break;
                case 'password':
                    password = field[1];
                    if(!field[1].trim().length) {
                        formError.push('password');
                    }
                    break;
                case 'password2':
                    if(!field[1].trim().length || field[1] !== password) {
                        formError.push('password2');
                    }
                    break;
            }
        }

        // Si le tableau formError est vide, il n'y a pas d'erreur
        // On effectue la requête fetch
        if(!formError.length) {

            // On soumet le formulaire via l'API fetch en méthod POST
            // On transmet l'objet FormData contactdata
            fetch('/', {
                method: 'POST',
                body: registerdata

           // On attend la réponse et on la converti en objet Javascript dès sa réception
            }).then(response => {
                return response.json();

           // Puis on réceptionne l'objet converti dans la variable data
            }).then(data => {
                // On s'assure que la réponse a bien dans sa structure l'objet data.usercreated à vrai
                if(data.usercreated === true) {
                    // On masque le formulaire d'enregistrement
                    registerForm.classList.add('d-none');
                    let registerZone = d.querySelector('#registerZone');
                    registerZone.innerHTML = `<h2>L'utilisateur ${prenom} ${nom} a bien été créé !</h2>`;
                }

                // En cas d'erreur sur le fetch, on affiche cette erreur dans la console
            }).catch(error => {
                console.error(error);
            });

        // Le tableau formError contient des nom de champ
        } else {

            // On applique la classe is-invalid aux champs en erreur
            for(let error of formError) {
                d.querySelector(`#${error}`).classList.add('is-invalid');
            }
            // On enlève le focus sur le bouton de soumission du formulaire
            e.currentTarget.blur();
        }
    });
}