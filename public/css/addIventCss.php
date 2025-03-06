<style>

.vent {
    width: 800px;
    margin: 0 auto 50px;
}

table, th, td {
  border: 1px solid black;
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

@media (max-width: 925px) {
    .vent {
        width: 100%;
    }
}

@media (max-width: 650px) {
    th, td {
        font-size: 14px;
    }

    td input {
        font-size: 14px;
        width: 50px;
    }
}

</style>