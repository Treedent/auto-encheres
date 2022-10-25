<?php

use SYRADEV\AutoEncheres\Controllers\Annonces;
use SYRADEV\AutoEncheres\Utils\Debug\dBug;
use SYRADEV\AutoEncheres\Utils\Php\Outils;

/** @var string $marque */
?>

<div class="row">
    <div class="col mt-3 mb-3">
        Filtrer par marque&nbsp;:
        <div class="btn-group btn-group-sm flex-wrap filters">
            <a href="#" class="btn btn-outline-primary active" data-filter="*">Toutes</a>
            <?php
            $annonces = new Annonces();
            $marques = $annonces->getMarques();
            foreach ($marques as $allmarque) {
                extract($allmarque); ?>
                <a href="#" class="btn btn-outline-primary"
                   data-filter=".<?= Outils::sanitizeName($marque); ?>"><?= $marque; ?></a>
                <?php
            }
            ?>
        </div>
    </div>
</div>