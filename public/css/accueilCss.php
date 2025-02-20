<style>

@font-face {
    font-family: 'Rio';
    src: url('src/fonts/RioGrande.ttf');
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto';
}

header {
    width: 100%;
    height: 100vh;
    background-image: url('../src/img/bg.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

header::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.home {
    width: 500px;
    height: 500px;
    z-index: 10;
    color: #fff;
}

.home h2 {
    text-align: center;
    font-size: 30px;
}

.home-all {
    width: 100%;
    height: 200px;
    margin: 50px 0;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.home-card {
    width: 180px;
    height: 180px;
    box-shadow: inset 0px 10px 27px -3px rgba(255,255,255,0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex-direction: column;
    padding: 10px;
}

.home-card h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

.home-card a {
    color: #fff;
}

@media (max-width: 550px) {
    header {
        background-image: url('../src/img/bg-ph.jpg');
        position: relative;
    }

    .home {
        width: 100%;
        height: auto;
        padding: 20px;
    }

    .home h2 {
        font-size: 25px;
    }

    .home-all {
        height: auto;
        flex-direction: column;
    }

    .home-card {
        margin-bottom: 30px;
    }

    .home-card h3 {
        font-size: 20px;
    }
}

@media (max-height: 600px) {
    header,
    header::after {
        height: 600px;
    }
}

</style>