<?php

namespace SYRADEV\AutoEncheres\Controllers;

// On utilisera ici plusieurs classes.
use SYRADEV\AutoEncheres\Models\UtilisateursModel;
use SYRADEV\AutoEncheres\Utils\Database\PdoDb;
use SYRADEV\AutoEncheres\Utils\Debug\dBug;
use SYRADEV\AutoEncheres\Utils\Php\Outils;

/*
 *  Classe de gestion des utilisateurs étendue depuis la classe Controller.
 */

class Utilisateurs extends Controller
{
    /*
     * Afffiche le formulaire de connexion
     */
    public function authDisplay(): array|string
    {
        return $this->render('layouts.default', 'templates.login');
    }

    /*
    * Afffiche le formulaire d'enregistrement d'un utilisateur
    */
    public function registerDisplay(): array|string
    {
        return $this->render('layouts.default', 'templates.register');
    }

    /*
    * Authentifie un utilisateur
    */
    public function login($credentials): bool|string
    {
        // On récupère les données du formualire.
        $escobar = $credentials['escobar'];
        $email = $credentials['email'];
        $password = $credentials['password'];

        // On créé une variable de retour pour la méthode login.
        $connected = false;

        // Le champ escobar du formulaire, caché par CSS doit être vide,
        // Un bot le remplira forcément...
        if ($escobar === '') {

            // Requete de type SELECT * sur la table utilisateurs,
            // On applique à la clause WHERE la condition d'égalité du courriel et du mot de passe haché MD5.
            $sql = 'SELECT * FROM `utilisateurs` WHERE `email`="'. $email .'" AND `password`="' . MD5($password) . '"';

            // On exécute la requête grace à la class PdoDb.
            $login = PdoDb::getInstance()->requete($sql, 'fetch');

            // Si la requête renvoie un utilisateur,
            // on stocke les informations de l'utilisateur dans un tableau de session.
            if (is_array($login) && !empty($login)) {
                $_SESSION['user']['userid'] = $login['uid_utilisateur'];
                $_SESSION['user']['nom'] = $login['nom'];
                $_SESSION['user']['prenom'] = $login['prenom'];
                $_SESSION['user']['email'] = $login['email'];
                $_SESSION['user']['password'] = $login['email'];

                // La connexion à l'application a réussi, on renvoie true.
                $connected = true;
            } else {
                // La connexion à l'application a échoué, on renvoie false.
                $connected = false;
            }
        }
        return json_encode(['connected' => $connected]);
    }

    // Déconnecte l'utilisateur.
    public static function logout()
    {
        // On détruit les variables de session.
        session_unset();
        // On détruit la session.
        session_destroy();
        // On redirige le visiteur vers la page d'accueil.
        header('location:/');
    }

    /*
    * Enregistre un utilisateur
    */
    public function register($newUser): bool|string
    {

        $userCreated = false;
        $newUserId = 0;
        $escobar = $newUser['escobar'];

        // Le champ escobar du formulaire, caché par CSS doit être vide,
        // Un bot le remplira forcément...
        if ($escobar === '') {

            // on nettoie les données pour éviter des éventuelles injections XSS.
            $newUserClean = Outils::cleanUpValues($newUser);

            //On vérifie si le user n'existe pas déjà en base de données
            $req_user_exists = "SELECT `uid_utilisateur` FROM `utilisateurs` WHERE `email`='" . $newUserClean['email'] . "'";
            $res_user_exists = PdoDb::getInstance()->requete($req_user_exists, 'fetch');
            if (is_array($res_user_exists) && !empty($res_user_exists)) {
                $userCreated = false;
            } else {
                // On enregistre l'utilisateur
                $newUserObj = new UtilisateursModel($newUserClean);
                PdoDb::getInstance()->inserer('utilisateurs', $newUserObj);
                $newUserId = PdoDb::getInstance()->dernierIndex();
                $userCreated = true;
            }
        }
        return json_encode(['usercreated' => $userCreated, 'newUserId' => $newUserId]);
    }
}