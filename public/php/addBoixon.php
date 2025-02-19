<?php include '../public/css/addUserCss.php'; ?>

<script>
    function openPage2() {
        window.open("imagesB.php", "_blank");
    }

    function setImageName(imageName) {
        document.getElementById('imageName').value = imageName;
    }
</script>

<div class="top">
    <i class="fa-solid fa-wine-glass"></i>
    <h4>Ajouter une boisson</h4>
</div>

<div class="cotent">
    <div class="user">
        <div class="r-info">
            <form action="#">
                <div>
                    <button type="button" onclick="openPage2()">Sélectionnez l'image</button>
                    <label for="imageName"></label>
                    <input type="text" id="imageName" readonly>
                </div>

                <div>
                    <label for="design">Nom de la boisson</label><br>
                    <input type="text" name="design" id="design" maxlength="100" required>
                </div>

                <div>
                    <label for="prixv">Prix de vente</label><br>
                    <input type="number" name="prixv" id="prixv" maxlength="11" required>
                </div>

                <div>
                    <label for="typeb">Type de boisson</label><br>
                    <select name="typeb" id="typeb" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="typec">Type de contenant</label><br>
                    <select name="typec" id="typec" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="typemb">Type d'emballage</label><br>
                    <select name="typemb" id="typemb" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="nbrebout">Nombre de bouteilles par casier</label><br>
                    <input type="number" name="nbrebout" id="nbrebout" maxlength="5" required>
                </div>

                <div>
                    <label for="kit">Vendue en kit ?</label><br>
                    <select name="kit" id="kit" required>
                        <option value=""></option>
                        <option value="yes">Oui</option>
                        <option value="no">Non</option>
                    </select>
                </div>

                <div>
                    <label for="prixk">Prix du kit</label><br>
                    <input type="number" name="prixk" id="prixk" maxlength="11" required>
                </div>

                <div>
                    <label for="nbrekit">Nombre de bouteilles par kit</label><br>
                    <input type="number" name="nbrekit" id="nbrekit" maxlength="5" required>
                </div>

                <div>
                    <label for="service">Lieu de service</label><br>
                    <select name="service" id="service" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>