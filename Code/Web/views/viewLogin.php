<?php $this->_t = 'Connexion';?>
<?php if (@$_GET['loginError'] == true) :?>
    <h5><span style="color:red">Login refusé</span></h5>
<?php endif ?>
<article>
    <form class='form' method='POST' action="index.php?url=Login">
        <div class="container">
            <label for="userEmail"><b>Email</b></label>
            <input type="email" placeholder="Entrez votre adresse mail" name="inputUserEmailAddress" required>

            <label for="userPsw"><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrez votre mot de passe" name="inputUserPsw" required>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-default">Login</button>
            <button type="reset" class="btn btn-default">Reset</button>
            <!--<span class="psw">Forgot <a href="#">password?</a></span>-->
        </div>
    </form>
    <div class="container signin">
        <p>Besoin d'un compte <a href="index.php?url=Register">Register</a>.</p>
    </div>
</article>
