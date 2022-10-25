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
extract($data);

// On détecte l'expiration de l'enchère
$enchereExpires = time()-$date_fin_enchere > 0;
?>

<div class="container">
    <div class="row">
        <div class="col mt-3 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="d-inline display-4"><?= $titre_annonce; ?></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <a class="link" data-fancybox="<?= $marque; ?>" data-src="/Imgs/<?= $photo; ?>" data-caption="<strong><?= $marque; ?></strong> | <?= $modele; ?>">
                                <img src="/Imgs/<?= $photo; ?>" class="w-75 rounded" alt="<?= $marque; ?>">
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <h2><?= $marque . '&nbsp;' . $modele; ?>.</h2>
                            <p>Année: <?= $annee; ?></p>
                            <p>Puissance: <?= $puissance; ?> CH.</p>
                            <p>Description: <?= $description; ?>.</p>
                            <p>Prix de départ: <?= Outils::formalizeEuro($prix_depart); ?>.</p>
                            <?php
                                if(!empty($date) && !empty($montant)) {
                            ?>
                                    <p>Date de la derni&egrave;re d'ench&egrave;re : <?= date('d/m/Y', $date); ?>.</p>
                                    <p>Montant de la derni&egrave;re ench&egrave;re : <strong class="orange"><?= Outils::formalizeEuro($montant); ?></strong>.
                            <?php
                                } else {
                            ?>
                                    <span class="text-warning bg-dark p-2">Aucune enchère n'a encore été déposée pour cette annonce !</span>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <h5>date de fin d'enchère: <?= Outils::formalizeDate($date_fin_enchere); ?></h5>
                        </div>
                        <div class="col">
                            <?php
                            if(!$enchereExpires) {
                                if(isset($_SESSION['user'])) {
                                ?>
                                    <a href="/bid/<?= $uid_annonce; ?>" class="btn btn-outline-primary float-end">Proposer une enchère</a>
                                <?php } else { ?>
                                    <a href="/login" class="btn btn-outline-primary float-end">Se connecter et proposer une enchère</a>
                                <?php } } else { ?>
                                <h3 class="text-danger d-inline-flex p-1 bg-dark">Enchère expirée !</h3>
                                <?php } ?>
                            <a href="/" class="btn btn-outline-primary float-end mx-2">Retourner à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

