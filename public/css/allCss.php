<style>

@font-face {
    font-family: 'Gontserrat';
    src: url('../src/fonts/Gontserrat-Regular.ttf');
}

@font-face {
    font-family: 'Rio';
    src: url('../src/fonts/RioGrande.ttf');
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Gontserrat';
}

:root {
    --noir: #000814;
    --blanc: #ffffff;
    --rouge: #c1121f;
    --bleu: #1982c4;
    --gris: #8d99ae;
}

/* Content */

.content {
    width: 1200px;
    margin: 0 auto;
}

@media (max-width: 1200px) {
    .content {
        width: 100%;
        padding: 0 5px;
    }
}


/* Couleurs */

.red {
    color: var(--rouge);
}

.blue {
    color: var(--bleu);
}

.white {
    color: var(--blanc);
}

/* Recap */

.recap {
    margin: 50px 0;
    text-align: center;
}

.recap h5 {
    font-size: 30px;
    margin-bottom: 15px;
}

.recap div {
    font-size: 20px;
}

@media (max-width: 400px) {
    .recap h5 {
        font-size: 20px;
    }
    
    .recap div {
        font-size: 16px;
    }
}

/* Bouton */

.btn-link {
    text-decoration: none;
    color: var(--blanc);
    background-color: var(--noir);
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-link:hover,
.btn-link:focus {
    background-color: var(--rouge);
    transform: scale(1.1); /* Légère augmentation de la taille */
}

.btn-small {
    text-decoration: none;
    color: var(--blanc);
    background-color: var(--noir);
    padding: 3px 8px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-small:hover,
.btn-small:focus {
    background-color: var(--rouge);
    transform: scale(1.1); /* Légère augmentation de la taille */
}

.btn-simple {
    font-size: 14px;
    font-weight: 500;
    color: var(--noir);
}

.btn-simple:hover,
.btn-simple:focus {
    color: var(--bleu);
}

/* All content */

.all,
.pt {
    padding: 10px 10px 20px;
    border-radius: 5px;
    margin-bottom: 30px;
}

h3.title {
    font-size: 30px;
    margin-bottom: 20px;
    color: var(--marron);
}

.all-content {
    width: 1000px;
    margin: 0 auto;
}

.all-div {
    display: flex;
    flex-direction: row;
    text-align: center;
}

.all-div.ett {
    font-weight: 600;
    border-bottom: 2px solid rgba(0,0,0,0.6);
}

.all-div.atr {
    border-bottom: 2px solid rgba(0,0,0,0.1);
}

.all-div div {
    width: calc(100% / 5);
    padding: 10px 0;
    font-size: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
}

table {
    width: 1000px;
    font-size: 16px;
    text-align: center;
    margin: 0 auto;
    border-collapse: collapse;
}

thead tr {
    border-bottom: 2px solid rgba(0,0,0,0.6);
}

tbody tr {
    border-bottom: 2px solid rgba(0,0,0,0.1);
}

th, td {
    padding: 10px 0;
}

td a {
    color: var(--noir);
    font-weight: 600;
}

@media (max-width: 1100px) {
    h3.title {
        font-size: 25px;
    }

    table {
        width: 100%;
    }
}

@media (max-width: 900px) {
    h3.title {
        font-size: 20px;
    }
    
    table {
        font-size: 14px;
        min-width: 400px;
    }

    tr, td {
        padding: 10px 10px;
    }
}

/* Tri */

.add-tri {
    display: flex;
    justify-content: space-between;
    width: 1000px;
    margin: 0 auto 30px;
}

.tri-div {
    width: 350px;
    display: flex;
    align-items: center;
}

.tri-div span {
    font-weight: 600;
    color: var(--rouge);
}

.tri-div select {
    font-size: 14px;
    font-weight: 600;
    padding: 5px 8px;
    border: none;
    border-radius: 2px;
    outline: none;
    margin: 0 10px;
}

.add-btn {
    width: 450px;
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: center;
}

.add-btn a {
    margin: 0 5px;
}

.add-filter {
    font-size: 18px;
    font-weight: 550;
    margin: 10px 0 20px;
}

.add-filter span:last-child {
    color: var(--bleu);
    font-size: 20px;
}

@media (max-width: 1150px) {
    .add-tri {
        width: 100%;
    }
}

@media (max-width: 710px) {
    .add-tri {
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .add-filter {
        font-size: 16px;
        margin: 40px 0 10px;
        text-align: center;
    }

    .add-filter span:last-child {
        font-size: 18px;
    }

    .add-btn {
        margin-top: 20px;
        justify-content: space-around;
    }
}

@media (max-width: 400px) {
    h2.title {
        font-size: 25px;
    }

    .tri-div {
        width: 100%;
        flex-direction: column;
    }

    .tri-div span {
        margin-bottom: 15px;
    }

    .tri-div select {
        margin: 10px 0;
    }

    .add-btn {
        display: flex;
        justify-content: center;
        flex-direction: column;
        margin-bottom: 30px;
    }

    .add-btn a {
        margin: 14px 0 0;
    }
}

/* Imprimer */

.imp-btn {
    margin: 50px 0 100px;
    text-align: center;
}

.imp-btn a {
    font-size: 18px;
    color: var(--noir);
}

</style>