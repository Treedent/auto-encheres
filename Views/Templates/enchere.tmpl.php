<?php
use SYRADEV\AutoEncheres\Utils\Php\Outils;
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

// On extrait les données pour faciliter leur affichage à partir de variables simples.
extract($data);

// On détecte l'expiration de l'enchère
$enchereExpires = time()-$date_fin_enchere > 0;
// Si l'enchère a expirée, on retourne sur la vue de détails.
if($enchereExpires) {
    header('location:/annonce/' . $uid_annonce);
}

// On stocke la date du jour pour initilaiser le champ date.
$day = date('d');
$month = date('m');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
$min_enchere = empty($montant) ? (int)$prix_depart+1 : (int)$montant+1;
?>

<div class="container">
    <div class="row">
        <div class="col mt-3 mb-3">
            <form action="/bidaction/<?= $uid_annonce; ?>" method="post">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="d-inline display-4">Proposer une enchère</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a class="link" data-fancybox="<?= $marque; ?>" data-src="/Imgs/<?= $photo; ?>"
                                   data-caption="<strong><?= $marque; ?></strong> | <?= $modele; ?>">
                                    <img src="/Imgs/<?= $photo; ?>" class="w-75 rounded" alt="<?= $marque; ?>">
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <h3><?= $marque . '&nbsp;' . $modele . '&nbsp;:&nbsp;' . $titre_annonce; ?>.</h3>
                                <p>Année: <?= $annee; ?><br>
                                    Puissance: <?= $puissance; ?> CH.<br>
                                    Description: <?= $description; ?>.<br>
                                    Prix de départ: <?= Outils::formalizeEuro($prix_depart); ?>.</p>
                                <?php
                                if(!empty($date) && !empty($montant)) {
                                    ?>
                                    <p>Date de la derni&egrave;re d'ench&egrave;re : <?= date('d/m/Y', $date); ?>.<br>
                                    Montant de la derni&egrave;re ench&egrave;re : <strong class="orange"><?= Outils::formalizeEuro($montant); ?></strong>.</p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="text-warning">Aucune enchère n'a encore été déposée pour cette annonce !</p>
                                    <?php
                                }
                                ?>
                                <!-- Champ de protection : Doit toujours être vide -->
                                <label for="escobar"></label>
                                <input type="text" id="escobar" name="escobar" class="d-none">
                                <input type="hidden" id="uid_utilisateur" name="uid_utilisateur"
                                       value="<?= $_SESSION['user']['userid']; ?>">
                                <div class="form-group">
                                    <label for="uid_annonce" class="form-label">Annonce N° :</label>
                                    <input type="text" class="form-control" id="uid_annonce" name="uid_annonce" readonly value="<?= $uid_annonce; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="date" class="form-label">Date de votre ench&egrave;re :</label>
                                    <input type="date" class="form-control" min="<?= $today; ?>" id="date" name="date" value="<?= $today; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="montant" class="form-label">Montant de votre ench&egrave;re :</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="euro">&euro;</span>
                                        <input type="number" min="<?= $min_enchere; ?>" id="montant" name="montant" value="<?= $min_enchere; ?>" class="form-control" aria-label="Montant" aria-describedby="euro">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
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
                                if (isset($_SESSION['user'])) {
                                    ?>
                                    <button type="submit" class="btn btn-outline-primary float-end">Ench&eacute;rir</button>
                                <?php } else { ?>
                                    <a href="/login" class="btn btn-outline-primary float-end">Se connecter pour
                                        proposer une enchère</a>
                                <?php } ?>
                                <a href="/annonce/<?= $uid_annonce ?>" class="btn btn-outline-primary float-end mx-2">Retourner à l'annonce</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

