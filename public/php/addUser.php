<?php include '../public/css/addUserCss.php'; ?>

<div class="top">
    <i class="fa-solid fa-user"></i>
    <h4>Ajouter un utilisateur</h4>
</div>

<div class="content">
    <div class="user">
        <div class="r-info">
            <form action="#">
                <div>
                    <label for="titre">Titre</label><br>
                    <select name="titre" id="titre" required>
                        <option value=""></option>
                        <option value="monsieur">Monsieur</option>
                        <option value="madame">Madame</option>
                        <option value="mademoiselle">Mademoiselle</option>
                    </select>
                </div>

                <div>
                    <label for="nom">Nom</label><br>
                    <input type="text" name="nom" id="nom" maxlength="20" required>
                </div>

                <div>
                    <label for="prenoms">Prénoms</label><br>
                    <input type="text" name="prenoms" id="prenoms" maxlength="30" required>
                </div>

                <div>
                    <label for="contact">Contact</label><br>
                    <input type="text" name="contact" id="contact" maxlength="10" required>
                </div>

                <div>
                    <label for="poste">Poste</label><br>
                    <select name="poste" id="poste" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="service">Lieu de service</label><br>
                    <select name="service" id="service" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="username">Identifiant</label><br>
                    <input type="text" name="username" id="username" maxlength="30" required>
                </div>

                <div>
                    <label for="pass">Mot de passe</label><br>
                    <input type="password" name="pass" id="pass" autocomplete="off" minlength="4" required>
                </div>

                <div>
                    <label for="confpass">Confirmation du Mot de passe</label><br>
                    <input type="password" name="confpass" id="confpass" autocomplete="off" minlength="4" required>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>