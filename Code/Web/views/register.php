<?php
require_once "model/usersManager.php";
$schools = getSchools();
?>
<?php if (@$_GET['registerError'] == true) :?>
    <h5><span style="color:red">Inscription refusée</span></h5>
<?php endif ?>

<!-- signup section -->
<section class="signup-section spad">
    <div class="signup-bg set-bg" data-setbg="img/signup-bg.jpg"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="signup-warp">
                    <div class="section-title text-white text-left">
                        <h2>Inscription</h2>
                    </div>
                    <!-- signup form -->
                    <form class="signup-form" method="post" action="?action=registerValidation">
                        <input type="text" placeholder="Prénom" name="inputFirstName" id="inputFirstName" required>
                        <input type="text" placeholder="Nom" name="inputLastName" id="inputLastName" required>
                        <input type="email" placeholder="Email" name="inputEmail" id="inputEmail" required>
                        <input type="password" placeholder="Mot de passe" name="inputPsw" id="inputPsw" required>
                        <input type="password" placeholder="Confirmez le mot de passe" name="inputPswRepeat" id="inputPswRepeat" required>
                        <select id="inputSchool" name="inputSchool" placeholder="École" required>
                            <option value="" disabled selected>--Choisissez une école--</option>
                            <?php foreach($schools as $school): ?>
                                <option value="<?= $school['idSchools'] ?>" ><?= $school['Name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="site-btn">S'inscrire</button>
                        <a href="?action=login">Connexion</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup section end -->