<?php $this->_t = 'Inscription';?>
<div class="section-title">
    <h2>S'inscrire</h2>
    <?php if (@$_GET['registerError'] == true) :?>
        <h5><span style="color:red">Inscription refusée</span></h5>
    <?php endif ?>
    <article>
        <form class='form' method='POST' action="index.php?url=Register">

            <p>Pour vous inscrire aux ateliers pédagogiques, nous vous prions de renseigner les champs suivants:</p>
        </div>
        <div class="container">
            <label for="userFirstName"><b>Prénom</b></label>
            <input type="text" placeholder="Entrez votre prénom" name="inputFirstName" required>
            <br/>
            <label for="userLastName"><b>Nom</b></label>
            <input type="text" placeholder="Entrez votre nom" name="inputLastName" required>
            <br/>
            <label for="userEmail"><b>Email</b></label>
            <input type="email" placeholder="Entrez une addresse email" name="inputEmail" required>
            <br/>
            <label for="userPsw"><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrez un mot de passe" name="inputPassword" required>
            <br/>
            <label for="psw-repeat"><b>Confirmez le mot de passe</b></label>
            <input type="password" placeholder="Confirmez le mot de passe" name="inputPasswordRepeat" required>
            <br/>
            <label for="_name"><b>Sélectionnez une école</b></label>
            <select placeholder="Votre école" required>
                <option value="" disabled selected>--Choisissez une école--</option>
                <?php foreach($schools as $school): ?>
                    <option id="_name" name="inputSchool" value="<?= $school->idSchools() ?>" ><?= $school->name() ?></option>
                <?php endforeach; ?>
            </select>


            <p>En soumettant votre demande de compte, vous validez les conditions générales d'utilisation.<a href="https://termsfeed.com/blog/privacy-policies-vs-terms-conditions/">CGU et vie privée</a>.</p>
            <button type="submit" class="registerbtn">Inscription</button>
        </div>
    </form>
    <div class="container signin">
        <p>Déjà membre ? <a href="index.php?url=Login">Connexion</a>.</p>
    </div>
</article>