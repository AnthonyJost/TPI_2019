<!-- signup section -->
<section class="signup-section spad">
    <div class="signup-bg set-bg" data-setbg="img/signup-bg.jpg"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="signup-warp">
                    <div class="section-title text-white text-left">
                        <h2>Connexion</h2>
                    </div>
                    <!-- signup form -->
                    <form class="signup-form" method="post" action="?action=loginValidation">
                        <input type="email" placeholder="Email" name="inputEmail" id="inputEmail" required>
                        <input type="password" placeholder="Mot de passe" name="inputPsw" id="inputPsw" required>
                        <b><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></b><br/>
                        <button type="submit" class="site-btn">Se connecter</button>
                        <a href="?action=register">Inscription</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup section end -->
