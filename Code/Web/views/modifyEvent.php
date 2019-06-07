<!-- Modifying events and stats consultation page -->
<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Modification d'événements</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="img/categories/1.jpg"></div>
                    <form class="signup-form" method="post" action="?action=updateEvent&idEvents=<?=$modifyEvent['idEvents']?>">
                        <input type="text" name="idEvents" value="<?=$modifyEvent['idEvents']?>" hidden>
                        <label>Titre</label>
                        <input type="text" name="Title" value="<?=$modifyEvent['Title']?>"><br/>
                        <label>Date</label>
                        <input type="date" name="Date" value="<?= $modifyEvent['Date'] ?>"><br/><br/>
                        <button type="submit" class="site-btn">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($workingGroups as $workinggroup): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="categorie-item">
                        <div class="ci-thumb set-bg" data-setbg="img/categories/4.jpg"></div>
                        <div class="ci-text">
                            <input type="text" name="idWorkinggroups" value="<?=$workinggroup['idWorkinggroups']?>" hidden>
                            <label>Titre</label>
                            <h3 type="text"><?=$workinggroup['Title']?></h3><br/>
                            <label>Coût</label>
                            <h4 type="number"><?=$workinggroup['Cost']?></h4><br/>
                            <a href="?action=displayStats&idWorkingGroups=<?=$workinggroup['idWorkinggroups']?>">
                                <button class="site-btn">Statistiques</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- categories section end -->
