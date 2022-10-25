'use strict';

window.onload = () => {
    /********************************************************************/
    /*** On gère l'apparence des champs en erreur ou pas, à la saisie ***/
    /********************************************************************/
    d.querySelectorAll('#email, #password').forEach(field => {
        field.addEventListener('input', (e) => {
            setApparence(e.currentTarget);
        });
    });

   /*******************************************************************************/
    /*** On déclare un gestionnaire d'événement click sur le bouton de connexion ***/
    /*******************************************************************************/
    d.querySelector('#login-btn').addEventListener('click', (e) => {

        // On selectionne le formulaire de connexion par son id
        let loginform = d.querySelector('#loginform');

        // On récupère les données du formulaire avec l'objet Javascript Formadata
        let logindata = new FormData(loginform);

        // On déclare un tableau qui stoquera le nom des champs en erreur
        let formError = [];

        // On valide le formulaire
        // On travaille directement avec une boucle for of
        // pour parcourir l'objet FormData
        // qui contient le nom et la valeur des champs de formulaire
        for (let field of logindata) {

            // la variable field prend la valeur de couples [Champ,Valeur] soit field[0] ou field[1]
            // Pour chaque champ en erreur on stocke son nom dans le tableau formError
            switch(field[0]) {
                case 'email':
                    if(!field[1].trim().length || !ValideEmail(field[1])) {
                        formError.push('email');
                    }
                    break;
                case 'password':
                    if(!field[1].trim().length) {
                        formError.push('password');
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
                body: logindata

           // On attend la réponse et on la converti en objet Javascript dès sa réception
            }).then(response => {
                return response.json();

           // Puis on réceptionne l'objet converti dans la variable data
            }).then(data => {
                // On s'assure que la réponse a bien dans sa structure l'objet data.success à vrai
                if(data.connected === true) {
                    document.location.href='/';
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