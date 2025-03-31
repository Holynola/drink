<style>

.bord {
    display: flex;
}

.bord-left {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 70%;
}

/* Style de la card */
.card {
    width: 350px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 15px 5px;
    margin-bottom: 25px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

/* Titre principal centré */
.card-header {
    text-align: center;
    margin-bottom: 20px;
}

.card-main-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    color: #2d3748;
    position: relative;
    padding-bottom: 10px;
}

.card-main-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background-color: var(--bleu);
    border-radius: 3px;
}

/* Contenu de la card */
.card-content {
    padding: 0 10px;
}

.card-title {
    font-size: 1.1rem;
    margin-bottom: 5px;
    color: #2d3748;
}

.bord-right {
    width: 30%;
}

.r-info h3 {
    color: var(--rouge);
    text-align: center;
    margin: 10px 0;
    font-size: 1.5rem;
}

.det {
    padding: 10px 15px;
    display: flex;
}

.det-left {
    margin-right: 10px;
    font-size: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.det-right p {
    font-size: 1.2rem;
    color: var(--bleu);
}

.det-right span {
    font-size: 1.1rem;
}

@media (max-width: 1200px) {
    .bord {
        flex-direction: column;
    }

    .bord-left,
    .bord-right {
        width: 100%;
    }

    .bord-right {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }
}

</style>