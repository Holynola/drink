<?php
    session_start();

    include 'checkSession.php'; // Vérifie la connexion et le temps de la dernière connexion

    include '../control/dbConf.php';
    include '../control/recupAll.php';

    // Vérification du lieu de service
    if (isset($_SESSION['service']) && ($_SESSION['service'] != 3)) {
        $service = $_SESSION['service'];
        $url = "tdb.php?work=" . $service;
        header("Location:" . $url);
    }

    // Suppression du lieu de service
    unset($_SESSION['service']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="shortcut icon" href="../src/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../ontawesome/css/brands.css">
    <link rel="stylesheet" href="../fontawesome/css/solid.css">
    <script src="../public/js/jquery-3.7.1.min.js"></script>
    <?php include '../public/css/accueilCss.php'; // Fichier Style ?>
</head>
<body>
    <header>
        <div class="home">
            <h2>Merci de vous êtes connectés. Veuillez sélectionner un lieu de service</h2>

            <div class="home-all">
                <?php
                    $con = "idW != 3";
                    $donWork = recupDon('work', $con);

                    foreach ($donWork as $wk) {
                ?>
                <div class="home-card">
                    <h3><?= $wk['libelleW'] . ' ' . $wk['lieuW']; ?></h3>
                    <a href="tdb.php?work=<?= $wk['idW']; ?>">Cliquer ici</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>
</body>
</html>