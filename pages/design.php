<?php

session_start();

include 'checkSession.php';

include '../control/dbConf.php';
include '../control/recupAll.php';
include '../control/infoSess.php';
include '../control/affDate.php';
include '../control/affMois.php';
include '../control/addHour.php';
include '../control/affPost.php';
include '../control/affCont.php';
include '../control/affEmb.php';
include '../control/affStt.php';
include '../control/affWork.php';
include '../control/sumAll.php';
include '../control/comptAll.php';

function monModel($titre, $page) {

include '../control/dbConf.php';

echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
HTML;

echo "<title>$titre</title>";

echo <<<HTML
    <link rel="shortcut icon" href="../src/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/brands.css">
    <link rel="stylesheet" href="../fontawesome/css/solid.css">
    <link rel="stylesheet" type="text/css" href="../public/css/imprimer.css" media="print">
    <script src="../public/js/jquery-3.7.1.min.js"></script>
    <script src='../public/js/maskmoney/src/jquery.maskMoney.js'></script>
    <script src="../public/js/affMtt.js"></script> <!-- Afficher FCFA -->
HTML;
    // Fichiers Style
    include '../public/css/allCss.php';
    include '../public/css/designCss.php';
echo <<<HTML
</head>
<body>
    <button class="mobile-menu-btn" id="mobile-btn">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="sidebar">
        <div class="logo_details">
            <i class="fa-brands fa-audible"></i>
            <div class="logo">KERENS</div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>

        <ul class="nav-list">

            <li>
                <a href="tdb.php">
                    <i class="fa-solid fa-folder"></i>
                    <span class="link_name">Tableau de bord</span>
                </a>
                <span class="tooltip">Tableau de bord</span>
            </li>
HTML;
            if (($_SESSION['poste'] !== 3) && ($_SESSION['poste'] !== 4)) {
echo <<<HTML

            <li>
                <a href="points.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="link_name">Points</span>
                </a>
                <span class="tooltip">Points</span>
            </li>

            <li>
                <a href="benefs.php">
                    <i class="fa-solid fa-wallet"></i>
                    <span class="link_name">Bénéfices</span>
                </a>
                <span class="tooltip">Bénéfices</span>
            </li>
HTML;
            }

            if ($_SESSION['poste'] !== 4) {
echo <<<HTML

            <li>
                <a href="invents.php">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span class="link_name">Inventaires</span>
                </a>
                <span class="tooltip">Inventaires</span>
            </li>
HTML;
            }
echo <<<HTML

            <li>
                <a href="stocks.php">
                    <i class="fa-regular fa-house-user"></i>
                    <span class="link_name">Stocks</span>
                </a>
                <span class="tooltip">Stocks</span>
            </li>

            <li>
                <a href="boissons.php">
                    <i class="fa-solid fa-champagne-glasses"></i>
                    <span class="link_name">Boissons</span>
                </a>
                <span class="tooltip">Boissons</span>
            </li>
HTML;
            if (($_SESSION['poste'] !== 1) && ($_SESSION['poste'] !== 2)) {
echo <<<HTML
            <li>
                <a href="consigns.php">
                    <i class="fa-solid fa-lock"></i>
                    <span class="link_name">Consignations</span>
                </a>
                <span class="tooltip">Consignations</span>
            </li>
HTML;
            }
echo <<<HTML
            <li>
                <a href="cmdes.php">
                    <i class="fa-solid fa-handshake-simple"></i>
                    <span class="link_name">Commandes</span>
                </a>
                <span class="tooltip">Commandes</span>
            </li>

            <li>
                <a href="dpnses.php">
                    <i class="fa-solid fa-coins"></i>
                    <span class="link_name">Dépenses</span>
                </a>
                <span class="tooltip">Dépenses</span>
            </li>

            <li>
                <a href="suppliers.php">
                    <i class="fa-solid fa-truck"></i>
                    <span class="link_name">Fournisseurs</span>
                </a>
                <span class="tooltip">Fournisseurs</span>
            </li>
HTML;
            if (($_SESSION['poste'] !== 3) && ($_SESSION['poste'] !== 4)) {
echo <<<HTML
            <li>
                <a href="users.php">
                    <i class="fa-solid fa-users"></i>
                    <span class="link_name">Utilisateurs</span>
                </a>
                <span class="tooltip">Utilisateurs</span>
            </li>

            <li>
                <a href="history.php">
                    <i class="fa-solid fa-globe"></i>
                    <span class="link_name">Historique</span>
                </a>
                <span class="tooltip">Historique</span>
            </li>

            <li>
                <a href="index.php">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span class="link_name">Revenir à l'accueil</span>
                </a>
                <span class="tooltip">Revenir à l'acceuil</span>
            </li>
HTML;
            }
echo <<<HTML
            <li class="profile">
                <div class="profile_details">
                    <div class="profile_content">
                        <div class="name">
HTML;
                            global $nom; global $prenoms;
                            echo $nom . ' ' . $prenoms;
echo <<<HTML
                        </div>
                        <div class="designation">
HTML;
                            global $poste;
                            affPoste($poste);
echo <<<HTML
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
            </li>
        </ul>
    </div>

    <div class="home-section">
HTML;

require_once "$page";

echo <<<HTML
    </div>   

    <script src="../public/js/compte.js"></script>
    <script src="../public/js/deconnect.js"></script>
</body>
</html>
HTML;

}