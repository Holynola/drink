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
    background-image: url('src/img/bg.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

.log {
    width: 300px;
    background-color: rgba(0,0,0,0.6);
    padding: 30px 40px 50px;
}

.log h1 {
    text-align: center;
    color: #fff;
    margin-bottom: 30px;
    font-size: 35px;
}

.log h1 span {
    font-family: 'Rio';
}

.log p {
    font-weight: 600;
    color: #fff;
    font-size: 18px;
    margin-top: 30px;
}

.log input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent !important;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}

.log button {
    margin-top: 40px;
    width: 100%;
    border: none;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 10px;
    background-color: #c1121f;
    transition: 0.3s ease-out;
}

.log button:hover,
.log button:focus {
    transform: scaleX(1.1);
    background-color: #fff;
    color: #000;
}

@media (max-width: 550px) {
    header {
        background-image: url('src/img/bg-ph.jpg');
        position: relative;
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

    .log {
        z-index: 10;
        background-color: transparent !important;
    }
}

@media (max-width: 310px) {
    .log {
        width: 100%;
        padding: 30px;
    }
}

@media (max-height: 500px) {
    header {
        height: 600px;
    }

    .log {
        height: 420px;
    }
}

</style>