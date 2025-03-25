window.onload = function() {
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".fa-magnifying-glass");
    const mobileBtn = document.getElementById("mobile-btn");

    // Fonction pour changer l'icône du bouton
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("fa-bars", "fa-bars-staggered");
            if (mobileBtn) {
                mobileBtn.querySelector('i').classList.replace("fa-bars", "fa-xmark");
            }
        } else {
            closeBtn.classList.replace("fa-bars-staggered", "fa-bars");
            if (mobileBtn) {
                mobileBtn.querySelector('i').classList.replace("fa-xmark", "fa-bars");
            }
        }
    }

    // Gestion du bouton dans la sidebar (pour desktop)
    if (closeBtn) {
        closeBtn.addEventListener("click", function() {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
    }

    // Gestion du bouton mobile (pour mobile)
    if (mobileBtn) {
        mobileBtn.addEventListener("click", function() {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
    }

    // Gestion du bouton de recherche (si existant)
    if (searchBtn) {
        searchBtn.addEventListener("click", function() {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
    }

    // Adaptation pour les écrans larges
    function handleResize() {
        if (window.innerWidth >= 768) {
            // Sur desktop, on montre la sidebar réduite par défaut
            sidebar.classList.remove("open");
            menuBtnChange();
        } else {
            // Sur mobile, on cache complètement la sidebar par défaut
            sidebar.classList.remove("open");
            menuBtnChange();
        }
    }

    // Écouteur pour le redimensionnement de la fenêtre
    window.addEventListener('resize', handleResize);
    
    // Initialisation au chargement
    handleResize();
};