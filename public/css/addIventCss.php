<style>

.vent {
    width: 800px;
    margin: 0 auto 50px;
}

.vent h5 {
    font-size: 24px;
    margin: 25px 0;
}

table, th, td {
  border: 2px solid rgba(0,0,0,0.1);
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 5px;
    text-align: center;
}

th:nth-child(3),
td:nth-child(3) {
    color: var(--rouge);
}

th:nth-child(5),
td:nth-child(5) {
    color: var(--bleu);
}

td input {
    width: 120px;
    padding: 5px;
    font-size: 16px;
    text-align: center;
    border: none;
    outline: none;
    border: 1px solid rgba(0,0,0,0.2);
}

td input::-webkit-outer-spin-button,
td input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.supp {
    position: absolute;
    right: 0;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 100%;
}

.supp a {
    text-decoration: none;
    background-color: var(--rouge);
    color: var(--blanc);
    font-weight: bold;
    padding: 2px 5px;
    border-radius: 100%;
    font-size: 16px;
    transition: 0.3s ease-out;
}

.supp a:hover,
.supp a:focus {
    background-color: var(--noir);
}

@media (max-width: 925px) {
    .vent {
        width: 100%;
    }
}

@media (max-width: 650px) {
    .vent h5 {
        font-size: 18px;
        text-align: center;
    }
    th, td {
        font-size: 14px;
    }

    td input {
        font-size: 14px;
        width: 50px;
    }
}

</style>