<?php

namespace SYRADEV\AutoEncheres\Controllers;

// On utilisera ici la classe de manipulation de la base de données PdoDb.
use SYRADEV\AutoEncheres\Utils\Database\PdoDb;

// Utilisation de la classe de debuggage dBug.
use SYRADEV\AutoEncheres\Utils\Debug\dBug;


/*
 *  Classe de gestion des annonces étendue depuis la classe Controller.
 */

class Annonces extends Controller
{
    /*
    * Affiche la liste des annonces.
    */
    public function list(): array|string
    {
        // Requete de type SELECT * sur la table annonces.
        $sql = 'SELECT * FROM `annonces` ORDER BY `marque`';
        // Exécution de la requête
        $annonces = PdoDb::getInstance()->requete($sql);
        // Transmission des annonce à la vue (Layout + template).
        return $this->render('layouts.default', 'templates.annonces', $annonces);
    }

    /*
    * Sélectionne la liste des marques de voiture.
    */
    public function getMarques()
    {
        // Requete de type SELECT * sur la table annonces.
        $sql = 'SELECT DISTINCT `marque` FROM `annonces` ORDER BY `marque`';
        // Exécution de la requête et renvoie des marques
        return PdoDb::getInstance()->requete($sql);
    }

    // Affiche le détail d'une annonce et sa dernière enchere à partir de uid_annonce
    public function details($uid_annonce): array|string
    {
        // Requete de type SELECT * sur la table annonces à partir de l'uid_annonce.
        $sql = 'SELECT * FROM `annonces` A INNER JOIN `encheres` E ON A.`uid_annonce` = E.`uid_annonce` WHERE A.`uid_annonce`=' . $uid_annonce . ' ORDER BY E.`date` DESC LIMIT 1';
        $annonce = PdoDb::getInstance()->requete($sql, 'fetch');
        if (empty($annonce)) {
            $sql = 'SELECT * FROM `annonces` WHERE `uid_annonce`=' . $uid_annonce;
            $annonce = PdoDb::getInstance()->requete($sql, 'fetch');
        }
        // Transmission de l'annonce à la vue (Layout + détails).
        return $this->render('layouts.default', 'templates.detail', $annonce);
    }

    public function enchere($uid_annonce): array|string
    {
        // On redirige sur l'annonce
        if (!isset($_SESSION['user'])) {
            header('location:/annonce/' . $uid_annonce);
        }
        // Requete de type SELECT * sur la table annonces à partir de l'uid_annonce.
        $sql = 'SELECT * FROM `annonces` A INNER JOIN `encheres` E ON A.`uid_annonce` = E.`uid_annonce` WHERE A.`uid_annonce`=' . $uid_annonce . ' ORDER BY E.`date` DESC LIMIT 1';
        $annonce = PdoDb::getInstance()->requete($sql, 'fetch');
        if (empty($annonce)) {
            $sql = 'SELECT * FROM `annonces` WHERE `uid_annonce`=' . $uid_annonce;
            $annonce = PdoDb::getInstance()->requete($sql, 'fetch');
        }
        // Transmission de l'annonce à la vue (Layout + enchere).
        return $this->render('layouts.default', 'templates.enchere', $annonce);
    }
}