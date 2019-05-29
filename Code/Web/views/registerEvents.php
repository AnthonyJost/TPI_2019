<?php
require_once "model/eventsManager.php";
$event = getEventTitle();
$workinggroups = getWorkinggroups();
?>

<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2><?=$event['Title']?></h2>
        </div>
        <div class="row">
            <?php foreach($workinggroups as $workinggroup): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="categorie-item">
                        <div class="ci-thumb set-bg" data-setbg="img/categories/4.jpg"></div>
                        <div class="ci-text">
                            <input type="text" name="idWorkinggroups" value="<?=$workinggroup['idWorkinggroups']?>" hidden>
                            <label>Titre</label>
                            <h3 type="text"><?=$workinggroup['Title']?></h3><br/>
                            <label>Coût</label>
                            <h4 type="number"><?=$workinggroup['Cost']?></h4><br/>
                            <button type="submit" class="site-btn">s'inscrire</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- categories section end -->
