<?php include '../public/css/imageCss.php'; ?>

<script>
    function selectImage(imageName) {
        window.opener.setImageName(imageName);
        window.close();
    }
</script>

<div class="top">
    <h4>Choississez l'image de la boisson à ajouter</h4>
</div>

<div class="images-container">
    <?php
    // Chemin du dossier contenant les images
    $dossierImages = "../src/boisson/"; // Remplacez par le chemin de votre dossier

    // Vérifier si le dossier existe
    if (is_dir($dossierImages)) {
        // Ouvrir le dossier
        if ($handle = opendir($dossierImages)) {
            // Tableau pour stocker les noms des fichiers images
            $images = [];

            // Parcourir tous les fichiers du dossier
            while (false !== ($fichier = readdir($handle))) {
                // Exclure les fichiers "." et ".."
                if ($fichier != "." && $fichier != "..") {
                    // Vérifier si le fichier est une image (extension)
                    $extension = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
                    if (in_array($extension, ["jpg", "jpeg", "png", "gif"])) {
                        // Ajouter le fichier au tableau
                        $images[] = $fichier;
                    }
                }
            }
            closedir($handle);

            // Trier les images par ordre alphabétique
            sort($images);

            // Afficher les images triées
            foreach ($images as $image) {
                // Extraire le nom de la boisson (sans l'extension)
                $nomBoisson = pathinfo($image, PATHINFO_FILENAME);
                echo '
                <div class="image-item">
                    <img src="' . $dossierImages . $image . '" alt="' . $nomBoisson . '" onclick="selectImage(\'' . $image . '\')">
                    <div class="image-name">' . ucfirst($nomBoisson) . '</div>
                </div>';
            }
        } else {
            echo "<p>Impossible d'ouvrir le dossier des images.</p>";
        }
    } else {
        echo "<p>Le dossier des images n'existe pas.</p>";
    }
    ?>
</div>