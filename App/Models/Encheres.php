<?php

namespace SYRADEV\AutoEncheres\Models;

/*
 * Modèle Enchères
 */
class EncheresModel
{
    public int $uid_utilisateur;
    public int $uid_annonce;
    public int $date;
    public float $montant;


    public function __construct($EnchereInfos) {
        $this->uid_utilisateur = (int)$EnchereInfos['uid_utilisateur'];
        $this->uid_annonce = (int)$EnchereInfos['uid_annonce'];
        $this->date = strtotime($EnchereInfos['date']) + (int)(date('H')*60) + (int)(date('i'));
        $this->montant = (float)$EnchereInfos['montant'];
        return $this;
    }
}
