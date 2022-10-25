<?php

use SYRADEV\AutoEncheres\Utils\Php\Outils;

$uriSegments = Outils::getUriSegments();
$activeLogin = $activeRegister = '';
$activeHome = ' text-secondary';
switch ($uriSegments[1]) {
    case 'login':
        $activeLogin = ' active';
        break;
    case 'register':
        $activeRegister = ' active';
        break;
    default:
        $activeHome = '';
        break;

}
?>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img id="toplogo" src="/Imgs/car.svg" alt="Auto-enchères">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2<?= $activeHome ?>">Accueil</a></li>
                <li><a href="/auto-encheres.html" target="blank" class="nav-link px-2 text-white">DB-Schema</a></li>
                <?php
                    if(isset($_SESSION['user'])) {
                ?>
                        <li><a class="nav-link px-2 text-white"> (Bienvenue <?= $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>)</a></li>
                <?php
                    }
                ?>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <div class="input-group">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Rechercher..."
                           aria-label="Search">
                    <button class="btn btn-outline-light" type="button" id="search-btn">Search</button>
                </div>
            </form>

            <div class="text-end">
                <?php
                if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    ?>
                    <a href="/logout" class="btn btn-outline-light me-2">Déconnexion</a>
                    <?php
                } else {
                    ?>
                    <a href="/login" class="btn btn-outline-light me-2<?= $activeLogin; ?>">Connexion</a>
                    <?php
                }
                ?>
                <a href="/register" class="btn btn-outline-light me-2<?= $activeRegister; ?>">S'enregistrer</a>
            </div>
        </div>
    </div>
</header>