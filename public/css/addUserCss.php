<style>

p {
    max-width: 500px;
    margin: 0 auto;
    font-size: 14px;
    color: var(--rouge);
    margin-bottom: 30px;
}

.user {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* R Info */

.r-info {
    width: 300px;
    text-align: center;
}

form div {
    margin-bottom: 15px;
}

form button {
    margin-top: 15px;
    color: var(--blanc);
    background-color: var(--noir);
    padding: 7px 0;
    font-size: 16px;
    cursor: pointer;
    outline: none;
    width: 80%;
    text-decoration: none;
    border-radius: 3px;
    font-weight: 600;
    transition: all 0.5s ease-out;
    border: none;
}

form button:focus,
form button:hover {
    background-color: var(--rouge);
}

.r-info label {
    font-size: 16px;
}

.r-info input,
.r-info select {
    width: 80%;
    padding: 3px 8px;
    font-weight: 550;
    margin-top: 5px;
    font-size: 16px;
}

.r-info textarea {
    width: 80%;
    height: 150px;
    font-size: 16px;
    margin: 5px 0 15px;
    padding: 3px 8px;
    outline: none;
    resize: none;
    border-radius: 3px;
}

@media (max-width: 400px) {
    .r-info {
        width: 100%;
    }
    
    form button,
    .r-info input,
    .r-info select,
    .r-info textarea {
        width: 100%;
    }
}

</style>