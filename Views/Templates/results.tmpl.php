<?php
/**
 * Ces commentaires avec des @ servent à identifier les variables de la page.
 * Peut être utile dans certains éditeurs comme PHPStorm
 * ou pour générer de la documentation automatique avec phpDocumentor (https://phpdoc.org/)
 * @var int $uid_annonce
 * @var string $titre_annonce
 * @var float $prix_depart
 * @var int $date_fin_enchere
 * @var string $marque
 * @var string $modele
 * @var int $puissance
 * @var int $annee
 * @var string $description
 * @var string $photo
 * @var string $date
 * @var string $montant
 */

use SYRADEV\AutoEncheres\Utils\Php\Outils;
?>

<div class="container">
    <div class="row">
        <div class="col mt-3 mb-3">
            <h1 class="d-inline">Résultats de la recherche : </h1>
        </div>
    </div>
    <div class="row">
        <?php if(empty($data)) { ?>
            <div class="col-12"><h3>Aucune donnée ne correspond à votre recherche.</h3></div>
        <?php
        } else {
        ?>
        <div class="grid">
            <?php
            /** @var array $data */
            foreach ($data as $annonce) {
                //on utilise extract pour simplifier l'appel aux variables d'une annonce.
                extract($annonce);
                ?>
                <div class="card grid-item <?= Outils::sanitizeName($marque); ?>">
                    <a class="link" data-fancybox="<?= $marque; ?>" data-src="/Imgs/<?= $photo; ?>"
                       data-caption="<strong><?= $marque; ?></strong> | <?= $modele; ?>">
                        <img src="/Imgs/<?= $photo; ?>" class="card-img-top" alt="<?= $marque; ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title marque"><?= $marque; ?><br><?= $modele; ?></h5>
                        <p class="card-text"><?= $description; ?></p>
                        <a href="/annonce/<?= $uid_annonce; ?>" class="btn btn-details btn-outline-primary">Détails</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php } ?>
    </div>

