<style>

.info {
    width: 1000px;
    margin: 0 auto;
    display: flex;
}

.info-left,
.info-right {
    width: 50%;
    display: flex;
    flex-direction: column;
    padding: 20px;
    box-shadow: 0px 5px 11px -5px rgba(0,0,0,0.2);
}

.left-icon {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.left-icon img {
    width: 120px;
}

.left-box span {
    font-size: 20px;
}

.left-box span:nth-child(2) {
    color: var(--rouge);
    font-weight: 600;
}

.left-sep {
    width: 100%;
    margin: 20px 0;
}

.left-mdf {
    width: 100%;
    margin-top: 30px;
}

.left-mdf h5 {
    font-size: 20px;
    text-align: center;
    color: var(--rouge);
}

.mdf-content {
    display: flex;
    width: 100%;
}

.mdf-content span.title {
    font-weight: 600;
}

.mdf-content span.perso {
    font-weight: 600;
    color: var(--rouge);
}

.mdf-left,
.mdf-right {
    width: 50%;
    margin-top: 10px;
    padding: 5px 10px;
    font-size: 18px;
}

.mdf-left {
    text-align: right;
}

.info-right {
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    width: 200px;
    margin-bottom: 20px;
}

form div {
    margin-bottom: 15px;
    text-align: center;
}

form label {
    font-size: 18px;
}

form select,
form input {
    width: 100%;
    padding: 3px 8px;
    font-weight: 550;
    margin-top: 5px;
    font-size: 16px;
}

.all-btn {
    width: 100%;
}

.btn-div {
    text-align: center;
    margin: 10px 0 25px;
}

.btn-div button,
.btn-div a {
    background: none;
    border-radius: 3px;
    font-size: 18px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    color: var(--noir);
    text-decoration: underline;
}

.btn-div a.red:focus,
.btn-div a.red:hover {
    color: var(--rouge);
}

.btn-div button.blue:focus,
.btn-div button.blue:hover {
    color: var(--bleu);
}

.btn-div a.green:focus,
.btn-div a.green:hover,
.btn-div button.green:focus,
.btn-div button.green:hover {
    color: var(--vert);
}

.btn-div button.orange:focus,
.btn-div button.orange:hover {
    color: var(--orange);
}

@media (max-width: 1000px) {
    .info {
        width: 100%;
    }
}

@media (max-width: 860px) {
    .info {
        flex-direction: column;
    }

    .info-left,
    .info-right {
        width: 100%;
    }

    .info-right {
        padding-top: 20px;
    }
}

@media (max-width: 400px) {  
    .left-box span {
        font-size: 18px;
    }

    .left-mdf h5 {
        font-size: 18px;
    }

    .mdf-left,
    .mdf-right {
        font-size: 16px;
    }

    form label {
        font-size: 16px;
    }

    .btn-div button,
    .btn-div a {
        font-size: 16px;
    }
}

</style>