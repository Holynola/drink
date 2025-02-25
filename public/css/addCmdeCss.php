<style>

.cmd {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.cmd-left {
    width: 500px;
    margin-bottom: 50px;
}

.cmd-left h5 {
    font-size: 24px;
    margin-top: 20px;
}

.info-cmd {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    border: 1px solid rgba(0,0,0,0.2);
}

.info-cmd div {
    width: calc(100% / 2);
    padding: 10px 5px;
    display: flex;
    text-align: center;
    justify-content: center;
    flex-direction: column;
}

.info-cmd div p {
    margin: 0;
}

.info-cmd span, .info-cmd p {
    vertical-align: middle;
}

.left-content {
    display: flex;
    justify-content: center;
    align-items: center;
}

.left-one div {
    text-align: center;
    margin-bottom: 15px;
}

@media (max-width: 650px) {
    .left-content {
        flex-direction: column;
    }

    .left-one {
        margin-bottom: 20px;
    }
}

.cmd-right {
    width: 350px;
    padding-bottom: 50px;
}

@media (max-width: 630px) {
    .cmd-left {
        width: 100%;
    }

    .cmd-left h5 {
        font-size: 20px;
    }

    .info-cmd {
        flex-wrap: wrap;
    }

    .info-cmd div {
        width: 50%;
    }
}

@media (max-width: 400px) {
    .info-cmd div {
        width: 100%;
    }
}

</style>