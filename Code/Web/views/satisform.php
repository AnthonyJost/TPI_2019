<!-- Form page -->
<section class="signup-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="signup-warp">
                    <div class="section-title text-white text-left">
                        <h2>Formulaire de satisfaction</h2>
                        <p>
                            Taux de satisfaction de la journée de formation<br>
                            1: Pas du tout satisfait<br>
                            2: Pas satisfait<br>
                            3: Peu satisfait<br>
                            4: Satisfait<br>
                            5: Très satisfait<br>
                            6: Complétement satisfait
                        </p>
                    </div>
                    <form class="signup-form" method="post" action="?action=sendForm">
                        <input type="text" name="idWorkinggroups" value="<?=$workingGroups[0]['idWorkinggroups']?>" hidden>
                        <h4><?=$workingGroups[0]['Title']?></h4><br>
                        <label>Supports fournis</label><br>
                        <input type="radio" name="Material" value="1"> 1 -
                        <input type="radio" name="Material" value="2"> 2 -
                        <input type="radio" name="Material" value="3"> 3 -
                        <input type="radio" name="Material" value="4"> 4 -
                        <input type="radio" name="Material" value="5"> 5 -
                        <input type="radio" name="Material" value="6"> 6
                        <br><br>
                        <label>Animation de l'atelier</label><br>
                        <input type="radio" name="Activity" value="1"> 1 -
                        <input type="radio" name="Activity" value="2"> 2 -
                        <input type="radio" name="Activity" value="3"> 3 -
                        <input type="radio" name="Activity" value="4"> 4 -
                        <input type="radio" name="Activity" value="5"> 5 -
                        <input type="radio" name="Activity" value="6"> 6
                        <br><br>
                        <label>Lieu de la journée</label><br>
                        <input type="radio" name="Place" value="1"> 1 -
                        <input type="radio" name="Place" value="2"> 2 -
                        <input type="radio" name="Place" value="3"> 3 -
                        <input type="radio" name="Place" value="4"> 4 -
                        <input type="radio" name="Place" value="5"> 5 -
                        <input type="radio" name="Place" value="6"> 6
                        <br><br>
                        <label>Horaires de la journée</label><br>
                        <input type="radio" name="Hours" value="1"> 1 -
                        <input type="radio" name="Hours" value="2"> 2 -
                        <input type="radio" name="Hours" value="3"> 3 -
                        <input type="radio" name="Hours" value="4"> 4 -
                        <input type="radio" name="Hours" value="5"> 5 -
                        <input type="radio" name="Hours" value="6"> 6
                        <br><br>
                        <label>Niveau global de satisfaction</label><br>
                        <input type="radio" name="Satisfaction" value="1"> 1 -
                        <input type="radio" name="Satisfaction" value="2"> 2 -
                        <input type="radio" name="Satisfaction" value="3"> 3 -
                        <input type="radio" name="Satisfaction" value="4"> 4 -
                        <input type="radio" name="Satisfaction" value="5"> 5 -
                        <input type="radio" name="Satisfaction" value="6"> 6
                        <br><br>
                        <label>Des suggestions ?</label>
                        <input type="text" name="Suggestion"><br>
                        <button type="submit" class="site-btn">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
