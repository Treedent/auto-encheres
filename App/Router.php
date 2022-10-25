<?php
/*
 * Le routeur réceptionne des variables $_POST ou $_GET.
 * Son rôle unique sera de router l'application vers les contôleurs ad hoc
 * qui définissent la logique de l'application puis génèrerent les affichages.
 */

use SYRADEV\AutoEncheres\Controllers\Encheres;
use SYRADEV\AutoEncheres\Models\UtilisateursModel;
use SYRADEV\AutoEncheres\Controllers\Annonces;
use SYRADEV\AutoEncheres\Controllers\Utilisateurs;
use SYRADEV\AutoEncheres\Controllers\Errors;
use SYRADEV\AutoEncheres\Utils\Debug\dBug;

// On démarre le moteur de sessions PHP pour gérer les variables de $_SESSION.
session_start();

// On crée une variable qui mixte $_POST et $_GET
$_GP = array_merge($_POST, $_GET);

/*
 * Gestion des appels avec AJAX fetch.
 */

// On détecte les entrées get ou post pour router vers le contôleur ad hoc.
if(count($_GP)>0) {

    if(isset($_GP['login']) && $_GP['login'] === '1') {
        $utilisateur = new Utilisateurs;
        echo $utilisateur->login($_GP);
        exit();
    }

    if(isset($_GP['register']) && $_GP['register'] === '1') {
        $utilisateur = new Utilisateurs;
        echo $utilisateur->register($_GP);
        exit();
    }

    if(isset($_GP['error'])) {
        $errorNum = $_GP['error'];
        $error = new Errors;
        echo $error->errorDisplay($errorNum);
        exit();
    }

    if(isset($_GP['login'])) {
        $login = new Utilisateurs;
        echo $login->authDisplay();
        exit();
    }

    if(isset($_GP['logout'])) {
        Utilisateurs::logout();
        exit();
    }

    if(isset($_GP['register'])) {
        $login = new Utilisateurs;
        echo $login->registerDisplay();
        exit();
    }

    if(isset($_GP['annonceid'])) {
        $annonceId = $_GP['annonceid'];
        $annonces = new Annonces;
        echo $annonces->details($annonceId);
        exit();
    }

    if(isset($_GP['enchereannonceid'])) {
        $annonceId = $_GP['enchereannonceid'];
        // Insertion d'une nouvelle enchère si on est connecté
        if(isset($_GP['montant']) && isset($_SESSION['user'])) {
            $enchere = new Encheres;
            $setEnchere = $enchere->setEnchere($_GP);
            if($setEnchere['enchereCreated']=== true) {
                header('location:/annonce/'.$annonceId);
            }

        //Gestion d'une enchère
        } else {
            $annonces = new Annonces();
            echo $annonces->enchere($annonceId);
        }
        exit();
    }
}

// On récupère le flux JSON posté.
$json = file_get_contents('php://input');
// On convertit le flux JSON en tableau d'objets.
$data = json_decode($json);
// On route vers un contrôleur.
if(!empty($data)) {
    if(isset($data->getAllAnnonces) && $data->getAllAnnonces === '1') {
        exit();
    }
}

